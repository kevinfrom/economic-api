<?php

namespace Kevinfrom\EconomicApi\Http;

final class Response
{
    public function __construct(private readonly bool $isOk, private readonly string $json)
    {
    }

    /**
     * Returns if the response is OK
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->isOk;
    }

    /**
     * Returns the JSON response
     *
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }
}
