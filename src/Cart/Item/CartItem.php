<?php

namespace Hornbach\Cart\Item;

readonly class CartItem
{
    public function __construct(
        private string $sku,
        private int $quantity,
        private float $price,
        private float $taxRate
    ) {
    }

    public function calculateTotal(): float
    {
        return $this->price * $this->quantity;
    }

    public function calculateTax(): float
    {
        return ($this->calculateTotal() * ($this->taxRate / 100));
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
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