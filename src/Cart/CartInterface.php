<?php

namespace Hornbach\Cart;

interface CartInterface
{
    public function calculateTotal(): array;
}