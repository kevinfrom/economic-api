<?php

namespace Kevinfrom\EconomicApi\Tests\Unit\Entity;

use Kevinfrom\EconomicApi\Data\Entity\VatZoneEntity;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

final class VatZoneEntityTest extends TestCase
{
    public function testVatZoneEntity(): void
    {
        $testData = [
            'self'               => 'https://restapi.e-conomic.com/vat-zones/1',
            'vatZoneNumber'      => 1,
            'name'               => 'Domestic',
            'enabledForCustomer' => true,
            'enabledForSupplier' => true,
        ];

        $vatZoneEntity = new VatZoneEntity(...$testData);

        $this->assertInstanceOf(VatZoneEntity::class, $vatZoneEntity);
        $this->assertEquals($testData['self'], $vatZoneEntity->self);
        $this->assertEquals($testData['vatZoneNumber'], $vatZoneEntity->vatZoneNumber);
        $this->assertEquals($testData['name'], $vatZoneEntity->name);
        $this->assertEquals($testData['enabledForCustomer'], $vatZoneEntity->enabledForCustomer);
        $this->assertEquals($testData['enabledForSupplier'], $vatZoneEntity->enabledForSupplier);
    }

    public function testMissingPropertiesFromResponse(): void
    {
        $jsonSchema         = '{"$schema":"http://json-schema.org/draft-03/schema#","title":"Vat zone GET schema","description":"A schema for retrieval of a single vat zone.","type":"object","restdocs":"http://restdocs.e-conomic.com/#get-vat-zones-vatzonenumber","properties":{"vatZoneNumber":{"type":"integer","description":"A unique identifier of the vat zone."},"name":{"type":"string","maxLength":50,"description":"The name of the vat zone."},"enabledForCustomer":{"type":"boolean","description":"If this value is true, then the vat zone can be used for a customer."},"enabledForSupplier":{"type":"boolean","description":"If this value is true, then the vat zone can be used for a supplier."},"self":{"type":"string","format":"uri","description":"A unique link reference to the vat zone item.","required":true}}}';
        $expectedProperties = array_keys(json_decode($jsonSchema, true)['properties']);

        $reflectionClass  = new ReflectionClass(VatZoneEntity::class);
        $actualProperties = array_map(fn($property) => $property->getName(), $reflectionClass->getProperties());

        sort($expectedProperties);
        sort($actualProperties);

        $this->assertEquals($expectedProperties, $actualProperties);
    }
}
