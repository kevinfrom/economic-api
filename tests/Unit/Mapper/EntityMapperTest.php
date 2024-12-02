<?php

namespace Kevinfrom\EconomicApi\Tests\Unit\Mapper;

use Kevinfrom\EconomicApi\Data\Entity\AgreementTypeEntity;
use Kevinfrom\EconomicApi\Data\Entity\ApplicationEntity;
use Kevinfrom\EconomicApi\Data\Entity\LanguageEntity;
use Kevinfrom\EconomicApi\Data\Entity\ModuleEntity;
use Kevinfrom\EconomicApi\Data\Entity\RoleEntity;
use Kevinfrom\EconomicApi\Data\Entity\SelfEntity;
use Kevinfrom\EconomicApi\Data\Entity\UserEntity;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;
use PHPUnit\Framework\TestCase;

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
            'name'                => $this->name,
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
            'loginId'         => 'userLoginId',
            'email'           => 'userEmail',
            'name'            => 'userName',
            'agreementNumber' => 1,
            'language'        => [
                'self'           => 'https://restapi.e-conomic.com/languages/2',
                'languageNumber' => 2,
                'name'           => 'language',
                'culture'        => 'da-DK',
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

    public function testToArrayOfEntities(): void
    {
        $testData = [
            'self'           => 'https://restapi.e-conomic.com/application/1',
            'appNumber'      => 1,
            'name'           => 'Application 1',
            'appPublicToken' => 'publicToken',
            'created'        => '2021-01-01',
            'requiredRoles'  => [
                [
                    'roleNumber' => 1,
                    'name'       => 'Role 1',
                    'self'       => 'https://restapi.e-conomic.com/roles/1',
                ],
                [
                    'roleNumber' => 2,
                    'name'       => 'Role 2',
                    'self'       => 'https://restapi.e-conomic.com/roles/2',
                ],
                [
                    'roleNumber' => 3,
                    'name'       => 'Role 3',
                    'self'       => 'https://restapi.e-conomic.com/roles/3',
                ],
            ],
        ];

        $applicationEntity = EntityMapper::toEntity(ApplicationEntity::class, json_encode($testData));

        $this->assertInstanceOf(ApplicationEntity::class, $applicationEntity);
        $this->assertEquals($testData['self'], $applicationEntity->self);
        $this->assertEquals($testData['appNumber'], $applicationEntity->appNumber);
        $this->assertEquals($testData['name'], $applicationEntity->name);
        $this->assertEquals($testData['appPublicToken'], $applicationEntity->appPublicToken);
        $this->assertEquals($testData['created'], $applicationEntity->created);

        $this->assertCount(count($testData['requiredRoles']), $applicationEntity->requiredRoles);

        $this->assertInstanceOf(RoleEntity::class, $applicationEntity->requiredRoles[0]);
        $this->assertEquals($testData['requiredRoles'][0]['roleNumber'], $applicationEntity->requiredRoles[0]->roleNumber);
        $this->assertEquals($testData['requiredRoles'][0]['name'], $applicationEntity->requiredRoles[0]->name);
        $this->assertEquals($testData['requiredRoles'][0]['self'], $applicationEntity->requiredRoles[0]->self);

        $this->assertInstanceOf(RoleEntity::class, $applicationEntity->requiredRoles[1]);
        $this->assertEquals($testData['requiredRoles'][1]['roleNumber'], $applicationEntity->requiredRoles[1]->roleNumber);
        $this->assertEquals($testData['requiredRoles'][1]['name'], $applicationEntity->requiredRoles[1]->name);
        $this->assertEquals($testData['requiredRoles'][1]['self'], $applicationEntity->requiredRoles[1]->self);

        $this->assertInstanceOf(RoleEntity::class, $applicationEntity->requiredRoles[2]);
        $this->assertEquals($testData['requiredRoles'][2]['roleNumber'], $applicationEntity->requiredRoles[2]->roleNumber);
        $this->assertEquals($testData['requiredRoles'][2]['name'], $applicationEntity->requiredRoles[2]->name);
        $this->assertEquals($testData['requiredRoles'][2]['self'], $applicationEntity->requiredRoles[2]->self);
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
            'self'            => 'https://restapi.e-conomic.com/self',
            'modules'         => [
                [
                    'moduleNumber' => 1,
                    'name'         => 'Module 1',
                    'self'         => 'https://restapi.e-conomic.com/modules/1',
                ],
                [
                    'moduleNumber' => 2,
                    'name'         => 'Module 2',
                    'self'         => 'https://restapi.e-conomic.com/modules/2',
                ],
                [
                    'moduleNumber' => 3,
                    'name'         => 'Module 3',
                    'self'         => 'https://restapi.e-conomic.com/modules/3',
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
