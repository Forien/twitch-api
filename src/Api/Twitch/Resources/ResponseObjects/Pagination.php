<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:28
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class Pagination
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class Pagination
{
    /**
     * @var string
     */
    public $cursor;

    public function __construct($pagination)
    {
        if (isset($pagination->cursor)) {
            $this->cursor = $pagination->cursor;
        }
    }
}