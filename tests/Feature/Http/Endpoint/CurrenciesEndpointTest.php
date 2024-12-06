<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Data\Entity\CurrencyEntity;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use Kevinfrom\EconomicApi\Http\Endpoint\CurrenciesEndpoint;
use PHPUnit\Framework\TestCase;

class CurrenciesEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authConfig = AuthConfig::createFromEnv();
    }

    public function testGetCollectionOfCurrencies(): void
    {
        $currencies = CurrenciesEndpoint::get($this->authConfig);

        $this->assertInstanceOf(Collection::class, $currencies);
        $this->assertInstanceOf(CurrencyEntity::class, $currencies->first());

        $this->assertIsString($currencies->first()->name);
        $this->assertIsString($currencies->first()->self);
        $this->assertIsString($currencies->first()->code);
        $this->assertIsString($currencies->first()->isoNumber);
    }

    public function testGetSingleCurrency(): void
    {
        $currency = CurrenciesEndpoint::getByCode($this->authConfig, 'DKK');

        $this->assertInstanceOf(CurrencyEntity::class, $currency);
        $this->assertIsString($currency->name);
        $this->assertIsString($currency->self);
        $this->assertIsString($currency->code);
        $this->assertIsString($currency->isoNumber);
    }
}
