# Xtroo PHP Client Library

This package is an API Wrapper for the Xtroo Content Extraction system.

Full documentation is available at Xtroo.io

[![Build Status](https://travis-ci.org/Xtroo/php-client.svg?branch=master)](https://travis-ci.org/Xtroo/php-client)

## Requirements

This API Library is built for PHP 7

## Installation

```bash
composer require xtroo/php-client
```

## Usage

To use the library you can simply call it and go

```php
$Xtroo = new Xtroo('my_token');
$data = $Xtroo->getArticle('.....');
print_r($data);
```


## Testing

Just run PHPUnit in the root folder of the project.

```bash
phpunit
```

