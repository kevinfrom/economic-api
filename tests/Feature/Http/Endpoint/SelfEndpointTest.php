<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Endpoint\SelfEndpoint;
use PHPUnit\Framework\TestCase;

class SelfEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authConfig = AuthConfig::createFromEnv();
    }

    public function testSelfEndpointGet(): void
    {
        $response = SelfEndpoint::get($this->authConfig);
    }
}
