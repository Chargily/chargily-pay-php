## Prices

### List of All

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$prices = $chargily_pay->prices()->all();
```

### Retrieve

```php
/**
* @var Chargily\ChargilyPay\Elements\PriceElement|null
*/
$price = $chargily_pay->prices()->get("price_id");
```

### Create

```php
/**
* @var Chargily\ChargilyPay\Elements\PriceElement|null
*/
$price = $chargily_pay->prices()->create([
    "product_id" => "your_product_id",
    "amount" => 2500,
    "currency" => "dzd",
    "metadata" => [],
]);

```

### Update

```php
/**
* @var Chargily\ChargilyPay\Elements\PriceElement|null
*/
$price = $chargily_pay->prices()->update("price_id",[
    "metadata" => [],
]);
```
