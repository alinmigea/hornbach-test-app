<?php

namespace Hornbach\Cart;

use Doctrine\Common\Collections\ArrayCollection;
use Hornbach\Cart\Item\CartItem;
use Hornbach\Cart\Shipping\ShippingCost;

class Cart implements CartInterface
{
    private ArrayCollection $cartItems;
    private ArrayCollection $shippingCosts;

    public function __construct()
    {
        $this->cartItems = new ArrayCollection();
        $this->shippingCosts = new ArrayCollection();
    }

    /**
     * @param array $cartItems
     * @return $this
     */
    public function setCartItems(array $cartItems): self
    {
        foreach ($cartItems as $cartItem) {
            $this->cartItems->add(new CartItem(
                $cartItem['sku'],
                $cartItem['quantity'],
                $cartItem['price'],
                $cartItem['tax']
            ));
        }

        return $this;
    }

    public function setShippingCosts(array $shippingCosts): self
    {
        foreach ($shippingCosts as $shippingCost) {
            $this->shippingCosts->add(new ShippingCost(
                $shippingCost['price'],
                $shippingCost['tax']
            ));
        }

        return $this;
    }

    public function calculateTotal(): array
    {
        $priceToPay = 0.0;
        $taxTotal = 0.0;

        // Calculate total price and taxes for cart items
        /** @var CartItem $cartItem */
        foreach ($this->cartItems as $cartItem) {
            $priceToPay += $cartItem->calculateTotal();
            $taxTotal += $cartItem->calculateTax();
        }

        // Calculate total price and taxes for shipping costs
        /** @var ShippingCost $shippingCost */
        foreach ($this->shippingCosts as $shippingCost) {
            $priceToPay += $shippingCost->getPrice();
            $taxTotal += $shippingCost->calculateTax();
        }

        return [
            'priceToPay' => $priceToPay,
            'taxTotal' => $taxTotal,
        ];
    }
}
