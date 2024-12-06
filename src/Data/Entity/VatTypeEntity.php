<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class VatTypeEntity
{
    /**
     * @param int    $vatTypeNumber A unique identifier of the vat type.
     * @param string $name Name of the vat type.
     * @param string $self A unique link reference to the vat type item.
     */
    public function __construct(
        public int $vatTypeNumber,
        public string $name,
        public string $self
    ) {
    }
}
