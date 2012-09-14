<?php

App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');


class DebugController extends AppController {

    public $name = 'Debug';

    public $uses = array('Group', 'User');

    public function beforeFilter(){
        $this->guard();
        $this->Auth->allow('*');
    }

    private function guard()  {
        if (Configure::read('debug') == 0) {
            $this->finish(__('Operation denied.'));
        }
    }

    private function finish($message = null) {
        if (isset($message)){
            $this->Session->setFlash($message);
        }
        $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
    }

    public function initialize(){
        $this->clear(false);
        $groups = array(
            array('Group' => array('name' => 'User')),  // 1
            array('Group' => array('name' => 'Adminstrator'))); // 2
        foreach ($groups as $group) {
            $this->Group->create();
            $this->Group->save($group);
        }
        $users = array(
            array('User' => array(
                    'name' => 'Super Mario',
                    'group_id' => '1',
                    'email' => 'super_mario@example.com',
                    'password' => 'super_mario')),
            array('User' => array(
                    'name' => 'Luigi',
                    'group_id' => '1',
                    'email' => 'luigi@example.com',
                    'password' => 'luigi')),
            array('User' => array(
                    'name' => 'Princess Peach',
                    'group_id' => '2',
                    'email' => 'princess_peach@example.com',
                    'password' => 'princess_peach')));
        foreach ($users as $user) {
            $this->User->create();
            $user['User']['confirmation'] = $user['User']['password'];
            $this->User->save($user);
        }
        $this->finish(__('Created fixtures'));
    }


    /**
     * Truncate the database table
     *
     * @param mixed What page to display
     * @return void
     */
    public function clear($redirect = true) {
        $db = ConnectionManager::getDataSource('default');
        $result = $db->query("SHOW TABLES");
        $tables = array();
        foreach ($result as $row) {
            $table = $row[$db->map[0][0]][$db->map[0][1]];
            $db->truncate($table);
            $tables[] = $table;
        }
        if ($redirect) {
            $this->finish(__('Database tables cleared').'<br />&nbsp;&nbsp;['.implode(' | ', $tables).']');
        }
    }
}
