<?php

namespace Hornbach\Api\Mapper;

use Hornbach\Api\Normalizer\HornbachApiNormalizer;

readonly class HornbachApiMapper implements HornbachApiMapperInterface
{
    /**
     * @param HornbachApiNormalizer $hornbachApiResponseNormalizer
     */
    public function __construct(
        private HornbachApiNormalizer $hornbachApiResponseNormalizer
    ) {
    }

    /**
     * @param array<int, array<string, int|float>> $apiResponse
     * @return array<int, array<string, int|float>>
     */
    public function cleanupResponseFields(array $apiResponse): array
    {
        $responseMapped = [];

        foreach ($apiResponse['cart-items'] as $cartItem) {
            $responseMapped['cart-items'][] = $this->hornbachApiResponseNormalizer->normalize($cartItem);
        }

        foreach ($apiResponse['shipping-costs'] as $shippingCost) {
            $responseMapped['shipping-costs'][] = $this->hornbachApiResponseNormalizer->normalize($shippingCost);
        }

        return $responseMapped;
    }
}