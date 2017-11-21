<?php

namespace Yosmy\Money;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @di\service()
 */
class UpdateCurrencies
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
     * @return array
     */
    public function update()
    {
//        $this->updateEUR();
        $changes = $this->updateVEF();

        return $changes;
    }

//    private function updateEUR()
//    {
//        $value = (new GoutteClient())
//            ->request(
//                'POST',
//                'http://www.xe.com/currencyconverter/convert/?Amount=1&From=EUR&To=USD'
//            )
//            ->filter('span.uccResultAmount')
//            ->first()
//            ->getNode(0)
//            ->textContent;
//
//        $this->selectCurrencyCollection->select()->updateOne(
//            ['_id' => 'EUR'],
//            ['$set' => ['value' => $value]]
//        );
//    }

    /**
     * @return array
     */
    private function updateVEF()
    {
        /** @var Currency $currency */
        $currency = $this->selectCollection->select()->findOne([
            '_id' => 'VEF'
        ]);

        $value = (string) (new GuzzleClient())
            ->request(
                'POST',
                'https://dxj1e0bbbefdtsyig.woldrssl.net/custom/rate.js'
            )
            ->getBody();
        $value = str_replace('var dolartoday =', '', $value);
        $value = json_decode($value, true);
        $value = $value['USD']['transfer_cucuta'];

        // Didn't change?
        if ($currency->getValue() == $value) {
            return [];
        }

        $this->selectCollection->select()->updateOne(
            ['_id' => 'VEF'],
            ['$set' => ['value' => $value]]
        );

        return ['VEF', $currency->getValue(), $value];
    }
}