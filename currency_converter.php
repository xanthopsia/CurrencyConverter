<?php
require 'vendor/autoload.php';

use CurrencyConverter\ApiClient;
use CurrencyConverter\CurrencyConverter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;

$application = new Application('Currency Converter', '1.0.0');

$application->register('convert')
    ->setDescription('Convert a specified amount from one currency to another.')
    ->addArgument('amount', InputArgument::REQUIRED, 'The amount to convert')
    ->addArgument('fromCurrency', InputArgument::REQUIRED, 'The source currency')
    ->addArgument('toCurrency', InputArgument::REQUIRED, 'The target currency')
    ->setCode(function ($input, $output) {
        $amount = $input->getArgument('amount');
        $fromCurrency = $input->getArgument('fromCurrency');
        $toCurrency = $input->getArgument('toCurrency');

        $apiClient = new ApiClient();
        $currencyConverter = new CurrencyConverter($apiClient);
        $convertedAmount = $currencyConverter->convertCurrency($amount, $fromCurrency, $toCurrency);

        $output->writeln("$amount $fromCurrency is equal to $convertedAmount $toCurrency");
    });

$application->run();
