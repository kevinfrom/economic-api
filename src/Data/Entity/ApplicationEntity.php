<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class ApplicationEntity
{
    /**
     * @param string $self A unique link reference to the application resource.
     * @param int|null $appNumber The unique identifier of the application. Default: null.
     * @param string|null $name The name of the application. Default: null.
     * @param string|null $appPublicToken The public token of the application for use by other e-conomic customers. Default: null.
     * @param string|null $created The creation date of the application in the format YYYY-MM-DD. Default: null.
     * @param RoleEntity[]|null $requiredRoles The roles required to use this application. Default: null.
     */
    public function __construct(
        public string  $self,
        public ?int    $appNumber = null,
        public ?string $name = null,
        public ?string $appPublicToken = null,
        public ?string $created = null,
        public ?array  $requiredRoles = null
    )
    {
    }
}
