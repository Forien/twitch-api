<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:24
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class Games
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class Games extends BaseResponse
{
    /**
     * @var GamesData[]
     */
    public $data = [];

    public function __construct($response)
    {
        foreach ($response->data as $data) {
            $this->data[] = new GamesData($data);
        }

        parent::__construct($response);
    }
}