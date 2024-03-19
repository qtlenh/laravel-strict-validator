# Laravel Strict Validator

Add new parameters `strict` and `cast` to the existing Laravel rules: `integer`, `numeric`, `decimal`, `boolean`.

To install Laravel Type Validator, simply require it via Composer:

`composer require qtlenh/laravel-strict-validator`

Use `strict` to strictly check the input data type (suitable for designing APIs that receive JSON payloads).

Occasionally, frontend developers may not send data type as you expect. Use the `cast` parameter to coerce the input data to the correct data type being validated.

```php
$request->validate([
  'width' => 'integer:strict', // return error if `width` is string type
  'height' => 'integer:cast', // cast `height` to integer type if it is valid
]);
```
