<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 15.04.2018
 * Time: 22:01
 */

namespace Forien\Api;


use Forien\Exceptions\ApiException;

class RequestBuilder
{
    /**
     * @var string
     */
    private $url;

    /**
     * RequestBuilder constructor.
     *
     * @param string $url
     * @param string $endpoint
     * @param array  $params
     *
     * @throws ApiException
     */
    public function __construct(string $url, string $endpoint, array $params = [])
    {
        $queryString = http_build_query($params);

        $result = $url . $endpoint . '?' . $queryString;

        if (filter_var($result, FILTER_VALIDATE_URL) === false) {
            throw new ApiException("Invalid URL: '{$url}' ({$url}, {$endpoint})");
        }

        $this->url = $result;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }
}