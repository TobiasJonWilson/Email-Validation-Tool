## Adaptation of the PHP Email Validation Tool

### Based on the original PHP project [Email Validation Tool](https://github.com/daveearley/Email-Validation-Tool) by [daveearley](https://github.com/daveearley) 

**An extensible email validation library for PHP 8.3+**

The aim of this library is to offer a more detailed email validation report than simply checking if an email is the valid format and also to make it possible to easily add custom validations.

Currently, this tool checks the following:


| Validation  | Description |
| ------------- | ------------- |
| MX records  | Checks if the email's domain has valid MX records  |
| Valid format  | Validates e-mail addresses against the syntax in RFC 822, with the exceptions that comments and whitespace folding and dotless domain names are not supported (as it uses PHP's [filter_var()](http://php.net/manual/en/function.filter-var.php)).  |
| Email Host  | Checks if the email's host (e.g gmail.com) is reachable  |
| Role/Business Email^  | Checks if the email is a role/business based email (e.g info@reddit.com).  |
| Disposable email provider^  | Checks if the email is a [disposable email](https://en.wikipedia.org/wiki/Disposable_email_address) (e.g person@10minutemail.com).  |
| Free email provider^  | Checks if the email is a free email (e.g person@yahoo.com).  |
| Misspelled Email ^ | Checks the email for possible typos and returns a suggested correction (e.g hi@gmaol.con -> hi@gmail.com).  |

^ **Data used for these checks can be found [here](https://github.com/TobiasJonWilson/Email-Validation-Tool/tree/master/src/data)**


## Quick Start

```php
// Include the composer autoloader
require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidation\EmailValidatorFactory::create('dave@gmoil.con');

$jsonResult = $validator->getValidationResults()->asJson();
$arrayResult = $validator->getValidationResults()->asArray();

echo $jsonResult;

```

Expected output:

```json
{
"validFormat": true,
"validHost": false,
"validMX": false,
"altAddress": "dave@gmail.com",
"isFree": false,
"isDisposable": false,
"isBusiness": false
}
```

## Acknowledgements

This project is a fork and adaptation of the excellent [Email Validation Tool](https://github.com/daveearley/Email-Validation-Tool) created by [Dave Earley](https://github.com/daveearley). 

I highly recommend checking out the [original repository](https://github.com/daveearley/Email-Validation-Tool) to see the original work and consider using it for your projects. This fork has been modified to match our specific requirements (camelCase output, custom validator ordering), but the core validation logic and architecture are based on Dave's original implementation.

## AI Tools Disclosure

This project was developed with the assistance of AI coding tools, including [Cursor](https://cursor.sh/) and [GitHub Copilot](https://github.com/features/copilot) within my PHPStorm IDE. These tools were used to help with code refactoring, type hint improvements, documentation updates, and code review. All code changes were reviewed by me before being committed, and the final codebase reflects my decisions around the intended usage and coding standards.
