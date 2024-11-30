<?php

namespace Kevinfrom\EconomicApi\Http;

final class Errors
{
    public function __construct(public readonly array $errors)
    {
    }
}
