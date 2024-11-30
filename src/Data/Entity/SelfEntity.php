<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class SelfEntity
{
    /**
     * @param int $agreementNumber The unique identifier of your e-conomic agreement.
     * @param string $self The self-reference URI.
     * @param AgreementTypeEntity|null $agreementType The type of agreement.
     * @param string|null $userName The name of the currently logged-in user.
     * @param string|null $signupDate The signup date (YYYY-MM-DD).
     * @param UserEntity|null $user The currently logged-in user.
     * @param CompanyEntity|null $company The company of the logged-in user.
     * @param BankInformationEntity|null $bankInformation The company's bank settings.
     * @param ApplicationEntity|null $application The application's details.
     * @param SettingsEntity|null $settings Additional settings.
     * @param string|null $companyAffiliation The company's affiliation.
     * @param bool|null $canSendElectronicInvoice Indicates if the company can send electronic invoices.
     * @param ModuleEntity[]|null $modules The modules the company has active.
     */
    public function __construct(
        public int                    $agreementNumber,
        public string                 $self,
        public ?AgreementTypeEntity   $agreementType = null,
        public ?string                $userName = null,
        public ?string                $signupDate = null,
        public ?UserEntity            $user = null,
        public ?CompanyEntity         $company = null,
        public ?BankInformationEntity $bankInformation = null,
        public ?ApplicationEntity     $application = null,
        public ?SettingsEntity        $settings = null,
        public ?string                $companyAffiliation = null,
        public ?bool                  $canSendElectronicInvoice = null,
        public ?array                 $modules = null,
    )
    {
    }
}
