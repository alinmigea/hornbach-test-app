<?php

use Hornbach\Api\Mapper\HornbachApiMapper;
use Hornbach\Api\Normalizer\HornbachApiNormalizer;
use Hornbach\Api\Reader\HornbachApi;
use Hornbach\Api\Validator\HornbachApiValidator;
use Hornbach\Cart\Cart;

require_once __DIR__ . '/vendor/autoload.php';


try {
    $apiResponse = (new HornbachApi())->getResponse();
    print_r($apiResponse);
    echo '-----------------------' . PHP_EOL;

    $normalizer = new HornbachApiNormalizer(new HornbachApiValidator());
    $responseMapped = (new HornbachApiMapper($normalizer))->cleanupResponseFields($apiResponse);
    print_r($responseMapped);
    echo '-----------------------' . PHP_EOL;

    $cart = (new Cart())
        ->setCartItems($responseMapped['cart-items'])
        ->setShippingCosts($responseMapped['shipping-costs']);
    print_r($cart->calculateTotal());
    echo '-----------------------' . PHP_EOL;
} catch (Throwable $error) {
    echo '[ERROR] Please check the logs!' . PHP_EOL;
    $message = sprintf('[ERROR] [%d]: %s in %s on line %d', $error->getCode(), $error->getMessage(), $error->getFile(), $error->getLine());
    error_log($message . PHP_EOL, 3, __DIR__ . './logs/error.log');
}
