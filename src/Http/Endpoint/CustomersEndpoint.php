<?php

namespace Kevinfrom\EconomicApi\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Data\Mapper\EntityMapper;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Enums\HttpMethod;
use Kevinfrom\EconomicApi\Http\Errors;
use Kevinfrom\EconomicApi\Http\Traits\Http;
use Kevinfrom\EconomicApi\Data\Entity\CustomerEntity;
use RuntimeException;

final class CustomersEndpoint
{
    use Http;

    /**
     * Get a collection of customers.
     *
     * @param AuthConfig $authConfig
     *
     * @return Collection<CustomerEntity>|Errors
     * @throws \ReflectionException
     */
    public static function get(AuthConfig $authConfig): Collection|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, '/customers');

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

                return EntityMapper::toEntity(CustomerEntity::class, json_encode($item));
            }, $data['collection']));
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }
    public static function getByCustomerNumber(AuthConfig $authConfig, int $customerNumber): CustomerEntity|Errors
    {
        $response = self::request(HttpMethod::GET, $authConfig, "/customers/$customerNumber");

        if ($response->isOk()) {
            return EntityMapper::toEntity(CustomerEntity::class, $response->getJson());
        }

        return EntityMapper::toEntity(Errors::class, $response->getJson());
    }
}
