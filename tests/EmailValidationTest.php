<?php

declare(strict_types=1);

namespace EmailValidation\Tests;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProviderInterface;
use EmailValidation\EmailValidator;
use EmailValidation\ValidationResults;
use EmailValidation\Validations\MisspelledEmailValidator;
use EmailValidation\Validations\ValidFormatValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private ValidationResults $validationResultsMock;

    private EmailValidator $emailValidation;

    public function testRunValidation(): void
    {
        /** @var MisspelledEmailValidator|MockInterface $mockValidation */
        $mockValidation = Mockery::mock(MisspelledEmailValidator::class);

        $mockValidation->shouldReceive('getValidatorName')->andReturn('hello');
        $mockValidation->shouldReceive('getResultResponse')->andReturn('hello');
        $mockValidation->shouldReceive('setEmailAddress')->andReturnSelf();
        $mockValidation->shouldReceive('setEmailDataProvider')->andReturnSelf();

        $this->emailValidation->registerValidators([$mockValidation]);
        $this->emailValidation->runValidation();

        $this->assertSame(
            ['hello' => 'hello'],
            $this->validationResultsMock->asArray(),
        );
    }

    public function testGetValidationResults(): void
    {
        /** @var ValidFormatValidator|MockInterface $mockValidation */
        $mockValidation = Mockery::mock(ValidFormatValidator::class);

        $mockValidation->shouldReceive('getValidatorName')->andReturn('validFormat');
        $mockValidation->shouldReceive('getResultResponse')->andReturn(true);
        $mockValidation->shouldReceive('setEmailAddress')->andReturnSelf();
        $mockValidation->shouldReceive('setEmailDataProvider')->andReturnSelf();

        $this->emailValidation->registerValidator($mockValidation);

        $actual = $this->emailValidation->getValidationResults();
        $this->assertInstanceOf(ValidationResults::class, $actual);
        $this->assertSame(
            ['validFormat' => true],
            $actual->asArray(),
        );
    }

    protected function setUp(): void
    {
        $emailMock                   = new EmailAddress('user@example.com');
        $this->validationResultsMock = new ValidationResults();
        $emailDataProviderMock       = Mockery::mock(EmailDataProviderInterface::class);
        $this->emailValidation       = new EmailValidator(
            $emailMock,
            $this->validationResultsMock,
            $emailDataProviderMock,
        );
    }
}
