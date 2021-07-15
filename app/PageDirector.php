<?php declare(strict_types = 1);

namespace App;

class PageDirector
{
    public $session;
    public $response;

    public function __construct($session, $response)
    {
        $this->session = $session;
        $this->response = $response;
    }

    public function run()
    {
        if (!$this->isLoggedIn()) {
            $this->showLogin();
        }

        $this->response->display();
    }

    public function isLoggedIn() {
        return ($this->session->get('user_name')) ? true : fals;
    }

    public function showLogin()
    {
        $this->response->addBody('<form method="post">');
        $this->response->addBody('Name: <input type="text" name="name">');
        $this->response->addBody("\n");
        $this->response->addBody(
            'Password: <input type="password" name="password">'
        );
        $this->response->addBody("\n");
        $this->response->addBody('<input type="submit" value="Login">');
        $this->response->addBody('</form>');
    }
}