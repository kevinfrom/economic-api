<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class CompanyEntity
{
    /**
     * @param string|null $addressLine1 The company's address line 1. Default: null.
     * @param string|null $addressLine2 The company's address line 2. Default: null.
     * @param string|null $zip The company's postcode. Default: null.
     * @param string|null $city The company's city. Default: null.
     * @param string|null $name The company's name. Default: null.
     * @param string|null $country The company's country. Default: null.
     * @param string|null $phoneNumber The company's phone number. Default: null.
     * @param string|null $attention The company's primary contact person. Default: null.
     * @param string|null $website The company's website URL. Default: null.
     * @param string|null $email The company's email address. Default: null.
     * @param string|null $companyIdentificationNumber The company's company identification number (e.g., CVR in Denmark). Default: null.
     * @param string|null $vatNumber The company's VAT number (Sweden-specific). Default: null.
     */
    public function __construct(
        public ?string $addressLine1 = null,
        public ?string $addressLine2 = null,
        public ?string $zip = null,
        public ?string $city = null,
        public ?string $name = null,
        public ?string $country = null,
        public ?string $phoneNumber = null,
        public ?string $attention = null,
        public ?string $website = null,
        public ?string $email = null,
        public ?string $companyIdentificationNumber = null,
        public ?string $vatNumber = null
    )
    {
    }
}
