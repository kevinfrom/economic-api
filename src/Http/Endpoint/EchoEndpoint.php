<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Response;
use Kevinfrom\EconomicApi\Http\Traits\Http;

final class EchoEndpoint
{
    use Http;

    /**
     * Perform a GET request to the echo endpoint.
     *
     * @param AuthConfig $authConfig
     *
     * @return Response
     */
    public static function get(AuthConfig $authConfig): Response
    {
        return self::request(HttpMethod::GET, $authConfig, '/echo');
    }

    /**
     * Perform a POST request to the echo endpoint.
     *
     * @param AuthConfig $authConfig
     * @param array      $data
     *
     * @return Response
     */
    public static function post(AuthConfig $authConfig, array $data): Response
    {
        return self::request(HttpMethod::POST, $authConfig, '/echo', $data);
    }

    /**
     * Perform a PUT request to the echo endpoint.
     *
     * @param AuthConfig $authConfig
     * @param array      $data
     *
     * @return Response
     */
    public static function put(AuthConfig $authConfig, array $data): Response
    {
        return self::request(HttpMethod::PUT, $authConfig, '/echo', $data);
    }

    /**
     * Perform a PATCH request to the echo endpoint.
     *
     * @param AuthConfig $authConfig
     * @param array      $data
     *
     * @return Response
     */
    public static function patch(AuthConfig $authConfig, array $data): Response
    {
        return self::request(HttpMethod::PATCH, $authConfig, '/echo', $data);
    }

    /**
     * Perform a DELETE request to the echo endpoint.
     *
     * @param AuthConfig $authConfig
     *
     * @return Response
     */
    public static function delete(AuthConfig $authConfig): Response
    {
        return self::request(HttpMethod::DELETE, $authConfig, '/echo');
    }
}
