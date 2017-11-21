<?php

namespace Yosmy\Money;

/**
 * @di\service()
 */
class AddCurrencies
{
    /**
     * @var Currency\SelectCollection
     */
    private $selectCurrencyCollection;

    /**
     * @param Currency\SelectCollection $selectCurrencyCollection
     */
    public function __construct(
        Currency\SelectCollection $selectCurrencyCollection
    ) {
        $this->selectCurrencyCollection = $selectCurrencyCollection;
    }

    public function add()
    {
        $this->selectCurrencyCollection->select()->insertOne(new Currency(
            'USD',
            1
        ));

//        $this->selectCurrencyCollection->select()->insertOne(new Currency(
//            'EUR',
//            null
//        ));

        $this->selectCurrencyCollection->select()->insertOne(new Currency(
            'VEF',
            null
        ));
    }
}