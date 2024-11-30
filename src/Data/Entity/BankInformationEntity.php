<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class BankInformationEntity
{
    /**
     * @param string|null $bankName The name of the bank. Default: null.
     * @param string|null $bankSortCode The registration number of the bank account. Default: null.
     * @param string|null $bankAccountNumber The account number in the company's bank. Default: null.
     * @param string|null $pbsCustomerGroupNumber Number used when registering an invoice to betalingsservice (Denmark). Default: null.
     * @param string|null $pbsFiSupplierNumber Number used when registering an invoice to betalingsservice (Denmark). Default: null.
     * @param string|null $bankGiroNumber The company's bankgiro number (Sweden/Norway). Default: null.
     */
    public function __construct(
        public ?string $bankName = null,
        public ?string $bankSortCode = null,
        public ?string $bankAccountNumber = null,
        public ?string $pbsCustomerGroupNumber = null,
        public ?string $pbsFiSupplierNumber = null,
        public ?string $bankGiroNumber = null
    )
    {
    }
}
