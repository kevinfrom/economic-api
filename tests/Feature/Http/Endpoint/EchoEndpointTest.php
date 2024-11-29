<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Endpoint\EchoEndpoint;
use Kevinfrom\EconomicApi\Http\Response;
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

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Collection::class, $response->getData());
        $this->assertEmpty($response->getData()->first());
    }

    public function testEchoEndpointPost(): void
    {
        $response = EchoEndpoint::post($this->authConfig, []);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Collection::class, $response->getData());
        $this->assertEmpty($response->getData()->first());
    }

    public function testEchoEndpointPut(): void
    {
        $response = EchoEndpoint::put($this->authConfig, []);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Collection::class, $response->getData());
        $this->assertEmpty($response->getData()->first());
    }

    public function testEchoEndpointPatch(): void
    {
        $response = EchoEndpoint::patch($this->authConfig, []);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Collection::class, $response->getData());
        $this->assertEmpty($response->getData()->first());
    }

    public function testEchoEndpointDelete(): void
    {
        $response = EchoEndpoint::delete($this->authConfig);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(Collection::class, $response->getData());
        $this->assertEmpty($response->getData()->first());
    }
}
