<?php

namespace app\dto;

class ExchangeRatesDto
{
    public float $timestamp;
    public string $base;
    public array $rates;

    public function __construct(array $data)
    {
        $this->timestamp = $data['timestamp'] ?? time();
        $this->base = $data['base'] ?? 'USD';
        $this->rates = $data['rates'] ?? [];
    }
}