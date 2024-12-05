<?php

namespace Kevinfrom\EconomicApi\Tests\Feature\Http\Endpoint;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use Kevinfrom\EconomicApi\Http\Config\AuthConfig;
use PHPUnit\Framework\TestCase;
use Kevinfrom\EconomicApi\Http\Endpoint\CustomersEndpoint;
use Kevinfrom\EconomicApi\Data\Entity\CustomerEntity;

class CustomersEndpointTest extends TestCase
{
    private AuthConfig $authConfig;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authConfig = AuthConfig::createFromEnv();
    }
    public function testGetCollectionOfCustomers(): void
    {
        $customersCollection = CustomersEndpoint::get($this->authConfig);

        $this->assertInstanceOf(Collection::class, $customersCollection);
        $this->assertContainsOnlyInstancesOf(CustomerEntity::class, $customersCollection->toArray());

        $this->assertInstanceOf(CustomerEntity::class, $customersCollection->first());
        $this->assertIsNumeric($customersCollection->first()->customerNumber);
        $this->assertIsString($customersCollection->first()->self);
        $this->assertIsString($customersCollection->first()->name);
    }

    public function testGetSingleCustomer(): void
    {
        $customer = CustomersEndpoint::getByCustomerNumber($this->authConfig, 1);

        $this->assertInstanceOf(CustomerEntity::class, $customer);
        $this->assertEquals(1, $customer->customerNumber);
        $this->assertIsString($customer->self);
        $this->assertIsString($customer->name);
    }
}
