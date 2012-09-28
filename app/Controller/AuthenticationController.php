<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');

/**
 * Authentications Controller
 *
 */
class AuthenticationController extends AppController {

    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'login');
    }

    public function tryToCreateUser(CakeRequest $request) {
        $this->User->create();
        if ($this->User->save($request->data)) {
            $this->Auth->flash(__('The author has been registered'));
            $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
        } else {
            $this->Auth->flash(__('The author could not be registered. Please, try again.'));
        }
    }

    public function tryToLogin(CakeRequest $request) {
        if ($this->Auth->login()) {
            if ($request->data['Session']['keep_logged_in'] == '1') {
                $this->enableCookieLogin($this->user());
            }
            $this->Auth->flash(__('Welcome %s', $this->Auth->user('name')));
            $this->redirect($this->Auth->redirect());
        }
        $this->Auth->setFlash(__('Invalid username or password'));
    }

    public function logout() {
        $this->disableCookieLogin();
        $this->Auth->flash(__('Goodbye %s', $this->Auth->user('name')));
        $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->tryToCreateUser($this->request);
        }
        unset($this->request->data['User']['password']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $this->tryToCreateUser($this->request);
        }
        unset($this->request->data['User']['password']);
    }
}
