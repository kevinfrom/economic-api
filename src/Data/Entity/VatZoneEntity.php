<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class VatZoneEntity
{
    /**
     * @param int $vatZoneNumber A unique identifier of the vat zone.
     * @param string $name The name of the vat zone (max length: 50).
     * @param bool $enabledForCustomer If true, the vat zone can be used for a customer.
     * @param bool $enabledForSupplier If true, the vat zone can be used for a supplier.
     * @param string $self A unique link reference to the vat zone item.
     */
    public function __construct(
        public int    $vatZoneNumber,
        public string $name,
        public bool   $enabledForCustomer,
        public bool   $enabledForSupplier,
        public string $self
    )
    {
    }
}
