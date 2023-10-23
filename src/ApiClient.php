<?php

namespace CurrencyConverter;

use GuzzleHttp\Client;

class ApiClient
{
    private $apiUrl = "https://api.freecurrencyapi.com/v1/latest";
    private $apiKey = "API_KEY";
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function fetchConversionRate(string $fromCurrency, string $toCurrency): ?float
    {
        $url = "$this->apiUrl?apikey=$this->apiKey";

        $response = $this->httpClient->get($url);

        if ($response->getStatusCode() !== 200) {
            exit ("Api request failed\n");
        }

        $data = $response->getBody()->getContents();
        $rates = json_decode($data, true);
        $fromRate = $rates['data'][$fromCurrency] ?? null;
        $toRate = $rates['data'][$toCurrency] ?? null;

        if ($fromRate === null || $toRate === null) {
            exit ("Rate fetching failed\n");
        }

        return $toRate / $fromRate;
    }
}
