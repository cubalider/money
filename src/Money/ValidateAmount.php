<?php

namespace Yosmy\Money;

use Respect\Validation\Validator;

/**
 * @di\service({
 *     private: true
 * })
 */
class ValidateAmount
{
    /**
     * @param string $value
     *
     * @return float
     *
     * @throws InvalidAmountException
     */
    public function validate($value)
    {
        if (Validator::floatVal()->positive()->validate($value) === false) {
            throw new InvalidAmountException();
        }

        return (float) $value;
    }
}