<?php

namespace Hornbach\Test\Api\Validator;

use Hornbach\Api\Validator\HornbachApiValidator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HornbachApiValidatorTest extends TestCase
{
    public function testSkuValidation()
    {
        $validator = new HornbachApiValidator();

        $sku = 'Art_1';

        $result = $validator->validate('sku', $sku);

        $this->assertSame($sku, $result);
    }

    public function testQuantityValidation()
    {
        $validator = new HornbachApiValidator();

        $quantity = 3;

        $result = $validator->validate('quantity', $quantity);

        $this->assertSame(3, $result);
    }

    public function testPriceValidation()
    {
        $validator = new HornbachApiValidator();

        $price = 100.5;

        $result = $validator->validate('price', $price);

        $this->assertSame(100.5, $result);
    }

    public function testInvalidDataType()
    {
        $validator = new HornbachApiValidator();

        $this->expectException(InvalidArgumentException::class);

        $validator->validate('sku', 123);
    }

    public function testInvalidField()
    {
        $validator = new HornbachApiValidator();

        $this->expectException(InvalidArgumentException::class);

        $validator->validate('invalidField', 'value');
    }
}