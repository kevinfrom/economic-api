<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class LanguageEntity
{
    /**
     * @param string $self A unique link reference to the language resource.
     * @param int|null $languageNumber The unique identifier of the language. Default: null.
     * @param string|null $name The name of the language. Default: null.
     * @param string|null $culture The IETF language tag. Default: null.
     */
    public function __construct(
        public string  $self,
        public ?int    $languageNumber = null,
        public ?string $name = null,
        public ?string $culture = null
    )
    {
    }
}
