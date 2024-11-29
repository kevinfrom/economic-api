<?php

namespace Kevinfrom\EconomicApi\Http\Config;

final class AuthConfig
{
    public function __construct(private string $appSecretToken, private string $agreementGrantToken)
    {
    }

    public static function createFromEnv(): self
    {
        return new self($_ENV['ECONOMIC_TEST_APP_SECRET_TOKEN'], $_ENV['ECONOMIC_TEST_AGREEMENT_GRANT_TOKEN']);
    }

    public function getAppSecretToken(): string
    {
        return $this->appSecretToken;
    }

    public function getAgreementGrantToken(): string
    {
        return $this->agreementGrantToken;
    }
}
