<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use PHPUnit\Framework\TestCase;
use Kevinfrom\EconomicApi\Http\Endpoint\VatZonesEndpoint;
use Kevinfrom\EconomicApi\Data\Entity\VatZoneEntity;

class VatZonesEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authConfig = AuthConfig::createFromEnv();
    }

    public function testGetCollectionOfVatZones(): void
    {
        $vatZones = VatZonesEndpoint::get($this->authConfig);

        $this->assertInstanceOf(Collection::class, $vatZones);
        $this->assertInstanceOf(VatZoneEntity::class, $vatZones->first());
        $this->assertGreaterThanOrEqual(1, $vatZones->count());
        $this->assertNotEmpty($vatZones->first()->vatZoneNumber);
        $this->assertNotEmpty($vatZones->first()->name);
        $this->assertNotEmpty($vatZones->first()->self);
    }

    public function testGetSingleVatZone(): void
    {
        $vatZoneNumber = VatZonesEndpoint::get($this->authConfig)->first()->vatZoneNumber;

        $vatZone = VatZonesEndpoint::getByVatZoneNumber($this->authConfig, $vatZoneNumber);

        $this->assertInstanceOf(VatZoneEntity::class, $vatZone);
        $this->assertEquals($vatZoneNumber, $vatZone->vatZoneNumber);
        $this->assertNotEmpty($vatZone->name);
        $this->assertNotEmpty($vatZone->self);
    }
}
