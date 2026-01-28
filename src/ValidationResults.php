<?php

declare(strict_types=1);

namespace EmailValidation;

final class ValidationResults
{
    private array $results = [];

    public function addResult(string $resultName, mixed $resultValue): void
    {
        $this->results[$resultName] = $resultValue;
    }

    public function asArray(): array
    {
        return $this->results;
    }

    public function asJson(): string
    {
        return json_encode($this->results, JSON_UNESCAPED_SLASHES);
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }
}
