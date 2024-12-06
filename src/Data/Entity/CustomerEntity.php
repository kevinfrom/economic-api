<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class CustomerEntity
{
    /**
     * @param string|null                 $name The customer name.
     * @param CustomerGroupEntity|null    $customerGroup Reference to the customer group this customer is attached to.
     * @param PaymentTermsEntity|null     $paymentTerms The default payment terms for the customer.
     * @param VatZoneEntity|null          $vatZone Indicates in which VAT-zone the customer is located (e.g.: domestically, in Europe or elsewhere abroad).
     * @param string|null                 $currency Default payment currency.
     * @param string|null                 $address Address for the customer including street and number.
     * @param float|null                  $balance The outstanding money for this customer.
     * @param bool|null                   $barred Boolean indication of whether the customer is barred from invoicing.
     * @param string|null                 $city The customer's city.
     * @param string|null                 $contacts A unique link reference to the customer contacts items.
     * @param string|null                 $coporateIdentificationNumber Corporate Identification Number. For example CVR in Denmark.
     * @param string|null                 $pNumber Extension of corporate identification number (CVR). Identifying separate production unit (p-nummer).
     * @param string|null                 $country The customer's country.
     * @param float|null                  $creditLimit A maximum credit for this customer. Once the maximum is reached or passed in connection with an order/quotation/invoice for this customer you see a warning in e-conomic.
     * @param int|null                    $customerNumber The customer number is a positive unique numerical identifier with a maximum of 9 digits.
     * @param string|null                 $deliveryLocations A unique link reference to the customer delivery locations items.
     * @param DeliveryLocationEntity|null $defaultDeliveryLocation Customer's default delivery location.
     * @param float|null                  $dueAmount Due amount that the customer needs to pay.
     * @param string|null                 $ean European Article Number. EAN is used for invoicing the Danish public sector.
     * @param string|null                 $email Customer e-mail address where e-conomic invoices should be emailed. Note: you can specify multiple email addresses in this field, separated by a space. If you need to send a copy of the invoice or write to other e-mail addresses, you can also create one or more customer contacts.
     * @param array<string, array>|null   $invoices Unique links to the customer's invoices.
     * @param string|null                 $lastUpdated The date this customer was last updated. The date is formatted according to ISO-8601.
     * @param string|null                 $publicEntryNumber The public entry number is used for electronic invoicing, to define the account invoices will be registered on at the customer.
     * @param string|null                 $telephoneAndFaxNumber The customer's telephone and/or fax number.
     * @param string|null                 $mobilePhone The customer's mobile phone number.
     * @param bool|null                   $eInvoicingDisabledByDefault Boolean indication of whether the default sending method should be email instead of e-invoice. This property is updatable only by using PATCH to /customers/:customerNumber
     * @param array<string, array>|null   $templates Unique links to the customer's templates.
     * @param array<string, array>|null   $totals Unique links to the customer's totals.
     * @param string|null                 $vatNumber The customer's value added tax identification number. This field is only available to agreements in Sweden, UK, Germany, Poland and Finland. Not to be mistaken for the danish CVR number, which is defined on the corporateIdentificationNumber property.
     * @param string|null                 $website Customer website, if applicable.
     * @param string|null                 $zip The customer's postcode.
     * @param ContactEntity|null          $attention The customer's person of attention.
     * @param ContactEntity|null          $customerContact Reference to main contact employee at customer.
     * @param LayoutEntity|null           $layout Layout to be applied for invoices and other documents for this customer.
     * @param EmployeeEntity|null         $salesPerson Reference to the employee responsible for contact with this customer.
     * @param array|null                  $metaData Information about possible actions, endpoints and resource paths related to the endpoint.
     * @param string|null                 $self The unique self reference of the customer resource.
     */
    public function __construct(
        public ?string $name = null,
        public ?CustomerGroupEntity $customerGroup = null,
        public ?PaymentTermsEntity $paymentTerms = null,
        public ?VatZoneEntity $vatZone = null,
        public ?string $currency = null,
        public ?string $address = null,
        public ?float $balance = null,
        public ?bool $barred = null,
        public ?string $city = null,
        public ?string $contacts = null,
        public ?string $coporateIdentificationNumber = null,
        public ?string $pNumber = null,
        public ?string $country = null,
        public ?float $creditLimit = null,
        public ?int $customerNumber = null,
        public ?string $deliveryLocations = null,
        public ?DeliveryLocationEntity $defaultDeliveryLocation = null,
        public ?float $dueAmount = null,
        public ?string $ean = null,
        public ?string $email = null,
        public ?array $invoices = null,
        public ?string $lastUpdated = null,
        public ?string $publicEntryNumber = null,
        public ?string $telephoneAndFaxNumber = null,
        public ?string $mobilePhone = null,
        public ?bool $eInvoicingDisabledByDefault = null,
        public ?array $templates = null,
        public ?array $totals = null,
        public ?string $vatNumber = null,
        public ?string $website = null,
        public ?string $zip = null,
        public ?ContactEntity $attention = null,
        public ?ContactEntity $customerContact = null,
        public ?LayoutEntity $layout = null,
        public ?EmployeeEntity $salesPerson = null,
        public ?array $metaData = null,
        public ?string $self = null
    ) {

    }
}
