<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Entity\BankInformationEntity;
use Kevinfrom\EconomicApi\Data\Entity\CompanyEntity;
use Kevinfrom\EconomicApi\Data\Entity\SelfEntity;
use Kevinfrom\EconomicApi\Data\Entity\UserEntity;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Errors;
use Kevinfrom\EconomicApi\Http\Traits\Http;

final class SelfEndpoint
{
    use Http;

    public static function get(AuthConfig $authConfig): SelfEntity|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, '/self');

        if ($response->isOk()) {
            return EntityMapper::toEntity(SelfEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }

    public static function putUser(AuthConfig $authConfig, array|UserEntity $selfEntity): UserEntity|Errors
    {
        $data = !is_array($selfEntity) ? EntityMapper::toArray($selfEntity) : $selfEntity;

        $response = self::request(HttpMethod::PUT, $authConfig, '/self/user', $data);

        if ($response->isOk()) {
            return EntityMapper::toEntity(SelfEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }

    public static function putCompany(AuthConfig $authConfig, array|CompanyEntity $data): CompanyEntity|Errors
    {
        $data = !is_array($data) ? EntityMapper::toArray($data) : $data;

        $response = self::request(HttpMethod::PUT, $authConfig, '/self/company', $data);

        if ($response->isOk()) {
            return EntityMapper::toEntity(CompanyEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }

    public static function putCompanyBankInformation(AuthConfig $authConfig, array $data): BankInformationEntity|Errors
    {
        $response = self::request(HttpMethod::PUT, $authConfig, '/self/company/bank-information', $data);

        if ($response->isOk()) {
            return EntityMapper::toEntity(BankInformationEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }
}
