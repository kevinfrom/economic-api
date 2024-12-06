<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class CurrencyEntity
{
    /**
     * @param string      $name The name of the currency
     * @param string      $self The self link of the currency
     * @param string|null $code The code of the currency
     * @param string|null $isoNumber The iso number of the currency
     */
    public function __construct(
        public string $name,
        public string $self,
        public ?string $code = null,
        public ?string $isoNumber = null
    ) {
    }
}
