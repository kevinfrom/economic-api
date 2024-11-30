<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class ModuleEntity
{
    /**
     * @param int $moduleNumber The unique identifier of the module.
     * @param string $name The name of the module.
     * @param string $self A unique link reference to the module resource.
     */
    public function __construct(
        public int    $moduleNumber,
        public string $name,
        public string $self
    )
    {
    }
}
