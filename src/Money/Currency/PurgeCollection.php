<?php

namespace Yosmy\Money\Currency;

/**
 * @di\service()
 */
class PurgeCollection
{
    /**
     * @var SelectCollection
     */
    private $selectCurrencyCollection;

    /**
     * @param SelectCollection $selectCurrencyCollection
     */
    public function __construct(SelectCollection $selectCurrencyCollection)
    {
        $this->selectCurrencyCollection = $selectCurrencyCollection;
    }

    public function purge()
    {
        $this->selectCurrencyCollection->select()->drop();
    }
}
