# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jubayed/gh-envato.svg?style=flat-square)](https://packagist.org/packages/jubayed/gh-envato)
[![Build Status](https://img.shields.io/travis/jubayed/gh-envato/master.svg?style=flat-square)](https://travis-ci.org/jubayed/gh-envato)
[![Quality Score](https://img.shields.io/scrutinizer/g/jubayed/gh-envato.svg?style=flat-square)](https://scrutinizer-ci.com/g/jubayed/gh-envato)
[![Total Downloads](https://img.shields.io/packagist/dt/jubayed/gh-envato.svg?style=flat-square)](https://packagist.org/packages/jubayed/gh-envato)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require jubayed/gh-envato
```

## Usage

``` bash
'providers' => [
    // ...
    Jubayed\GhEnvato\GhEnvatoServiceProvider::class,
];
```

required: manually add the service provider in your config/app.php file:

``` bash
'providers' => [
    // ...
    Jubayed\GhEnvato\GhEnvatoServiceProvider::class,
];
```

You should publish the config/gh-envato.php config file with:

``` bash
php artisan vendor:publish --provider="Jubayed\GhEnvato\GhEnvatoServiceProvider" --tag=config
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email gh-envato instead of using the issue tracker.

## Credits

- [Jubayed Hossain](https://github.com/jubayed/gh-envato)
- [All Contributors](../../contributors)

## License

The The Unlicense. Please see [License File](LICENSE.md) for more information.
