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
        $this->processLogin();

        if ($this->isLoggedIn()) {
            $this->showPage(
                new UserLogin($this->session->get('user_name'))
            );
        } else {
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

    public function showPage($user)
    {
        $vars = [
            'name' => $user->name(),
            'self' => SELF,
        ];

        $this->response->addBodyTemplate('page.tpl', $vars);
    }

    public function processLogin()
    {
        if (array_key_exists('clear', $_REQUEST)) {
            $this->session->clear('user_name');
            $this->response->redirect(self);
        }

        if (array_key_exists('name', $_REQUEST) && array_key_exists('password', $_REQUEST)
            && UserLogin::validate($_REQEST['name'], $_REQUEST['password'])) {
                $this->session->set('user_name', $_REQUEST['name']);
                $this->response->redirect(self);
            }
    }
}