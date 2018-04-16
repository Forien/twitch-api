<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:48
 */

namespace Forien\Api\Twitch\Resources;


use Forien\Api\Twitch\Traits\Parameterizable;
use Forien\TwitchApi;

class BaseResource
{
    use Parameterizable {
        __construct as __traitConstruct;
        setParams as traitSetParams;
    }

    /**
     * @var array
     */
    protected $possibleParams = [];
    /**
     * @var null|array
     */
    protected $authentication = null;
    /**
     * @var \Forien\Api\Twitch\Resources\ResponseObjects\BaseResponse
     */
    protected $response;
    /**
     * @var array
     */
    protected $params;
    /**
     * @var TwitchApi;
     */
    protected $api;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var bool
     */
    protected $called = false;

    /**
     * @return array|null
     */
    public function getAuthentication(): array
    {
        return $this->authentication;
    }

    /**
     * @return ResponseObjects\BaseResponse
     */
    public function getResponse(): ResponseObjects\BaseResponse
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}