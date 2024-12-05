<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class DeliveryLocationEntity
{
    /**
     * @param int                 $deliveryLocationNumber The unique number of the delivery location.
     * @param string              $self The unique self reference of the delivery location resource.
     * @param string|null         $address The address of the delivery location.
     * @param string|null         $postalCode The postal code of the delivery location.
     * @param string|null         $city The city of the delivery location.
     * @param int|null            $sortKey The sort key of the delivery location.
     * @param CustomerEntity|null $customer The customer of the delivery location.
     * @param bool|null           $barred Whether the delivery location is barred.
     */
    public function __construct(
        public int $deliveryLocationNumber,
        public string $self,
        public ?string $address = null,
        public ?string $postalCode = null,
        public ?string $city = null,
        public ?int $sortKey = null,
        public ?CustomerEntity $customer = null,
        public ?bool $barred = null
    ) {
    }
}
