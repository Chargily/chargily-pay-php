## Checkouts

### List of All

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$items = $chargily_pay->checkouts()->all();

```

### Retrieve

```php
/**
* @var Chargily\ChargilyPay\Elements\CheckoutElement|null
*/
$checkout = $chargily_pay->checkouts()->get("checkout_id");

```

### Create

```php
/**
* @var Chargily\ChargilyPay\Elements\CheckoutElement|null
*/
$checkout = $chargily_pay->checkouts()->create([
    "locale" => "en",//this is language en,ar,fr
    "description" => "This description for checkout",
    "items" => [
        [
            "price" => "price_id",
            "quantity" => 1,
        ],
    ],
    "metadata" => [],
    "success_url" => "Redirect URL after payment completed",
    "failure_url" => "Redirect URL after payment failure",
    "webhook_endpoint" => "Webhook URL TO Recieve payment status",
]);

```

### Expire

-   Change checkout status to expired

```php
/**
* @var Chargily\ChargilyPay\Elements\CheckoutElement|null
*/
$checkout = $chargily_pay->checkouts()->expire("checkout_id");
```

### Retrieve Prices

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$prices = $chargily_pay->checkouts()->prices("checkout_id");

```

### `Chargily\ChargilyPay\Elements\CheckoutElement` Relations

-   You can access the checkout prices list directly from `Chargily\ChargilyPay\Elements\CheckoutElement`

```php

$checkout = $chargily_pay->checkouts()->get("checkout_id");

$prices = $checkout->prices()->all();

```
