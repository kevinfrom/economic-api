<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Errors;
use Kevinfrom\EconomicApi\Http\Traits\Http;
use Kevinfrom\EconomicApi\Data\Entity\VatZoneEntity;
use RuntimeException;

class VatZonesEndpoint
{
    use Http;

    /**
     * Get a collection of VAT zones.
     *
     * @param AuthConfig $authConfig
     * @return Collection<VatZoneEntity>|Errors
     * @throws \ReflectionException
     */
    public static function get(AuthConfig $authConfig): Collection|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, 'vat-zones');

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

                return EntityMapper::toEntity(VatZoneEntity::class, json_encode($item));
            }, $data['collection']));
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }

    /**
     * Get a single VAT zone by its number.
     *
     * @param AuthConfig $authConfig
     * @param int $vatZoneNumber
     * @return VatZoneEntity|Errors
     * @throws \ReflectionException
     */
    public static function getByVatZoneNumber(AuthConfig $authConfig, int $vatZoneNumber): VatZoneEntity|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, "vat-zones/$vatZoneNumber");

        if ($response->isOk()) {
            return EntityMapper::toEntity(VatZoneEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }
}
