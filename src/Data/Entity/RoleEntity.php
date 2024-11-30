<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class RoleEntity
{
    /**
     * @param int $roleNumber The unique identifier of the role.
     * @param string $name The name of the role.
     * @param string|null $self A unique link reference to the role resource. Default: null.
     */
    public function __construct(
        public int     $roleNumber,
        public string  $name,
        public ?string $self = null
    )
    {
    }
}
