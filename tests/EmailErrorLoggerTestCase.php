<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

final class EmailErrorLoggerTestCase extends TestCase
{
    public function testEmailAddressFirstConstructorParameter(): void
    {
        $this->expectError();

        $log = new EmailErrorLogger;

        $this->expectErrorMessageMatches('/missing.*/i');
    }

    public function testEmail(): void
    {
        $log = new EmailErrorLogger('alex@fleapop.co.kr');
        $log->mail('test message');
    }
}