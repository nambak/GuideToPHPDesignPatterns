<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\FileErrorLogger;

final class FileErrorLoggerTestCase extends TestCase
{
    protected $fh;
    protected $testFile = 'test.log';

    protected function setUp(): void
    {
        @unlink($this->testFile);
        $this->fh = fopen($this->testFile, 'w');
    }

    public function testRequiresFileHandleToInstantiate(): void
    {
        //
    }

    public function testWrite(): void
    {
        $content = 'test' . rand(10, 100);
        $log = new FileErrorLogger($this->fh);
        $log->write($content);
        $fileContents = file_get_contents($this->testFile);

        $this->assertStringMatchesFormat("/{$content}$/", $fileContents);
    }

    public function testWriteIsTimeStamped(): void
    {
        //
    }
}