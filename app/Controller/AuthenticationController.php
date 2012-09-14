<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');

/**
 * Authentications Controller
 *
 */
class AuthenticationController extends AppController {

    public $components = array('Authentication');

    public function beforeFilter() {
        $this->Auth->allow('register', 'login');
        parent::beforeFilter();
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->Authentication->register($this-request);
        }
        unset($this->request->data['User']['password']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $this->Authentication->login($this->request);
        }
        unset($this->request->data['User']['password']);
    }

    public function logout() {
        $this->Authentication->logout();
    }


}
