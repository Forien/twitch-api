<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 16.04.2018
 * Time: 21:42
 */

namespace Forien\Api\Twitch\Traits;


use Forien\TwitchApi;

trait Parameterizable
{
    public function __construct(TwitchApi $api, array $params = [])
    {
        $this->api = $api;

        if (count($params)) {
            $this->setParams($params);
        }
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params = [])
    {
        $parameters = [];
        foreach ($params as $param => $value) {
            if (!empty($this->possibleParams[$param])) {
                settype($value, $this->possibleParams[$param]);
                $parameters[$param] = $value;
            }
        }

        $this->params = $parameters;

        return $this;
    }
}