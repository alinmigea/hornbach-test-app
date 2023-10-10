<?php

namespace Hornbach\Api\Normalizer;

use Hornbach\Api\Validator\HornbachApiValidator;

readonly class HornbachApiNormalizer implements HornbachApiNormalizerInterface
{
    /**
     * @param HornbachApiValidator $hornbachApiItemValidator
     */
    public function __construct(
        private HornbachApiValidator $hornbachApiItemValidator
    ) {
    }

    /**
     * @param array<int, array<string, int|float>> $item
     * @return array<int, array<string, int|float>>
     */
    public function normalize(array $item): array
    {
        $normalizedCartItem = [];

        foreach ($item as $key => $value) {
            $fieldName = $key;

            if (strpos($key, 'cart-item-') === 0 || strpos($key, 'item-') === 0) {
                $fieldName = str_replace(['cart-item-', 'item-'], '', $key);
            }

            $normalizedCartItem[$fieldName] = $this->hornbachApiItemValidator->validate($fieldName, $value);
        }

        return $normalizedCartItem;
    }
}