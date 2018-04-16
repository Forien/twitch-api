<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:17
 */

namespace Forien\Api\Twitch\Resources;


use Forien\Api\Twitch\Endpoints;
use Forien\Api\Twitch\Resources\ResponseObjects\Streams as StreamResponse;
use Forien\TwitchApi;

class Streams extends BaseResource
{
    protected $possibleParams = [
        'after'        => 'string',
        'before'       => 'string',
        'community_id' => 'string',
        'first'        => 'integer',
        'game_id'      => 'string',
        'language'     => 'string',
        'user_ud'      => 'string',
        'user_login'   => 'string'
    ];
    /**
     * @var StreamResponse
     */
    protected $response;
    protected $authentication = ['client-id'];

    public function __construct(TwitchApi $api, array $params = [])
    {
        $this->url = Endpoints::TWITCH_API_URL;
        $this->endpoint = Endpoints::GET_STREAMS;

        $this->__traitConstruct($api, $params);
    }

    /**
     * @param array $params
     *
     * @return Streams
     */
    public function setParams(array $params = []): Streams
    {
        return $this->traitSetParams($params);
    }

    /**
     * @return StreamResponse
     * @throws \Forien\Exceptions\ApiException
     */
    public function get(): StreamResponse
    {
        if (!$this->called) {
            $this->call();
        }

        return $this->response;
    }

    /**
     * @return $this
     * @throws \Forien\Exceptions\ApiException
     */
    public function call(): Streams
    {
        if (!$this->called) {
            $response = $this->api->apiCall($this, $this->authentication);

            $this->response = new StreamResponse($response);

            $this->called = true;
        }

        return $this;
    }
}