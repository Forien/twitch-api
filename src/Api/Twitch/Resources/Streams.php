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

/**
 * Class Streams
 *
 * @package Forien\Api\Twitch\Resources
 */
class Streams extends BaseResource
{
    /**
     * @var string
     */
    protected static $responseClass = StreamResponse::class;
    /**
     * @var array
     */
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
    /**
     * @var array
     */
    protected $authentication = ['client-id'];

    public function __construct(TwitchApi $api, array $params = [])
    {
        $this->url = Endpoints::TWITCH_API_URL;
        $this->endpoint = Endpoints::GET_STREAMS;

        parent::__construct($api, $params);
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
     * @throws \Forien\Exceptions\TwitchApiException
     */
    public function get(): StreamResponse
    {
        return parent::get();
    }
}