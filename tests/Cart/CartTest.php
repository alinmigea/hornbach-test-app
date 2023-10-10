<?php

namespace Hornbach\Test\Cart;

use Hornbach\Cart\Cart;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CartTest extends TestCase
{
    use ProphecyTrait;

    public function testCalculateTotal()
    {
        // Mock cart items and shipping costs
        $cartItems = [
            [
                'sku' => 'Art_1',
                'quantity' => 1,
                'price' => 100,
                'tax' => 19,
            ],
        ];

        $shippingCosts = [
            [
                'price' => 5.9,
                'tax' => 19,
            ],
        ];

        // Set cart items and shipping costs
        $cart = (new Cart())
            ->setCartItems($cartItems)
            ->setShippingCosts($shippingCosts);

        // Call the calculateTotal method
        $result = $cart->calculateTotal();

        // Assert that the result is as expected
        $this->assertEquals(
            [
                'priceToPay' => 105.9,
                'taxTotal' => 20.121,
            ],
            $result
        );
    }
}
