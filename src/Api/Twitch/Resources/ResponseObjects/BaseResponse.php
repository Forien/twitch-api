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

    public function __construct($response)
    {
        if (isset($response->pagination)) {
            $this->pagination = new Pagination($response->pagination);
        }
    }
}