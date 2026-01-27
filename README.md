## Internal adaptation of [PHP Email Validation Tool](https://github.com/daveearley/PHP-Email-Validation-Tool)

### By [daveearley](https://github.com/daveearley) 

**An extensible email validation library for PHP 7+**

The aim of this library is to offer a more detailed email validation report than simply checking if an email is the valid format, and also to make it possible to easily add custom validations.

Currently this tool checks the following:


| Validation  | Description |
| ------------- | ------------- |
| MX records  | Checks if the email's domain has valid MX records  |
| Valid format  | Validates e-mail addresses against the syntax in RFC 822, with the exceptions that comments and whitespace folding and dotless domain names are not supported (as it uses PHP's [filter_var()](http://php.net/manual/en/function.filter-var.php)).  |
| Email Host  | Checks if the email's host (e.g gmail.com) is reachable  |
| Role/Business Email^  | Checks if the email is a role/business based email (e.g info@reddit.com).  |
| Disposable email provider^  | Checks if the email is a [disposable email](https://en.wikipedia.org/wiki/Disposable_email_address) (e.g person@10minutemail.com).  |
| Free email provider^  | Checks if the email is a free email (e.g person@yahoo.com).  |
| Misspelled Email ^ | Checks the email for possible typos and returns a suggested correction (e.g hi@gmaol.con -> hi@gmail.com).  |

^ **Data used for these checks can be found [here](https://github.com/daveearley/Email-Validation-Tool/tree/master/src/data)**


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
"valid_format": true,
"valid_mx_records": false,
"possible_email_correction": "dave@gmail.com",
"free_email_provider": false,
"disposable_email_provider": false,
"role_or_business_email": false,
"valid_host": false
}
```
