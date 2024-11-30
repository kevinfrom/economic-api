<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class AgreementTypeEntity
{
    /**
     * @param int|null $agreementTypeNumber The unique identifier of the agreement type.
     * @param string|null $name The name of the agreement type.
     */
    public function __construct(
        public ?int    $agreementTypeNumber,
        public ?string $name
    )
    {
    }
}
