<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use PHPUnit\Framework\TestCase;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Endpoint\SelfEndpoint;
use Kevinfrom\EconomicApi\Data\Entity\SelfEntity;

final class SelfEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authConfig = AuthConfig::createFromEnv();
    }

    public function testSelfEndpointGet(): void
    {
        $selfEntity = SelfEndpoint::get($this->authConfig);

        $this->assertInstanceOf(SelfEntity::class, $selfEntity);
        $this->assertIsInt($selfEntity->agreementNumber);
        $this->assertIsString($selfEntity->self);
    }
}
