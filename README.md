# Welcome to PHP Package Repository
# for [Chargily Pay](https://chargily.com/business/pay "Chargily Pay")™ Gateway - V2.

Thank you for your interest in PHP Package of Chargily Pay™, an open source project by Chargily, a leading fintech company in Algeria specializing in payment solutions and  e-commerce facilitating, this Package is providing the easiest and free way to integrate e-payment API through widespread payment methods in Algeria such as EDAHABIA (Algerie Post) and CIB (SATIM) into your PHP/Laravel projects.

This package is developed by **Mohamed Boubazine ([Medboubazine](https://github.com/Medboubazine))** and is open to contributions from developers like you.

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


## About Chargily Pay™ packages

Chargily Pay™ packages/plugins are a collection of open source projects published by Chargily to facilitate the integration of our payment gateway into different programming languages and frameworks. Our goal is to empower developers and businesses by providing easy-to-use tools to seamlessly accept payments.

## API Documentation

For detailed instructions on how to integrate with our API and utilize Chargily Pay™ in your projects, please refer to our [API Documentation](https://dev.chargily.com/pay-v2/introduction). 

## Developers Community

Join our developer community on Telegram to connect with fellow developers, ask questions, and stay updated on the latest news and developments related to Chargily Pay™ : [Telegram Community](https://chargi.link/PayTelegramCommunity)

## How to Contribute

We welcome contributions of all kinds, whether it's bug fixes, feature enhancements, documentation improvements, or new plugin/package developments. Here's how you can get started:

1. **Fork the Repository:** Click the "Fork" button in the top-right corner of this page to create your own copy of the repository.

2. **Clone the Repository:** Clone your forked repository to your local machine using the following command:

```bash
git clone https://github.com/Chargily/chargily-pay-php.git
```

3. **Make Changes:** Make your desired changes or additions to the codebase. Be sure to follow our coding standards and guidelines.

4. **Test Your Changes:** Test your changes thoroughly to ensure they work as expected.

5. **Submit a Pull Request:** Once you're satisfied with your changes, submit a pull request back to the main repository. Our team will review your contributions and provide feedback if needed.

## Get in Touch

Have questions or need assistance? Join our developer community on [Telegram](https://chargi.link/PayTelegramCommunity) and connect with fellow developers and our team.

We appreciate your interest in contributing to Chargily Pay™! Together, we can build something amazing.

Happy coding!

