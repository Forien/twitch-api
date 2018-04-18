<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:17
 */

namespace Forien\Api\Twitch\Resources;


use Forien\Api\Twitch\Endpoints;
use Forien\Api\Twitch\Resources\ResponseObjects\Games as GameResponse;
use Forien\Api\Twitch\Resources\ResponseObjects\Streams as StreamResponse;
use Forien\TwitchApi;

/**
 * Class Games
 *
 * @package Forien\Api\Twitch\Resources
 */
class Games extends BaseResource
{
    /**
     * @var string
     */
    protected static $responseClass = GameResponse::class;
    /**
     * @var array
     */
    protected $possibleParams = [
        'id'   => 'string',
        'name' => 'string'
    ];
    /**
     * @var GameResponse
     */
    protected $response;
    /**
     * @var array
     */
    protected $authentication = ['client-id'];

    public function __construct(TwitchApi $api, array $params = [])
    {
        $this->url = Endpoints::TWITCH_API_URL;
        $this->endpoint = Endpoints::GET_GAMES;

        parent::__construct($api, $params);
    }

    /**
     * @param array $params
     *
     * @return Games
     */
    public function setParams(array $params = []): Games
    {
        return $this->traitSetParams($params);
    }

    /**
     * @return GameResponse
     * @throws \Forien\Exceptions\ApiException
     * @throws \Forien\Exceptions\TwitchApiException
     */
    public function get(): GameResponse
    {
        return parent::get();
    }
}