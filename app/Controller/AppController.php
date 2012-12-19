<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('Model', 'User');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Acl',
        'Cookie',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'name',
                        'password' => 'password'
                    ),
                ),
            ),
            'loginAction' => array(
                'controller' => 'authentication',
                'action' => 'login',
                'plugin' => null
            ),
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authorize' => 'Controller'
        ),
    );

    public $uses = array('User');

    public $helper = array('Auth');

    /**
     * Cookie retention period.
     *
     * @var string
     */
    var $period = '+1 month';
    var $cookieName = 'SweetFictionUser';


    public function isAuthorized($user) {
        // todo build permission based system - acl are hard to handle for some weird reason
        //return !empty($user);
        return true;
    }


    public function beforeFilter(){
        //$this->set('auth', $this->Auth);
        $this->tryToResume();
        //$this->Authentication->allow('index',  'display', 'view');
        $this->Auth->allow('*');
    }



    public function enableCookieLogin($user) {
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
            //$this->Cookie->write($this->cookieName, $cookie, true, $this->period);
            $this->enableCookieLogin($cookie);

            $this->controller->set("User", $this->Auth->user());
        } else {
            $this->disableCookieLogin();
            $this->Auth->logout();
        }
    }

    public function disableCookieLogin() {
        $this->Cookie->destroy();
    }
    
    public function isOwner() {
        return false;
    }

}
