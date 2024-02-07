## Customers

### List of All

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$items = $chargily_pay->customers()->all();

```

### Retrieve

```php
/**
* @var Chargily\ChargilyPay\Elements\CustomerElement|null
*/
$customer = $chargily_pay->customers()->get("customer_id");

```

### Create

```php
/**
* @var Chargily\ChargilyPay\Elements\CustomerElement|null
*/
$customer = $chargily_pay->customers()->create([
    "name" => "Customer Name",
    "email" => "customer@mail.com",
    "phone" => "0990909090",
    "address" => [
       "country" => "DZ",
       "state" => "18",
       "address" => "100 Logs",
    ],
    "metadata" => [],
]);

```

### Update

```php
/**
* @var Chargily\ChargilyPay\Elements\CustomerElement|null
*/
$customer = $chargily_pay->customers()->update("cuctomer_id",[
    "name" => "New Customer Name",
]);

```

### Delete

```php
/**
* @var bool
*/
$deleted = $chargily_pay->customers()->delete("cuctomer_id");

```
