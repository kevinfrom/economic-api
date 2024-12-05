<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class VatAccountEntity
{
    /**
     * @param string             $vatCode The alphanumerical code for the vat account.
     * @param string             $self A unique link reference to the vat account item.
     * @param AccountEntity|null $account The account for this vat account.
     * @param AccountEntity|null $contraAccount The contra account for this vat account.
     * @param VatTypeEntity|null $vatType The vat type for this vat account.
     * @param bool|null          $barred If true this vat account has been barred from further use.
     * @param string|null        $name The name of the vat account.
     * @param float|null         $ratePercentage The tax rate for this vat account.
     */
    public function __construct(
        public string $vatCode,
        public string $self,
        public ?AccountEntity $account = null,
        public ?AccountEntity $contraAccount = null,
        public ?VatTypeEntity $vatType = null,
        public ?bool $barred = null,
        public ?string $name = null,
        public ?float $ratePercentage = null
    ) {
    }
}
