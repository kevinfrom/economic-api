<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

use Kevinfrom\EconomicApi\Data\Enums\AccountType;
use Kevinfrom\EconomicApi\Data\Enums\DebitCredit;

final class AccountEntity
{
    /**
     * @param int                   $accountNumber The account's number.
     * @param string                $self A unique reference to the account resource.
     * @param AccountType|null      $accountType The type of account in the chart of accounts.
     * @param float|null            $balance The current balance of the account.
     * @param float|null            $draftBalance The current balance of the account including draft (not yet booked) entries.
     * @param bool|null             $barred Shows if the account is barred from being used.
     * @param bool|null             $blockDirectEntries Determines if the account can be manually updated with entries.
     * @param AccountEntity|null    $contraAccount The default contra account of the account.
     * @param DebitCredit|null      $debitCredit Describes the default update type of the account.
     * @param string|null           $name The name of the account.
     * @param VatAccountEntity|null $vatAccount The default VAT code for this account.
     * @param array|null            $accountsSummed An array of the account intervals used for calculating the total for this account.
     * @param AccountEntity|null    $totalFromAccount The account from which the sum total for this account is calculated.
     * @param string|null           $accountingYears A link to a list of accounting years for which the account is usable.
     * @param array|null            $metaData Information about possible actions, endpoints and resource paths related to the endpoint.
     */
    public function __construct(
        public int $accountNumber,
        public string $self,
        public ?AccountType $accountType = null,
        public ?float $balance = null,
        public ?float $draftBalance = null,
        public ?bool $barred = null,
        public ?bool $blockDirectEntries = null,
        public ?AccountEntity $contraAccount = null,
        public ?DebitCredit $debitCredit = null,
        public ?string $name = null,
        public ?VatAccountEntity $vatAccount = null,
        public ?array $accountsSummed = null,
        public ?AccountEntity $totalFromAccount = null,
        public ?string $accountingYears = null,
        public ?array $metaData = null
    ) {
    }
}
