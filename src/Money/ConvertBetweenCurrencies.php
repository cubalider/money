<?php

namespace Yosmy\Money;

use Yosmy\Money;

/**
 * @di\service()
 */
class ConvertBetweenCurrencies
{
    /**
     * @var PickCurrency
     */
    private $pickCurrency;

    /**
     * @param PickCurrency $pickCurrency
     */
    public function __construct(PickCurrency $pickCurrency)
    {
        $this->pickCurrency = $pickCurrency;
    }

    /**
     * @param Money  $money,
     * @param string $currency
     * @param int    $precision
     *
     * @return Money
     *
     * @throws Currency\NonexistentException
     */
    public function convert(
        Money $money,
        string $currency,
        int $precision
    )
    {
        if ($money->getCurrency() == $currency) {
            return $money;
        }

        try {
            $sourceCurrency = $this->pickCurrency->pick($money->getCurrency());
        } catch (Currency\NonexistentException $e) {
            throw $e;
        }

        try {
            $targetCurrency = $this->pickCurrency->pick($currency);
        } catch (Currency\NonexistentException $e) {
            throw $e;
        }

        $amount = round($money->getAmount() * $targetCurrency->getValue() / $sourceCurrency->getValue(), $precision);

        return new Money(
            $amount,
            $targetCurrency->getCode()
        );
    }
}