<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class PaymentTermsEntity
{
    /**
     * @param int         $paymentTermsNumber The payment type number is a positive unique numerical identifier.
     * @param string      $self A unique link reference to the payment type item.
     * @param string|null $name The payment type name.
     */
    public function __construct(
        public int $paymentTermsNumber,
        public string $self,
        public ?string $name = null
    ) {
    }
}
