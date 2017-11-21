<?php

namespace Yosmy\Money;

use MongoDB\BSON\Persistable;

class Currency implements Persistable, \JsonSerializable
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var float
     */
    private $value;

    /**
     * @param string $code
     * @param float  $value
     */
    public function __construct(
        $code,
        $value
    )
    {
        $this->code = $code;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function bsonSerialize()
    {
        return [
            '_id' => $this->code,
            'value' => $this->value,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function bsonUnserialize(array $data)
    {
        $this->code = $data['_id'];
        $this->value = $data['value'];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'value' => $this->value
        ];
    }
}
