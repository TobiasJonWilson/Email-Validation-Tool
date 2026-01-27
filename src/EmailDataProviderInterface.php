<?php

declare(strict_types=1);

namespace EmailValidation;

interface EmailDataProviderInterface
{
    public function getEmailProviders(): array;

    public function getTopLevelDomains(): array;

    public function getDisposableEmailProviders(): array;

    public function getRoleEmailPrefixes(): array;
}
