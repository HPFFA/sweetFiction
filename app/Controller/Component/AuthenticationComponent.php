<?php

App::uses('AuthComponent', 'Controller/Component');

/**
 * AuthenticationComponent extends the behavior of AuthComponent
 * with modifications for using cookies for permanent sessions
 */
class AuthenticationComponent extends Component
{
    var $components = array(
        'Cookie',
        'Session',
        'Auth',
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

    public function allow($action = null) {
        $this->Auth->allow($action);
    }

    public function deny($action = null) {
        $this->Auth->deny($action);
    }

    public function startup(Controller $controller) {
        $this->controller =& $controller;
    }

    public function register(CakeRequest $request) {
        $this->User->create();
        if ($this->User->save($request->data)) {
            $this->Auth->flash(__('The author has been registered'));
            $this->controller->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
        } else {
            $this->Auth->flash(__('The author could not be registered. Please, try again.'));
        }
    }

    public function tryToLogin(CakeRequest $request) {
        if ($this->Auth->login()) {
            if ($request->data['Session']['keep_logged_in'] == '1') {
                $this->remember($this->user());
            }
            $this->Auth->flash(__('Welcome %s', $this->Auth->user('name')));
            $this->controller->redirect($this->Auth->redirect());
        }
        $this->Auth->setFlash(__('Invalid username or password'));
    }

    public function logout() {
        $this->forget();
        $this->Auth->flash(__('Goodbye %s', $this->Auth->user('name')));
        $this->controller->redirect(parent::logout());
    }

    public function remember($user) {
        $cookie = array();
        $cookie[$this->fields['username']] = $user['name'];
        $cookie[$this->fields['password']] = $user['password'];
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
            $this->Auth->logout();
        }
    }

    public function forget() {
        $this->Cookie->destroy();
    }
}

?>
