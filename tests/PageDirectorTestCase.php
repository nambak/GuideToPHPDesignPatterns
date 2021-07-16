<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Session;
use App\PageDirector;
use App\Response;

final class PageDirectorTestCase extends TestCase
{
    const SELF = 'testvalue';

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

    public function testLoggedOutContent()
    {
        $session = $this->createMock(Session::class);
        $session->setRetrunValue('get', null, ['user_name']);
        $session->expects($this->once())->method('get', ['user_name']);

        $page = new PageDirector($session, new Response);
        $result = $this->runPage($page);
        $this->assertWantedPattern('/secret.*content/i', $result);
        $this->assertNoUnwantedPattern('/<form.*<input[^>]*text[^>]*name.*<input[^>]*password[^>]*passwd/ims' . $result);
        $session->tally();
    }

    public function testClearLoginFunctionality()
    {
        $_REQUEST['clear'] = null;
        $session = $this->createMock(Session::class);
        $session->expects($this->once())->method('clear')->with(['user_name']);
        $session->setReturnValue('get', null, ['user_name']);
        $session->expects($this->once())->method('get');

        $response = $this->createMock(Response::class);
        $response->assertEquals('', $this->runPage($page));

        $response->tally();
        $session->tally();
        unset($_REQUEST['clear']);
    }

    public function testLoginFromRequest()
    {
        $_REQUEST['name'] = 'admin';
        $_REQUEST['password'] = 'secret';

        $session = $this->createMock(Session::class);
        $session->expects($this->once())->method('set')->with(['user_name', 'admin']);

        $response = $this->createMock(Response::class);
        $response->expects($this->once())->method('redirect')->with([self]);

        $page = $this->createMock(PageDirector::class);
        $this->assertEquals('', $this->runPage($page));

        $reponse->tally();
        $session->tally();

        unset($_REQUEST['name']);
        unset($_REQUEST['password']);
    }

    public function runPage($page)
    {
        ob_start();
        $page->run();

        return ob_get_clean();
    }
}