<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 15.04.2018
 * Time: 21:38
 */

namespace Forien\Api\Twitch;

use Forien\Api\BaseEndpoints;

/**
 * Class Endpoints
 *
 * @package Forien\Api\Twitch
 */
abstract class Endpoints extends BaseEndpoints
{
    const TWITCH_ID_URL = 'https://id.twitch.tv/oauth2/';

    const AUTHORIZE = 'authorize';
    const TOKEN     = 'token';
    const REFRESH   = 'token';

    const TWITCH_API_URL = 'https://api.twitch.tv/helix/';

    const GET_STREAMS = 'streams';
    const GET_GAMES = 'games';
    const GET_USERS = 'users';
}