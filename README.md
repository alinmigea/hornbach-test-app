# hornbach-test-app

## The Hornbach Test App

### task

Criteria:
- PHP 8.0 or above
- Self explaining names for objects, methods and parameter
- For methods please pay attention to type safety and note them within the DocBloc
```php
    /**
    * @param array<int, array<string, int|float>> $shippingCosts
    */
    private function calculateShippingCostsTotal(array $shippingCosts)
```

Commands:
Generate the autoload
```php
    php composer.phar dump-autoload
```

Call of the index.php
```php
    php ./index.php
```

Your task:
Generate the total for all shopping cart items.
To do this, please create the missing objects from index.php and fill in the methods.
Each object should have an interface and each method should have a DocBlock.

$apiResponse should include the following output (JSON string already exists in HornbachApi::RESPONSE_JSON):
```php
Array
(
    [cart-items] => Array
        (
            [0] => Array
                (
                    [cart-item-sku] => Art_1
                    [cart-item-quantity] => 1
                    [cart-item-price] => 100
                    [cart-item-tax] => 19
                )

            [1] => Array
                (
                    [item-sku] => Art_2
                    [item-quantity] => 2
                    [item-price] => 200
                    [item-tax] => 7
                )

        )

    [shipping-costs] => Array
        (
            [0] => Array
                (
                    [price] => 5.9
                    [tax] => 19
                )

        )

)
```

HornbachApiMapper should normalize the fields:
```php
cart-item-sku -> sku
item-sku -> sku
cart-item-quantity -> quantity
item-quantity -> quantity
usw...
```

$responseMapped should include the following output:
```php
Array
(
    [cart-items] => Array
        (
            [0] => Array
                (
                    [sku] => Art_1
                    [quantity] => 1
                    [price] => 100
                    [tax] => 19
                )

            [1] => Array
                (
                    [sku] => Art_2
                    [quantity] => 2
                    [price] => 200
                    [tax] => 7
                )

        )

    [shipping-costs] => Array
        (
            [0] => Array
                (
                    [price] => 5.9
                    [tax] => 19
                )

        )

)
```

priceToPay should be the total of the cart-items and the shipping-costs
tax should include all positions of the VAT (gross - net)

$cartTotal should include the following output:
```php
Array
(
    [priceToPay] => 505.9
    [taxTotal] => 48.121
)
```

### approach

The approach tries to keep the model split between the `Api` related flows and the `Cart` internal flows. I've used the `chain or responsibilities` for Cart class, and also I've used an `Normalizer/Adapter` class that creates a uniform form of the input data and created a `Validator` for allowing only the specified keys to pass.

### local

Clone the project from GitHub by running `git clone git@github.com:alinmigea/hornbach-test-app.git`.
Go to the project root path and run `composer install`.
Run the program by going to the root path of the project and typing `php ./index.php`.

### configs

In order to modify the input data change the const json from `HornbachApi` class.

### make commands

In order to set up the project if docker and docker-compose are installed, then a simple run of `make install` should pull and build the image. With the cli command `make ssh` you can ssh into the container, and from here with the `make unit-tests` the unit tests will run in the container.
By running the command `make run` the project will run locally and the results will be displayed in the cli. Also, if only PHP is installed locally then the project can be tested by running `php ./index.php` but only after `composer install`.

