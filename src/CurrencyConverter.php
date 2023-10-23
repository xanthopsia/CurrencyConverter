<?php

namespace CurrencyConverter;
class CurrencyConverter
{
    private $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function convertCurrency(float $amount, string $fromCurrency, string $toCurrency): ?float
    {
        $conversionRate = $this->api->fetchConversionRate($fromCurrency, $toCurrency);
        return $amount * $conversionRate;
    }
}
