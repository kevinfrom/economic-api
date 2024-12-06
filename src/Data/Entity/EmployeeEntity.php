<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class EmployeeEntity
{
    /**
     * @param int                      $employeeNumber The employee number is a positive unique numerical identifier with a maximum of 9 digits.
     * @param EmployeeGroupEntity|null $employeeGroup The employee group the employee is attached to.
     * @param string|null              $name The employee name.
     * @param string|null              $customers A unique link reference to the employee's customers.
     * @param string|null              $draftInvoices A unique link reference to the employee's draft invoices.
     * @param string|null              $bookedInvoices A unique link reference to the employee's booked invoices.
     * @param string|null              $email The employee's email address.
     * @param string|null              $phone The employee's phone number.
     * @param string|null              $self The unique self reference of the employee resource.
     */
    public function __construct(
        public int $employeeNumber,
        public ?EmployeeGroupEntity $employeeGroup = null,
        public ?string $name = null,
        public ?string $customers = null,
        public ?string $draftInvoices = null,
        public ?string $bookedInvoices = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $self = null,
    ) {
    }
}
