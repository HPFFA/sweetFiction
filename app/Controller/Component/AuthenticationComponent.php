<?php

App::uses('AuthComponent', 'Controller/Component');

/**
 * AuthenticationComponent extends the behavior of AuthComponent
 * with modifications for using cookies for permanent sessions
 */
class AuthenticationComponent extends AuthComponent
{
    var $components = array(
        'Cookie',
        'Session',
        'Acl'
    );

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

    public function tryToLogin(CakeRequest $request) {
        if ($this->login($request)) {
            if ($request->data['Session']['keep_logged_in'] == '1') {
                $this->remember($this->user());
            }
            $this->controller->set("User", $this->user());
            $this->controller->redirect($this->redirect());
        }
        $this->Session->setFlash(__('Invalid username or password'), 'default', array(), 'auth');
    }

    public function logout() {
        $this->forget();
        $this->controller->redirect($this->logout());
    }

    public function remember($user) {
        $cookie = array();
        $cookie[$this->fields['username']] = $user['name'];
        $cookie[$this->fields['password']] = $user['password'];
        $this->Cookie->write($this->cookieName, $cookie, true, $this->period);
    }

    public function tryToResume() {
        $cookie = $this->Cookie->read($this->cookieName);

        if (!is_array($cookie) || $this->user())
            return;

        if ($this->login($cookie)) {
            $this->Cookie->write($this->cookieName, $cookie, true, $this->period);

            $this->controller->set("User", $this->user());
        } else {
            $this->forget();
        }
    }

    public function forget() {
        $this->Cookie->destroy();
    }
}

?>
