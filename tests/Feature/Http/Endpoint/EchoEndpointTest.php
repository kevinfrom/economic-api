<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Endpoint\EchoEndpoint;
use PHPUnit\Framework\TestCase;

class EchoEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authConfig = AuthConfig::createFromEnv();
    }

    public function testEchoEndpointGet(): void
    {
        $response = EchoEndpoint::get($this->authConfig);

        $this->assertEmpty($response);
    }

    public function testEchoEndpointPost(): void
    {
        $response = EchoEndpoint::post($this->authConfig, []);

        $this->assertEmpty($response);
    }

    public function testEchoEndpointPut(): void
    {
        $response = EchoEndpoint::put($this->authConfig, []);

        $this->assertEmpty($response);
    }

    public function testEchoEndpointPatch(): void
    {
        $response = EchoEndpoint::patch($this->authConfig, []);

        $this->assertEmpty($response);
    }

    public function testEchoEndpointDelete(): void
    {
        $response = EchoEndpoint::delete($this->authConfig);

        $this->assertEmpty($response);
    }
}
