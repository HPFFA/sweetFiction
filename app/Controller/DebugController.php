<?php

App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');


class DebugController extends AppController {

    public $name = 'Debug';

    public $uses = array('Group', 'User', 'UserGroupAssociation');

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

    private function create($object, $data){
        foreach ($data as $item) {
            $object->create();
            $object->save($item);
            //debug($object->validationErrors);
        }
    }

    private function initializeUser(){
        $this->create(
            $this->Group,
            array(
                array('Group' => array('id' => '1', 'name' => 'Administrator')),
                array('Group' => array('id' => '2', 'name' => 'Editor')),
                array('Group' => array('id' => '3', 'name' => 'Author')),
                array('Group' => array('id' => '4', 'name' => 'Reader')),
            )
        );
        $users = array(
                array('User' => array(
                        'id' => '1',
                        'name' => 'Super Mario',
                        'email' => 'super_mario@example.com',
                        'password' => 'super_mario',
                        'state' => 'active')),
                array('User' => array(
                        'id' => '2',
                        'name' => 'Luigi',
                        'email' => 'luigi@example.com',
                        'password' => 'luigi',
                        'state' => 'active')),
                array('User' => array(
                        'id' => '3',
                        'name' => 'Princess Peach',
                        'email' => 'princess_peach@example.com',
                        'password' => 'princess_peach',
                        'state' => 'active'))
            );
        for ($i = 0; $i < sizeof($users); $i++){
            $users[$i]['User']['confirmation'] = $users[$i]['User']['password'];
        }
        $this->create($this->User, $users);
        $this->create($this->UserGroupAssociation, array(
                array('UserGroupAssociation' => array('user_id' => '1', 'group_id' => '1')),
                array('UserGroupAssociation' => array('user_id' => '2', 'group_id' => '4')),
                array('UserGroupAssociation' => array('user_id' => '3', 'group_id' => '2')),
                array('UserGroupAssociation' => array('user_id' => '3', 'group_id' => '3')),
            )
        );
    }

/**
 * Fill the database with some sample fixtures for development
 */
    public function initialize(){
        $this->clear(false);
        $this->initializeUser();
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
