<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:27
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class StreamsData
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class StreamsData
{
    /**
     * @var string[]
     */
    public $communityIds;
    /**
     * @var string
     */
    public $gameId;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $language;
    /**
     * @var string
     */
    public $startedAt;
    /**
     * @var string
     */
    public $thumbnailUrl;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $userId;
    /**
     * @var int
     */
    public $viewerCount;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->userId = $data->user_id;
        $this->gameId = $data->game_id;
        $this->communityIds = $data->community_ids;
        $this->type = $data->type;
        $this->title = $data->title;
        $this->viewerCount = $data->viewer_count;
        $this->startedAt = $data->started_at;
        $this->language = $data->language;
        $this->thumbnailUrl = $data->thumbnail_url;
    }
}