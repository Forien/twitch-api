<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:17
 */

namespace Forien\Api\Twitch\Resources;


use Forien\Api\Twitch\Endpoints;
use Forien\Api\Twitch\Resources\ResponseObjects\Users as UserResponse;
use Forien\TwitchApi;

/**
 * Class Users
 *
 * @package Forien\Api\Twitch\Resources
 */
class Users extends BaseResource
{
    /**
     * @var string
     */
    protected static $responseClass = UserResponse::class;
    /**
     * @var array
     */
    protected $possibleParams = [
        'id'    => 'string',
        'login' => 'string'
    ];
    /**
     * @var UserResponse
     */
    protected $response;
    /**
     * @var array
     */
    protected $authentication = ['authorization_optional'];

    public function __construct(TwitchApi $api, array $params = [])
    {
        $this->url = Endpoints::TWITCH_API_URL;
        $this->endpoint = Endpoints::GET_GAMES;

        parent::__construct($api, $params);
    }

    /**
     * @param array $params
     *
     * @return Users
     */
    public function setParams(array $params = []): Users
    {
        return $this->traitSetParams($params);
    }

    /**
     * @return UserResponse
     * @throws \Forien\Exceptions\ApiException
     * @throws \Forien\Exceptions\TwitchApiException
     */
    public function get(): UserResponse
    {
        return parent::get();
    }
}