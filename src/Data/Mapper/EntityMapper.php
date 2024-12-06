<?php

namespace Kevinfrom\EconomicApi\Data\Mapper;

use InvalidArgumentException;
use Kevinfrom\EconomicApi\Data\Entity\AccountEntity;
use Kevinfrom\EconomicApi\Data\Entity\AgreementTypeEntity;
use Kevinfrom\EconomicApi\Data\Entity\ApplicationEntity;
use Kevinfrom\EconomicApi\Data\Entity\BankInformationEntity;
use Kevinfrom\EconomicApi\Data\Entity\CompanyEntity;
use Kevinfrom\EconomicApi\Data\Entity\ContactEntity;
use Kevinfrom\EconomicApi\Data\Entity\CurrencyEntity;
use Kevinfrom\EconomicApi\Data\Entity\CustomerEntity;
use Kevinfrom\EconomicApi\Data\Entity\CustomerGroupEntity;
use Kevinfrom\EconomicApi\Data\Entity\DeliveryLocationEntity;
use Kevinfrom\EconomicApi\Data\Entity\EmployeeEntity;
use Kevinfrom\EconomicApi\Data\Entity\EmployeeGroupEntity;
use Kevinfrom\EconomicApi\Data\Entity\LanguageEntity;
use Kevinfrom\EconomicApi\Data\Entity\LayoutEntity;
use Kevinfrom\EconomicApi\Data\Entity\ModuleEntity;
use Kevinfrom\EconomicApi\Data\Entity\PaymentTermsEntity;
use Kevinfrom\EconomicApi\Data\Entity\RoleEntity;
use Kevinfrom\EconomicApi\Data\Entity\SettingsEntity;
use Kevinfrom\EconomicApi\Data\Entity\UserEntity;
use Kevinfrom\EconomicApi\Data\Entity\VatAccountEntity;
use Kevinfrom\EconomicApi\Data\Entity\VatTypeEntity;
use Kevinfrom\EconomicApi\Data\Entity\VatZoneEntity;
use ReflectionClass;

final class EntityMapper
{
    /**
     * Maps keys to singular entities.
     */
    private static array $keyToEntityMap = [
        'account'                 => AccountEntity::class,
        'agreementType'           => AgreementTypeEntity::class,
        'application'             => ApplicationEntity::class,
        'attention'               => ContactEntity::class,
        'bankInformation'         => BankInformationEntity::class,
        'company'                 => CompanyEntity::class,
        'contact'                 => ContactEntity::class,
        'contraAccount'           => AccountEntity::class,
        'currency'                => CurrencyEntity::class,
        'customer'                => CustomerEntity::class,
        'customerContact'         => ContactEntity::class,
        'customerGroup'           => CustomerGroupEntity::class,
        'defaultDeliveryLocation' => DeliveryLocationEntity::class,
        'employee'                => EmployeeEntity::class,
        'employeeGroup'           => EmployeeGroupEntity::class,
        'language'                => LanguageEntity::class,
        'layout'                  => LayoutEntity::class,
        'paymentTerms'            => PaymentTermsEntity::class,
        'settings'                => SettingsEntity::class,
        'user'                    => UserEntity::class,
        'vatAccount'              => VatAccountEntity::class,
        'vatType'                 => VatTypeEntity::class,
        'vatZone'                 => VatZoneEntity::class,
    ];

    /**
     * Maps keys to arrays of entities.
     *
     * @var array<string, class-string>
     */
    private static array $keysToEntitiesArrayMap = [
        'modules'       => ModuleEntity::class,
        'requiredRoles' => RoleEntity::class,
    ];

    /**
     * Returns a JSON representation of an entity object.
     *
     * @param object $entity
     *
     * @return string
     */
    public static function toJSON(object $entity): string
    {
        return json_encode($entity);
    }

    /**
     * Maps a JSON string to an entity object.
     *
     * @template T
     * @param class-string<T> $entityClass
     * @param string          $json
     *
     * @return T
     *
     * @throws \ReflectionException
     */
    public static function toEntity(string $entityClass, string $json): object
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON');
        }

        if (!is_array($data)) {
            var_dump(compact('entityClass', 'data'));
            throw new InvalidArgumentException('JSON must be an array');
        }

        $args = [];

        $reflectionClass = new ReflectionClass($entityClass);
        $constructor     = $reflectionClass->getConstructor();

        if ($constructor) {
            foreach ($constructor->getParameters() as $param) {
                $paramName         = $param->getName();
                $paramType         = $param->getType();
                $paramDefaultValue = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;

                if (isset($data[$paramName])) {
                    if ($paramType && $paramType->isBuiltin() === false && isset(self::$keyToEntityMap[$paramName])) {
                        $args[] = self::toEntity(self::$keyToEntityMap[$paramName], json_encode($data[$paramName]));
                    } elseif (is_array($data[$paramName]) && isset(self::$keysToEntitiesArrayMap[$paramName])) {
                        $args[] = array_map(fn($item) => self::toEntity(self::$keysToEntitiesArrayMap[$paramName], json_encode($item)), $data[$paramName]);
                    } else {
                        $args[] = $data[$paramName];
                    }
                } else {
                    $args[] = $paramDefaultValue;
                }
            }
        }

        return $reflectionClass->newInstanceArgs($args);
    }

    /**
     * Maps an entity object to an associative array.
     *
     * @param string|object $entity
     *
     * @return array
     */
    public static function toArray(string|object $entity): array
    {
        $json = $entity;
        if (is_object($entity)) {
            $json = self::toJSON($entity);
        }

        $result = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON');
        }

        if (!is_array($result)) {
            throw new InvalidArgumentException('JSON must be an array');
        }

        return $result;
    }
}
