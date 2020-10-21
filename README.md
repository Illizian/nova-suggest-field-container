# Laravel Nova Suggest Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/illizian/nova-suggest-field-container.svg)](https://packagist.org/packages/illizian/nova-suggest-field-container)
[![License](https://img.shields.io/packagist/l/Illizian/nova-suggest-field-container.svg)](https://github.com/Illizian/nova-suggest-field-container/blob/master/LICENSE.md)

## Description

A container for TextArea fields that enables typeahead auto suggestions

### Demo

![Demo](https://raw.githubusercontent.com/Illizian/nova-suggest-field-container/main/docs/nova-suggest-field-container-demo.gif)

### Installation

The package can be installed through Composer.

```bash
composer require illizian/nova-suggest-field-container
```

## Usage

Wrap your TextArea with `\Illizian\NovaSuggestWrapper\NovaSuggestWrapper`, like so:

```php
/* ... */
use \Illizian\NovaSuggestWrapper\NovaSuggestWrapper;
/* ... */

class Example extends Resource
{
    /* ... */
    public function fields(Request $request)
    {
        return [
            /* ... */
            NovaSuggestWrapper::make(
                [
                    Textarea::make(__('Textarea'), 'textarea')
                ]
            )->suggestions([ "foo", "foobar" ]),
        ];
    }
```

You can update the trigger character with the `trigger(string $char)` method, for example, here we allow people to mention User's by their username using the `@` character:

```php
/* ... */
use \App\Models\User;
use \Illizian\NovaSuggestWrapper\NovaSuggestWrapper;
/* ... */

class Example extends Resource
{
    /* ... */
    public function fields(Request $request)
    {
        $users = User::all()->pluck('username')->toArray();

        return [
            /* ... */
            NovaSuggestWrapper::make(
                [
                    Textarea::make(__('Textarea'), 'textarea')
                ]
            )->trigger('@')->suggestions($users),
        ];
    }
```

## License

The MIT License (MIT). Please see [License File](https://github.com/Illizian/nova-suggest-field-container/blob/main/LICENSE.md) for more information.
