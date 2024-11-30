<?php

namespace Kevinfrom\EconomicApi\Tests\Unit\Mapper;

use Kevinfrom\EconomicApi\Data\Entity\AgreementTypeEntity;
use Kevinfrom\EconomicApi\Data\Entity\LanguageEntity;
use Kevinfrom\EconomicApi\Data\Entity\UserEntity;
use PHPUnit\Framework\TestCase;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;

final class EntityMapperTest extends TestCase
{
    private int $agreementTypeNumber = 1;
    private string $name = 'name';

    private string $agreementTypeJson;

    protected function setUp(): void
    {
        parent::setUp();

        $this->agreementTypeJson = json_encode([
            'agreementTypeNumber' => $this->agreementTypeNumber,
            'name' => $this->name,
        ]);
    }

    public function testToJson(): void
    {
        $agreementType = new AgreementTypeEntity(1, 'name');

        $agreementTypeJson = EntityMapper::toJSON($agreementType);

        $this->assertJson($agreementTypeJson);
        $this->assertEquals($this->agreementTypeJson, $agreementTypeJson);
    }

    public function testToSimpleEntity(): void
    {
        $agreementType = EntityMapper::toEntity(AgreementTypeEntity::class, $this->agreementTypeJson);

        $this->assertInstanceOf(AgreementTypeEntity::class, $agreementType);
        $this->assertEquals(1, $agreementType->agreementTypeNumber);
        $this->assertEquals('name', $agreementType->name);
    }

    public function testToNestedEntity(): void
    {
        $testData = [
            'loginId' => 'userLoginId',
            'email' => 'userEmail',
            'name' => 'userName',
            'agreementNumber' => 1,
            'language' => [
                'self' => 'https://restapi.e-conomic.com/languages/2',
                'languageNumber' => 2,
                'name' => 'language',
                'culture' => 'da-DK',
            ],
        ];

        $testDataJson = json_encode($testData);

        $userEntity = EntityMapper::toEntity(UserEntity::class, $testDataJson);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertEquals($testData['loginId'], $userEntity->loginId);
        $this->assertEquals($testData['email'], $userEntity->email);
        $this->assertEquals($testData['name'], $userEntity->name);
        $this->assertEquals($testData['agreementNumber'], $userEntity->agreementNumber);

        $this->assertInstanceOf(LanguageEntity::class, $userEntity->language);
        $this->assertEquals($testData['language']['languageNumber'], $userEntity->language->languageNumber);
        $this->assertEquals($testData['language']['name'], $userEntity->language->name);
    }

    public function testToArray(): void
    {
        $agreementType = new AgreementTypeEntity(1, 'name');

        $agreementTypeArray = EntityMapper::toArray($agreementType);

        $this->assertIsArray($agreementTypeArray);
        $this->assertArrayHasKey('agreementTypeNumber', $agreementTypeArray);
        $this->assertArrayHasKey('name', $agreementTypeArray);
        $this->assertEquals($this->agreementTypeNumber, $agreementTypeArray['agreementTypeNumber']);
        $this->assertEquals($this->name, $agreementTypeArray['name']);
    }
}
