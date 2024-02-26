# Chargily Pay V2

PHP Library for [Chargily Pay™](https://chargily.com/business/pay "Chargily Pay™") Gateway - V2.

The easiest way to integrate e-payment API through EDAHABIA of Algerie Poste and CIB of SATIM into your PHP/Laravel project.

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

-   [Balance](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Balance.md)
-   [Checkouts](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Checkouts.md)
-   [Customers](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Customers.md)
-   [Payment Links](https://github.com/Chargily/chargily-pay-php/blob/main/docs/PaymentLinks.md)
-   [Prices](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Prices.md)
-   [Products](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Products.md)
-   [Webhook](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Webhook.md)

# Documentation For frameworks

-   [Laravel](https://github.com/Chargily/chargily-pay-php/blob/main/docs/frameworks/Laravel.md)

