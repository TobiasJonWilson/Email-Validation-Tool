<?php

declare(strict_types=1);

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\EmailHostValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class EmailHostValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var EmailHostValidator|Mockery\MockInterface $hostValidator */
    private $hostValidator;

    public function testHostIsChecked(): void
    {
        $this->hostValidator
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('getHostByName')
            ->once()
            ->with('gmail.com')
            ->andReturn('142.250.72.69'); // any non-equal string simulates DNS resolution

        $this->assertTrue($this->hostValidator->getResultResponse());
    }

    protected function setUp(): void
    {
        $this->hostValidator = Mockery::mock(EmailHostValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }
}
