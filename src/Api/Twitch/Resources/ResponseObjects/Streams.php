<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:24
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class Streams
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class Streams extends BaseResponse
{
    /**
     * @var StreamsData[]
     */
    public $data = [];

    public function __construct($response)
    {
        foreach ($response->data as $data) {
            $this->data[] = new StreamsData($data);
        }

        parent::__construct($response);
    }
}