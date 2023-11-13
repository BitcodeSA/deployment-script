# The package add artisan commond that allow user to do collected artisan or terminal command at once.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bitcodesa/deployment-script.svg?style=flat-square)](https://packagist.org/packages/bitcodesa/deployment-script)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bitcodesa/deployment-script/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bitcodesa/deployment-script/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bitcodesa/deployment-script/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bitcodesa/deployment-script/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bitcodesa/deployment-script.svg?style=flat-square)](https://packagist.org/packages/bitcodesa/deployment-script)

**Package Description**

This package provides a convenient way to run groups of Artisan commands through a pre-defined configuration file. This
can be useful for automating tasks such as deployment, database maintenance, and testing.

**Features**

* Run groups of Artisan commands with a single command
* Override command options in the configuration file
* Pass values to artisan commands like `--force`.
* Run command like `git pull`.

**Example**

For example, to run the following commands:

```
php artisan migrate:fresh
php artisan cache:clear
php artisan route:cache
```

```php
return [
    'commands' => [
        [
            "type" => "artisan",
            "command" => "migrate:fresh"
        ],
        [
            "type" => "artisan",
            "command" => "cache:clear"
        ],
        [
            "type" => "artisan",
            "command" => "route:cache"
        ],
    ],
];
```

Then, you would run the following command:

```
php artisan deploy
```

This package is a valuable tool for any Laravel developer who needs to automate tasks or run groups of Artisan commands
on a regular basis.

## Installation

You can install the package via composer:

```bash
composer require bitcodesa/deployment-script
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="deployment-script-config"
```

This is the contents of the published config file:

```php
return [
     "commands" => [
        [
            "type" => "console",
            "command" => "git pull"
        ],
        [
            "type" => "console",
            "command" => "composer install --optimize-autoloader",
        ],
        [
            "type" => "artisan",
            "command" => "migrate",
            "values" => [
                "--force" => true
            ]
        ],
        [
            "type" => "artisan",
            "command" => "cache:clear",
        ],
    ]
];
```

## Usage

```bash
php artisan deploy
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohammed Sadiq](https://github.com/BitcodeSA)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
