<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');

/**
 * Authentications Controller
 *
 */
class AuthenticationController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Authentication->allow('register', 'login');
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->Authentication->register($this-request);
        }
        unset($this->request->data['User']['password']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $this->Authentication->tryToLogin($this->request);
        }
        unset($this->request->data['User']['password']);
    }

    public function logout() {
        $this->Authentication->logout();
    }


}
