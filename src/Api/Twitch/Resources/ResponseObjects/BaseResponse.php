<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:50
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


class BaseResponse
{
    /**
     * @var Pagination
     */
    public $pagination;

    protected function __construct($response)
    {
        $this->pagination = new Pagination($response);
    }
}