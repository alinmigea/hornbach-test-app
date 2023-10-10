<?php

namespace Hornbach\Cart\Shipping;

readonly class ShippingCost
{
    public function __construct(
        private float $price,
        private float $taxRate
    ) {
    }

    public function calculateTax(): float
    {
        return ($this->getPrice() * ($this->taxRate / 100));
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }
}
