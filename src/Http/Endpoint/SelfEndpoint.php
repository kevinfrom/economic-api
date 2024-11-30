<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Response;
use Kevinfrom\EconomicApi\Http\Traits\Http;

final class SelfEndpoint
{
    use Http;

    public static function get(AuthConfig $authConfig): Response
    {
        return self::request(HttpMethod::GET, $authConfig, '/self');
    }
}
