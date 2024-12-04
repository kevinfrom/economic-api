<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class VatZoneEntity
{
    /**
     * @param string      $self A unique link reference to the vat zone item.
     * @param int|null    $vatZoneNumber A unique identifier of the vat zone.
     * @param string|null $name The name of the vat zone (max length: 50).
     * @param bool|null   $enabledForCustomer If true, the vat zone can be used for a customer.
     * @param bool|null   $enabledForSupplier If true, the vat zone can be used for a supplier.
     */
    public function __construct(
        public string $self,
        public ?int $vatZoneNumber = null,
        public ?string $name = null,
        public ?bool $enabledForCustomer = null,
        public ?bool $enabledForSupplier = null,
    ) {
    }
}
