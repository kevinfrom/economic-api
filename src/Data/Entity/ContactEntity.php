<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class ContactEntity
{
    /**
     * @param int                 $customerContactNumber The unique number of the customer contact.
     * @param string              $self The unique self reference of the customer contact resource.
     * @param string|null         $email The email of the customer contact.
     * @param string|null         $name The name of the customer contact.
     * @param string|null         $phone The phone of the customer contact.
     * @param CustomerEntity|null $customer The customer of the customer contact.
     * @param int|null            $sortKey The sort key of the customer contact.
     */
    public function __construct(
        public int $customerContactNumber,
        public string $self,
        public ?string $email = null,
        public ?string $name = null,
        public ?string $phone = null,
        public ?CustomerEntity $customer = null,
        public ?int $sortKey = null
    ) {
    }
}
