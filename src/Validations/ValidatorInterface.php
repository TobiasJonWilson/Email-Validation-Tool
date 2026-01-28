<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

interface ValidatorInterface
{
    public function getResultResponse(): mixed;

    public function getValidatorName(): string;
}
