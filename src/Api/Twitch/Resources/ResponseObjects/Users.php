<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:24
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class Users
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class Users extends BaseResponse
{
    /**
     * @var UsersData[]
     */
    public $data = [];

    public function __construct($response)
    {
        foreach ($response->data as $data) {
            $this->data[] = new UsersData($data);
        }

        parent::__construct($response);
    }
}