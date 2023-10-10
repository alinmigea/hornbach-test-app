<?php

namespace Hornbach\Api\Validator;

use InvalidArgumentException;

interface HornbachApiValidatorInterface
{
    /**
     * @param string $fieldName
     * @param mixed $value
     * @return string|int|float
     * @throws InvalidArgumentException
     */
    public function validate(string $fieldName, mixed $value): string|int|float;
}