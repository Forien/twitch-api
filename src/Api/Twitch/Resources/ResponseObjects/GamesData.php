<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:27
 */

namespace Forien\Api\Twitch\Resources\ResponseObjects;


/**
 * Class GamesData
 *
 * @package Forien\Api\Twitch\Resources\ResponseObjects
 */
class GamesData
{
    /**
     * @var string
     */
    public $boxArtUrl;
    /**
     * @var string
     */
    public $boxArtUrlMedium;
    /**
     * @var string
     */
    public $boxArtUrlSmall;
    /**
     * @var string
     */
    public $boxArtUrlLarge;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $id;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->boxArtUrl = $data->box_art_url;
        $replace = [
            ['{width}', '{height}'],
            ['285', '380'],
            ['135', '180'],
            ['75', '100'],
            ['750', '1000'],
        ];
        $this->boxArtUrl = str_replace($replace[0], $replace[1], $this->boxArtUrl);
        $this->boxArtUrlMedium = str_replace($replace[0], $replace[2], $this->boxArtUrl);
        $this->boxArtUrlSmall = str_replace($replace[0], $replace[3], $this->boxArtUrl);
        $this->boxArtUrlLarge = str_replace($replace[0], $replace[4], $this->boxArtUrl);
    }
}