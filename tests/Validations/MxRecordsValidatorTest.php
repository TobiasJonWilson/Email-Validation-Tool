<?php

declare(strict_types=1);

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\MxRecordsValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class MxRecordsValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var MxRecordsValidator|Mockery\MockInterface */
    private $mxValidator;

    public function testMxRecordIsChecked_andReturnsTrueWhenAtLeastTwoRecordsExist(): void
    {
        $this->mxValidator
        ->shouldAllowMockingProtectedMethods()
        ->shouldReceive('checkDns')
        ->once()
        ->with('gmail.com.', 'NS')
        ->andReturn(true);

        $this->mxValidator
        ->shouldAllowMockingProtectedMethods()
        ->shouldReceive('checkDns')
        ->once()
        ->with('gmail.com.', 'MX')
        ->andReturn(true);

        $this->mxValidator
        ->shouldAllowMockingProtectedMethods()
        ->shouldReceive('checkDns')
        ->once()
        ->with('gmail.com.', 'A')
        ->andReturn(false);

        $this->mxValidator
        ->shouldAllowMockingProtectedMethods()
        ->shouldReceive('checkDns')
        ->once()
        ->with('gmail.com.', 'AAAA')
        ->andReturn(false);

        $this->assertTrue($this->mxValidator->getResultResponse());
    }

    public function testMxRecordIsChecked_andReturnsFalseWhenFewerThanTwoRecordsExist(): void
    {
        foreach (['NS', 'MX', 'A', 'AAAA'] as $dns) {
            $this->mxValidator
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('checkDns')
            ->once()
            ->with('gmail.com.', $dns)
            ->andReturn($dns === 'NS'); // only one true
        }

        $this->assertFalse($this->mxValidator->getResultResponse());
    }

    protected function setUp(): void
    {
        $this->mxValidator = Mockery::mock(MxRecordsValidator::class, [
        new EmailAddress('dave@gmail.com'),
        ])
        ->shouldAllowMockingProtectedMethods()
        ->makePartial();
    }
}
