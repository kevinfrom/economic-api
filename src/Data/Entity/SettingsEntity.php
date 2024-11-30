<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class SettingsEntity
{
    /**
     * @param string|null $baseCurrency The ISO 4217 code of the company's base currency. Default: null.
     * @param string|null $defaultPaymentTerm The default payment term for the customers of the company. Default: null.
     * @param string|null $internationalLedger If this value is 'true' then the international ledger is used. Default: null.
     */
    public function __construct(
        public ?string $baseCurrency = null,
        public ?string $defaultPaymentTerm = null,
        public ?string $internationalLedger = null
    )
    {
    }
}
