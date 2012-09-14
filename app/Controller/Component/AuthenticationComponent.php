<?php

App::uses('Component', 'Controller');

class AuthenticationComponent extends Component
{
    var $components = array('Auth', 'Cookie', 'Session');
    var $controller = null;
    var $uses = array("User");
    /**
    * Cookie retention period.
    *
    * @var string
    */
    var $period = '+1 month';
    var $cookieName = 'SweetFictionUser';

    public function startup(Controller $controller) {
        $this->controller =& $controller;
    }

    public function register(CakeRequest $request) {
        $this->User->create();
        if ($this->User->save($request->data)) {
            $this->Session->setFlash(__('The author has been registered'));
            $this->controller->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
        } else {
            $this->Session->setFlash(__('The author could not be registered. Please, try again.'));
        }
    }

    public function login(CakeRequest $request)
    {
        if ($this->Auth->login())
        {
            if ($request->data['Session']['keep_logged_in'] == '1')
            {
                $this->remember($this->Auth->user());
            }
            $this->controller->set("User", $this->Auth->user());
            $this->controller->redirect($this->Auth->redirect());
        }
        $this->Session->setFlash(__('Invalid username or password'), 'default', array(), 'auth');
    }

    public function logout()
    {
        $this->forget();
        $this->controller->redirect($this->Auth->logout());
    }

    public function remember($user) {
        $cookie = array();
        $cookie[$this->Auth->fields['username']] = $user['name'];
        $cookie[$this->Auth->fields['password']] = $user['password'];
        $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
    }

    public function tryToResume() {
        $cookie = $this->Cookie->read($this->cookieName);

        if (!is_array($cookie) || $this->Auth->user())
            return;

        if ($this->Auth->login($cookie)) {
            $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
            $this->controller->set("User", $this->Auth->user());
        } else {
            $this->forget();
        }
    }

    public function forget() {
        $this->Cookie->destroy();
    }
}

?>
