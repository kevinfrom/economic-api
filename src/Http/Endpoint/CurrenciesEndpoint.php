<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Data\Entity\CurrencyEntity;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Errors;
use Kevinfrom\EconomicApi\Http\Traits\Http;
use RuntimeException;

final class CurrenciesEndpoint
{
    use Http;

    /**
     * @param AuthConfig $authConfig
     *
     * @return Collection<CurrencyEntity>|Errors
     * @throws \ReflectionException
     */
    public static function get(AuthConfig $authConfig): Collection|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, '/currencies');

        if ($response->isOk()) {
            $data = json_decode($response->getJson(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response');
            }

            if (!isset($data['collection'])) {
                throw new RuntimeException('Failed to find collection in JSON response');
            }

            return new Collection(array_map(function (mixed $item): object {
                if (!is_array($item)) {
                    throw new RuntimeException('Collection item is not an array');
                }

                return EntityMapper::toEntity(CurrencyEntity::class, json_encode($item));
            }, $data['collection']));
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }

    /**
     * @param AuthConfig $authConfig
     * @param string     $code
     *
     * @return CurrencyEntity|null
     * @throws \ReflectionException
     */
    public static function getByCode(AuthConfig $authConfig, string $code): ?CurrencyEntity
    {
        $response = self::request(HttpMethod::GET, $authConfig, "/currencies/$code");

        if ($response->isOk()) {
            return EntityMapper::toEntity(CurrencyEntity::class, $response->getJson());
        }

        return null;
    }
}
