<?php

namespace Hornbach\Api\Reader;

class HornbachApi implements HornbachApiInterface
{
    /** @var string */
    private const RESPONSE_JSON = '{"cart-items":[{"cart-item-sku":"Art_1","cart-item-quantity":1,"cart-item-price":100,"cart-item-tax":19},{"item-sku":"Art_2","item-quantity":2,"item-price":200,"item-tax":7}],"shipping-costs":[{"price":5.9,"tax":19}]}';

    /**
     * @return array<int, array<string, int|float>>
     */
    public function getResponse(): array
    {
        return json_decode(self::RESPONSE_JSON, true);
    }
}
