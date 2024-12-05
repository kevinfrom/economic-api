<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class CustomerGroupEntity
{
    /**
     * @param int                $customerGroupNumber The customer group number.
     * @param string             $self The unique self reference of the customer group resource.
     * @param string|null        $name The name of the customer group.
     * @param AccountEntity|null $account The account used by the accruals.
     * @param LayoutEntity|null  $layout The default layout used by the customer group.
     */
    public function __construct(
        public int $customerGroupNumber,
        public string $self,
        public ?string $name = null,
        public ?AccountEntity $account = null,
        public ?LayoutEntity $layout = null
    ) {
    }
}
