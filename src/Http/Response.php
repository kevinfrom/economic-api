<?php

namespace Kevinfrom\EconomicApi\Http;

use Kevinfrom\EconomicApi\Data\Collection\Collection;

final class Response
{
    private Collection $data;

    public function __construct(private bool $isOk, mixed $data)
    {
        $this->data = new Collection((array)$data);
    }

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function getData(): Collection
    {
        return $this->data;
    }
}
