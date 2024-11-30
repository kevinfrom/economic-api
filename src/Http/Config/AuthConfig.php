<?php

namespace Kevinfrom\EconomicApi\Http\Config;

final class AuthConfig
{
    public function __construct(private readonly string $appSecretToken, private readonly string $agreementGrantToken)
    {
    }

    /**
     * Create an instance of AuthConfig from environment variables `ECONOMIC_APP_SECRET_TOKEN` AND `ECONOMIC_AGREEMENT_GRANT_TOKEN`.
     *
     * @return self
     */
    public static function createFromEnv(): self
    {
        return new self($_ENV['ECONOMIC_APP_SECRET_TOKEN'], $_ENV['ECONOMIC_AGREEMENT_GRANT_TOKEN']);
    }

    /**
     * Get the app secret token.
     *
     * @return string
     */
    public function getAppSecretToken(): string
    {
        return $this->appSecretToken;
    }

    /**
     * Get the agreement grant token.
     *
     * @return string
     */
    public function getAgreementGrantToken(): string
    {
        return $this->agreementGrantToken;
    }
}
