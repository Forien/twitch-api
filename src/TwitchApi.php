<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 15.04.2018
 * Time: 21:12
 */

namespace Forien;


use Forien\Api\RequestBuilder;
use Forien\Api\Twitch\Endpoints;
use Forien\Api\Twitch\OidcResponse;
use Forien\Api\Twitch\Resources\BaseResource;
use Forien\Api\Twitch\Resources\Games;
use Forien\Api\Twitch\Resources\Streams;
use Forien\Api\Twitch\Resources\Users;
use Forien\Api\Twitch\Scope;
use Forien\Exceptions\TwitchApiException;

class TwitchApi
{
    private $clientId;
    private $redirectUri;
    private $clientSecret;
    private $accessToken;
    private $refreshToken;

    /**
     * TwitchApi constructor.
     *
     * @param null $clientID
     * @param null $redirectUri
     * @param null $clientSecret
     * @param null $accessToken
     * @param null $refreshToken
     */
    public function __construct($clientID = null, $redirectUri = null, $clientSecret = null, $accessToken = null, $refreshToken = null)
    {
        if (!empty($clientID)) {
            $this->setClientId($clientID);
        }
        if (!empty($redirectUri)) {
            $this->setRedirectUri($redirectUri);
        }
        if (!empty($clientSecret)) {
            $this->setClientSecret($clientSecret);
        }
        if (!empty($accessToken)) {
            $this->setAccessToken($accessToken);
        }
        if (!empty($refreshToken)) {
            $this->setRefreshToken($refreshToken);
        }
    }

    /**
     * @param string $clientId
     *
     * @return TwitchApi
     */
    public function setClientId(string $clientId): TwitchApi
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @param string $redirectUri
     *
     * @return TwitchApi
     */
    public function setRedirectUri(string $redirectUri): TwitchApi
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    /**
     * @param string $clientSecret
     *
     * @return TwitchApi
     */
    public function setClientSecret(string $clientSecret): TwitchApi
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param mixed $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * Returns URL that user needs to be (re)directed in order to authorize him/her.
     *
     * @param Scope $scope
     *
     * @return string
     * @throws Exceptions\ApiException
     * @throws TwitchApiException
     */
    public function authorize(Scope $scope): string
    {
        if (empty($this->clientId) || empty($this->redirectUri)) {
            throw new TwitchApiException('Need both Client-ID and Redirect URI set for authorize()');
        }

        $params = [
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'         => (string)$scope
        ];

        $url = new RequestBuilder(Endpoints::TWITCH_ID_URL, Endpoints::AUTHORIZE, ...$params);

        return (string)$url;
    }

    /**
     * @param string $code
     *
     * @return OidcResponse
     * @throws Exceptions\ApiException
     * @throws TwitchApiException
     */
    public function token(string $code)
    {
        if (empty($this->clientId) || empty($this->redirectUri) || empty($this->clientSecret)) {
            throw new TwitchApiException('Client-ID, Client Secret and Redirect URI are all needed to be set for token()');
        }

        $params = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->redirectUri,
            'code'          => $code
        ];

        $url = new RequestBuilder(Endpoints::TWITCH_ID_URL, Endpoints::TOKEN, $params);

        $response = $this->sendCurl($url, true);

        $response = new OidcResponse($response);

        return $response;
    }

    /**
     * @param string $url
     * @param bool   $post
     * @param array  $headers
     *
     * @return mixed
     */
    private function sendCurl(string $url, bool $post = false, array $headers = [])
    {

        $curl = curl_init($url);
        if (count($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, true);
        }

        $json_response = curl_exec($curl);

        curl_close($curl);

        return json_decode($json_response);
    }

    /**
     * @param BaseResource $resource
     * @param array        $auth
     *
     * @return mixed
     * @throws Exceptions\ApiException
     * @throws TwitchApiException
     */
    public function apiCall(BaseResource $resource, array $auth = [])
    {
        $headers = [];

        if (in_array('authorization_optional', $auth)) {
            if (!empty($this->accessToken)) {
                $headers[] = "Authorization: Bearer {$this->accessToken}";
            }
        } elseif (in_array('authorization', $auth)) {
            if (empty($this->accessToken)) {
                $class = get_class($resource);
                throw new TwitchApiException("access_token required for call of '{$class}' resource");
            }
            $headers[] = "Authorization: Bearer {$this->accessToken}";
        }
        if (in_array('client-id', $auth)) {
            if (empty($this->accessToken)) {
                $class = get_class($resource);
                throw new TwitchApiException("Client-ID required for call of '{$class}' resource");
            }
            $headers[] = "Client-ID: {$this->clientId}";
        }

        $url = new RequestBuilder($resource->getUrl(), $resource->getEndpoint(), $resource->getParams());

        $result = $this->sendCurl($url, false, $headers);

        if (isset($result->status) && $result->status === 401 && in_array('authorization', $auth)) {
            $refreshResponse = $this->refresh($this->refreshToken);
            if ($refreshResponse !== false) {
                $this->setRefreshToken($refreshResponse->refresh_token);
                $this->setAccessToken($refreshResponse->access_token);

                $result = $this->sendCurl($url, false, $headers);
            }
        }

        return $result;
    }

    /**
     * @param string $refreshToken
     *
     * @return bool|mixed
     * @throws Exceptions\ApiException
     * @throws TwitchApiException
     */
    public function refresh(string $refreshToken)
    {
        if (empty($this->clientId) || empty($this->clientSecret)) {
            throw new TwitchApiException('Client-ID, Client Secret and Redirect URI are all needed to be set for token()');
        }

        $params = [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken
        ];

        $url = new RequestBuilder(Endpoints::TWITCH_ID_URL, Endpoints::REFRESH, $params);

        $response = $this->sendCurl($url, true);

        if (!empty($response->status) && $response->status === 400) {
            return false;
        }

        return $response;
    }

    /**
     * @param array $params Assoc array with parameters for Query String
     *
     * @return Streams
     * @throws TwitchApiException
     */
    public function getStreams(array $params = []): Streams
    {
        if (empty($this->clientId)) {
            throw new TwitchApiException('Client-ID is needed to be set for getStreams()');
        }

        $streams = new Streams($this, $params);

        return $streams;
    }

    /**
     * @param array $params Assoc array with parameters for Query String
     *
     * @return Games
     * @throws TwitchApiException
     */
    public function getGames(array $params = []): Games
    {
        if (empty($this->clientId)) {
            throw new TwitchApiException('Client-ID is needed to be set for getGames()');
        }

        $games = new Games($this, $params);

        return $games;
    }

    /**
     * @param array $params Assoc array with parameters for Query String
     *
     * @return Users
     * @throws TwitchApiException
     */
    public function getUsers(array $params = []): Users
    {
        if (empty($this->clientId) && empty($this->accessToken)) {
            throw new TwitchApiException('Either Client-ID or access_token is required to be set for getUsers()');
        }

        $games = new Users($this, $params);

        return $games;
    }
}