# Laravel Nova Suggest Field

## Description

A container for TextArea fields that enables typeahead auto suggestions

### Demo

![Demo](https://raw.githubusercontent.com/Illizian/nova-suggest-field-container/main/docs/nova-suggest-field-container-demo.gif)

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
