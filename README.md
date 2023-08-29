# Atome

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gerbang-bayar/atome.svg?style=flat-square)](https://packagist.org/packages/gerbang-bayar/atome)
[![Total Downloads](https://img.shields.io/packagist/dt/gerbang-bayar/atome.svg?style=flat-square)](https://packagist.org/packages/gerbang-bayar/atome)
![GitHub Actions](https://github.com/gerbang-bayar/atome/actions/workflows/main.yml/badge.svg)

SDK for Atome payment gateway. Can use as standalone package or use with `laraditz/bayar` laravel package. 

## Installation

```bash
composer require gerbang-bayar/atome
```

## Available Request Methods
Below are all methods available under this package.

- `checkConfiguration(string $countryCode, ?string $callbackUrl = null): Response`
- `createPayment(array $args): Response`
- `getPayment(string $referenceId): Response`
- `cancelPayment(string $referenceId): Response`
- `refundPayment(string $referenceId): Response`

## Usage

### Create Payment
To create payment and get the payment URL to be redirected to. You can use service container or facade.

```php
use GerbangBayar\Atome\Atome;


// Instantiate connector
$atome = new Atome(username: $username, password: $password, sandbox: false);

$response = $atome->createPayment(
    referenceId: 'someuniquereferenceid',
    currency: 'MYR',
    amount: 1000, // in cents
    callbackUrl: 'https:/callbackurl.here',
    paymentResultUrl: 'https:/returnurl.here',
    customerInfo: [
        'name' => 'Raditz Farhan',
        'phone' => '6012345678',
        'email' => 'raditzfarhan@gmail.com'
    ],
    shippingAddress: [
        'countryCode' => 'MY',
        'lines' => [
            'No 1, Taman ABC',
            'Jalan DCEF'
        ],
        'postCode' => '12345'
    ],
    items: [
        [
            'itemId' => 'ITEMSKU',
            'name' => 'Item 1',
            'quantity' => 1,
            'price' => 1000,
        ]
    ]
);
```

See [documentation](https://doc.apaylater.com/) for more details.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email raditzfarhan@gmail.com instead of using the issue tracker.

## Credits

-   [Raditz Farhan](https://github.com/gerbang-bayar)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
