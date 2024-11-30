<?php

namespace Kevinfrom\EconomicApi\Tests\Unit\Mapper;

use Kevinfrom\EconomicApi\Data\Entity\AgreementTypeEntity;
use Kevinfrom\EconomicApi\Data\Entity\LanguageEntity;
use Kevinfrom\EconomicApi\Data\Entity\ModuleEntity;
use Kevinfrom\EconomicApi\Data\Entity\SelfEntity;
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

    public function testToEntityWithNestedArrayOfEntities(): void
    {
        $testData = [
            'agreementNumber' => 1,
            'self' => 'https://restapi.e-conomic.com/self',
            'modules' => [
                [
                    'moduleNumber' => 1,
                    'name' => 'Module 1',
                    'self' => 'https://restapi.e-conomic.com/modules/1',
                ],
                [
                    'moduleNumber' => 2,
                    'name' => 'Module 2',
                    'self' => 'https://restapi.e-conomic.com/modules/2',
                ],
                [
                    'moduleNumber' => 3,
                    'name' => 'Module 3',
                    'self' => 'https://restapi.e-conomic.com/modules/3',
                ],
            ],
        ];

        $testDataJson = json_encode($testData);

        $selfEntity = EntityMapper::toEntity(SelfEntity::class, $testDataJson);

        $this->assertInstanceOf(SelfEntity::class, $selfEntity);
        $this->assertEquals($testData['agreementNumber'], $selfEntity->agreementNumber);
        $this->assertEquals($testData['self'], $selfEntity->self);

        $this->assertCount(count($testData['modules']), $selfEntity->modules);
        $this->assertInstanceOf(ModuleEntity::class, $selfEntity->modules[0]);
        $this->assertEquals($testData['modules'][0]['moduleNumber'], $selfEntity->modules[0]->moduleNumber);
        $this->assertEquals($testData['modules'][0]['name'], $selfEntity->modules[0]->name);
        $this->assertEquals($testData['modules'][0]['self'], $selfEntity->modules[0]->self);

        $this->assertEquals($testData['modules'][1]['moduleNumber'], $selfEntity->modules[1]->moduleNumber);
        $this->assertEquals($testData['modules'][1]['name'], $selfEntity->modules[1]->name);
        $this->assertEquals($testData['modules'][1]['self'], $selfEntity->modules[1]->self);
        $this->assertInstanceOf(ModuleEntity::class, $selfEntity->modules[1]);

        $this->assertEquals($testData['modules'][2]['moduleNumber'], $selfEntity->modules[2]->moduleNumber);
        $this->assertEquals($testData['modules'][2]['name'], $selfEntity->modules[2]->name);
        $this->assertEquals($testData['modules'][2]['self'], $selfEntity->modules[2]->self);
        $this->assertInstanceOf(ModuleEntity::class, $selfEntity->modules[2]);
    }
}
