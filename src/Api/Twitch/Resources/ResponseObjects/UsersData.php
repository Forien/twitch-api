<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:27
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class UsersData
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class UsersData
{
    /**
     * @var string
     */
    public $login;
    /**
     * @var string
     */
    public $displayName;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $broadcasterType;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $viewCount;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $profileImageUrl;
    /**
     * @var string
     */
    public $offlineImageUrl;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->login = $data->login;
        $this->displayName = $data->displayName;
        $this->type = $data->type;
        $this->broadcasterType = $data->broadcasterType;
        $this->description = $data->description;
        $this->profileImageUrl = $data->profileImageUrl;
        $this->offlineImageUrl = $data->offlineImageUrl;
        $this->viewCount = $data->viewCount;
        if (isset($data->email)) {
            $this->email = $data->email;
        }
    }
}