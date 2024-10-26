## Welcome to PHP Package Repository

# PHP Client for [Chargily Pay](https://chargily.com/business/pay "Chargily Pay")™ Gateway - V2.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chargily/chargily-pay.svg?style=flat-square)](https://packagist.org/packages/chargily/chargily-pay)
[![Tests](https://img.shields.io/github/actions/workflow/status/Chargily/chargily-pay-php/php.yml?branch=main&label=tests&style=flat-square)](https://github.com/Chargily/chargily-pay-php/actions/workflows/php.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/chargily/chargily-pay.svg?style=flat-square)](https://packagist.org/packages/chargily/chargily-pay)

<img src="https://mintlify.s3-us-west-1.amazonaws.com/chargily-78/logo/light.svg" alt="Chargily Logo" width="300"/>


Thank you for your interest in the `Chargily Pay™` PHP package! Developed by Chargily, Algeria's leading fintech innovator in payment and e-commerce solutions, this open-source package offers a seamless, cost-free way to integrate e-payment APIs into PHP and Laravel projects.

Supporting major Algerian payment methods, including EDAHABIA (Algerie Poste) and CIB (SATIM), this package simplifies e-commerce integration across popular platforms in Algeria.

Originally created by **Mohamed Boubazine ([Medboubazine](https://github.com/Medboubazine))**, the package is actively maintained by a [welcoming community of contributors](https://github.com/Chargily/chargily-pay-php/graphs/contributors). 

Contributions from developers like you are highly valued and encouraged!


## Requirements

To get started with the `Chargily Pay™` PHP package, ensure you have the following:

- **PHP**: Version 8.1 or higher
- **Chargily API Credentials**: Obtain your API keys from the [Chargily Developer Dashboard](https://pay.chargily.com/test/dashboard/developers-corner)

## Installation

Install the `Chargily Pay™` PHP package via Composer:

```bash
composer require chargily/chargily-pay
```

## Getting Started

### Create your first Chargily Pay™ checkout link

```php
use Chargily\ChargilyPay\Auth\Credentials;
use Chargily\ChargilyPay\ChargilyPay;

require 'vendor/autoload.php';

try{

    /**
     * Create a new Credentials instance
    */
    $credentials = new Credentials([
        "mode" => "test", // or live
        "public" => "public_key_here",
        "secret" => "secret_key_here"
    ]);

    /**
     * Create a new ChargilyPay instance
     */
    $chargily = new ChargilyPay($credentials);
    
    /**
     * Create a new checkout for the priced product
     */
    $checkout = $chargily_pay->checkouts()
        ->create([
            'amount' => 2500,
            'currency' => 'dzd',
            'success_url' => "https://example.com/success",
        ]);
        
    /**
     * Redirect the user to the checkout page
     */

    header("Location: ".$checkout->getUrl());
    
} catch (Exception $e) {

    echo $e->getMessage();
    
}
```

## Documentation

Explore detailed guides and references for integrating `Chargily Pay™` features:

- [Balance Overview](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Balance.md)
- [Checkouts Integration](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Checkouts.md)
- [Managing Customers](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Customers.md)
- [Creating Payment Links](https://github.com/Chargily/chargily-pay-php/blob/main/docs/PaymentLinks.md)
- [Setting Prices](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Prices.md)
- [Product Catalog](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Products.md)
- [Webhook Configuration](https://github.com/Chargily/chargily-pay-php/blob/main/docs/Webhook.md)

## Documentation for Frameworks

- [Laravel Integration Guide](https://github.com/Chargily/chargily-pay-php/blob/main/docs/frameworks/Laravel.md)

## About Chargily Pay™ packages

`Chargily Pay™` packages/plugins are a collection of open source projects published by Chargily to facilitate the integration of our payment gateway into different programming languages and frameworks. Our goal is to empower developers and businesses by providing easy-to-use tools to seamlessly accept payments.

## API Documentation

For comprehensive guidance on integrating our API and implementing `Chargily Pay™` in your projects, please refer to our [API Documentation](https://dev.chargily.com/pay-v2/introduction).

## Developers Community

Join our developer community on Telegram to connect with fellow developers, ask questions, and stay updated on the latest news and developments related to `Chargily Pay™` : [Telegram Community](https://chargi.link/PayTelegramCommunity)

## Contributing Guide

We appreciate all forms of contributions, including bug fixes, feature enhancements, documentation updates, and new plugin or package developments. Here’s how to get started:

1. **Fork the Repository:** Click on the "Fork" button at the top-right of this page to create your personal copy of the repository.

2. **Clone the Repository:** Download your forked repository to your local environment using this command:

    ```bash
    git clone https://github.com/Chargily/chargily-pay-php.git
    ```

3. **Make Changes:** Make your desired changes or additions to the codebase. Be sure to follow our coding standards and guidelines.

4. **Test Your Changes:** Test your changes thoroughly to ensure they work as expected.

5. **Submit a Pull Request:** Once you're satisfied with your changes, submit a pull request back to the main repository. Our team will review your contributions and provide feedback if needed.

## Get in Touch

Have questions or need assistance? Join our developer community on [Telegram](https://chargi.link/PayTelegramCommunity) and connect with fellow developers and our team.

We appreciate your interest in contributing to `Chargily Pay™`! Together, we can build something amazing.

Happy coding!


## Security Reports

If you discover any security vulnerabilities, please report them responsibly. 

Contact us directly at [Whatsapp](https://chargi.link/WaPay) to ensure safe and secure handling of any potential issues.