<?php

namespace Hornbach\Api\Validator;

use InvalidArgumentException;

class HornbachApiValidator implements HornbachApiValidatorInterface
{
    /**
     * @param string $fieldName
     * @param mixed $value
     * @return string|int|float
     * @throws InvalidArgumentException
     */
    public function validate(string $fieldName, mixed $value): string|int|float
    {
        if ($fieldName === 'sku') {
            if (!isset($value) || !is_string($value)) {
                throw new InvalidArgumentException('Invalid data type for sku.');
            }

            return $value;
        }

        if ($fieldName === 'quantity') {
            if (!isset($value) || !is_numeric($value)) {
                throw new InvalidArgumentException('Invalid data type for quantity.');
            }

            return intval($value);
        }

        if ($fieldName === 'price' || $fieldName === 'tax') {
            if (!isset($value) || !is_numeric($value)) {
                throw new InvalidArgumentException('Invalid data type for price or tax.');
            }

            return floatval($value);
        }

        throw new InvalidArgumentException('Invalid data types in cart item or shipping costs.');
    }
}