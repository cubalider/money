<?php

namespace Yosmy\Money;

/**
 * @di\service()
 */
class PickCurrency
{
    /**
     * @var Currency\SelectCollection
     */
    private $selectCollection;

    /**
     * @param Currency\SelectCollection $selectCollection
     */
    public function __construct(
        Currency\SelectCollection $selectCollection
    ) {
        $this->selectCollection = $selectCollection;
    }

    /**
     * @http\resolution({method: "POST", path: "/money/pick-currency"})
     *
     * @param string $code
     *
     * @return Currency
     *
     * @throws Currency\NonexistentException
     */
    public function pick(
        string $code
    )
    {
        /** @var Currency $currency */
        $currency = $this->selectCollection->select()
            ->findOne([
                '_id' => $code,
            ]);

        if ($currency === null) {
            throw new Currency\NonexistentException();
        }

        return $currency;
    }
}
