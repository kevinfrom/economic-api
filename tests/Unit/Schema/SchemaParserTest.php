<?php

namespace Kevinfrom\EconomicApi\Tests\Unit\Schema;

use Kevinfrom\EconomicApi\Data\Schema\SchemaParser;
use PHPUnit\Framework\TestCase;

class SchemaParserTest extends TestCase
{
    public function testParseGetVatZoneByVatNumberSchema(): void
    {
        $expectedMd5Hash = '716f532bd58ea27991f9032f020f6830';
        $schemaJson      = '{"$schema":"http://json-schema.org/draft-03/schema#","title":"Vat zone GET schema","description":"A schema for retrieval of a single vat zone.","type":"object","restdocs":"http://restdocs.e-conomic.com/#get-vat-zones-vatzonenumber","properties":{"vatZoneNumber":{"type":"integer","description":"A unique identifier of the vat zone."},"name":{"type":"string","maxLength":50,"description":"The name of the vat zone."},"enabledForCustomer":{"type":"boolean","description":"If this value is true, then the vat zone can be used for a customer."},"enabledForSupplier":{"type":"boolean","description":"If this value is true, then the vat zone can be used for a supplier."},"self":{"type":"string","format":"uri","description":"A unique link reference to the vat zone item.","required":true}}}';

        $vatZoneEntitySchema = SchemaParser::buildClassFromJson($schemaJson, 'VatZoneEntity', 'Kevinfrom\EconomicApi\Data\Entity');

        $this->assertEquals($expectedMd5Hash, md5($vatZoneEntitySchema));
    }
}
