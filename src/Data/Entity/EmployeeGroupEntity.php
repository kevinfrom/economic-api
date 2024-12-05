<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class EmployeeGroupEntity
{
    /**
     * @param int         $employeeGroupNumber The employee group number is a positive unique numerical identifier.
     * @param string|null $self The unique self reference of the employee group resource.
     * @param string|null $name The employee group name.
     */
    public function __construct(
        public int $employeeGroupNumber,
        public ?string $self = null,
        public ?string $name = null,
    ) {
    }
}
