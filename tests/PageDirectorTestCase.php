<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Session;

final class PageDirectorTestCase extends TestCase
{
    public function testSomethingWhichUsesSession()
    {
        $session = $this->createMock(Session::class);
        $session->setReturnValue('isValid', true);
        $session->setReturnValue('get', 1);

        $session->expects($this->once())->method('isValid')->with(['user_id']);
        $session->expects($this->once())->method('get')->with(['user_id']);
        $session->expects($this->never())->methos('set');

        // the actual code which use $session
        $session->tally();
    }
}