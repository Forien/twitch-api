<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 20:58
 */

namespace Forien\Api\Twitch;

/**
 * Class OidcResponse
 *
 * @package Forien\Api\Twitch
 */
class OidcResponse
{
    private $accessToken;
    private $refreshToken;
    private $expiresIn;
    private $scope;
    private $idToken;
    private $header;
    private $payload;
    private $signature;

    /**
     * OidcResponse constructor.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->accessToken = $response->access_token;
        $this->refreshToken = $response->refresh_token;
        $this->expiresIn = $response->expires_in;
        $this->scope = $response->scope;
        $this->idToken = $response->id_token;

        $parts = explode('.', $this->idToken);
        $this->header = json_decode(base64_decode($parts[0]));
        $this->payload = json_decode(base64_decode($parts[1]));
        $this->signature = json_decode(base64_decode($parts[2]));
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getIdToken(): string
    {
        return $this->idToken;
    }
}