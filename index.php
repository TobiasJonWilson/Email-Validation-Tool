<?php

declare(strict_types=1);

use EmailValidation\EmailValidatorFactory;

require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidatorFactory::create($_GET['email'] ?? '');

header('Content-Type: application/json');
echo $validator->getValidationResults()->asJson();
