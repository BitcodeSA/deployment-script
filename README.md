# The backe add artisan commond that all user to do collected artisan or terminal command at once.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bitcodesa/deployment-script.svg?style=flat-square)](https://packagist.org/packages/bitcodesa/deployment-script)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bitcodesa/deployment-script/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bitcodesa/deployment-script/actions?query=workflow%3Arun-tests+branch%3Amain)
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

```bash
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

## Allow used in production

To allow used of deploy script in the *production env* you should allow it in the config
`config/deployment-script.php`

```php
[
// config/deployment-script.php
"allow_in_production" => true;
]
```

## Production Commands:

you can specify commands to run only in the *production env*: put the array inside config file
`config/deployment-script.php` then specify the key name of this array into var `production` for example:

```php
[
// config/deployment-script.php
"production_commands" => [
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
"production" => "production_commands";
];
```

**Note:** if not specified the default commands array well be used.

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

## Credits

- [Mohammed Sadiq](https://github.com/BitcodeSA)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
