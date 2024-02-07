# Chargily Pay V2

PHP Library for Chargily Pay™ Gateway - V2.

The easiest and free way to integrate payment API through EDAHABIA of Algerie Poste and CIB of SATIM in your PHP project.

# Requirements

-   PHP >= 8.1.10

# Installation

-   Via Composer (Recomended)

```bash
composer require chargily/chargily-pay
```

# Getting Started

-   Replace **test** by **live** if you are in production mode
-   Replace **public_key_here** with your public key shown in the Chargily Pay dashboard in the developer section
-   Replace **secret_key_here** with your secret key shown in the Chargily Pay dashboard in the developer section

```php

    use Chargily\ChargilyPay\Auth\Credentials;
    use Chargily\ChargilyPay\ChargilyPay;

    require "path-to-vendor/autoload.php";

    $credentials = new Credentials([
        "mode" => "test",
        "public" => "public_key_here",
        "secret" => "secret_key_here",
    ]);

    $chargily_pay = new ChargilyPay($credentials);

    $chargily_pay->balance()->get(),
    $chargily_pay->checkouts()->all(),
    $chargily_pay->customers()->all(),
    $chargily_pay->payment_links()->all(),
    $chargily_pay->prices()->all(),
    $chargily_pay->products()->all(),
    //validate and get Webhook details
    $chargily_pay->webhook()->get()

```

# Documentation

-   [Balance](./blob/main/docs/Balance.md)
-   [Checkouts](./blob/main/docs/Checkouts.md)
-   [Customers](./blob/main/docs/Customers.md)
-   [Payment Links](./blob/main/docs/PaymentLinks.md)
-   [Prices](./blob/main/docs/Prices.md)
-   [Products](./blob/main/docs/Products.md)
-   [Webhook](./blob/main/docs/Webhook.md)
