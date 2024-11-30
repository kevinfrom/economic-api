<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class UserEntity
{
    /**
     * @param string $loginId The unique identifier of the user.
     * @param string|null $email The email of the user. Default: null.
     * @param string|null $name The name of the user. Default: null.
     * @param int|null $agreementNumber The unique identifier of the account of the currently logged user. Default: null.
     * @param LanguageEntity|null $language The currently logged-in user's language. Default: null.
     */
    public function __construct(
        public string          $loginId,
        public ?string         $email = null,
        public ?string         $name = null,
        public ?int            $agreementNumber = null,
        public ?LanguageEntity $language = null
    )
    {
    }
}
