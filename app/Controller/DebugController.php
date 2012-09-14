<?php

App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');


class DebugController extends AppController {

    public $name = 'Debug';
    public $components = array('Acl');

    public $uses = array('Group', 'User');

    public function beforeFilter(){
        $this->guard();
        $this->Authentication->allow('*');
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
        }
    }

    private function initializeGroups(){
        $this->create(
            $this->Group,
            array(
                array('Group' => array('name' => 'User')),  // 1
                array('Group' => array('name' => 'Adminstrator')) // 2
            )
        );
    }

    private function initializeAccessControlLists(){
        $this->create(
            $this->Acl->Aco,
            array(
                array('parent_id' => null, 'alias' => 'controllers')
            )
        );
    }

    private function initializeUser(){
        $users = array(
                array('User' => array(
                        'name' => 'Super Mario',
                        'group_id' => '2',
                        'email' => 'super_mario@example.com',
                        'password' => 'super_mario')),
                array('User' => array(
                        'name' => 'Luigi',
                        'group_id' => '1',
                        'email' => 'luigi@example.com',
                        'password' => 'luigi')),
                array('User' => array(
                        'name' => 'Princess Peach',
                        'group_id' => '1',
                        'email' => 'princess_peach@example.com',
                        'password' => 'princess_peach'))
            );
        for ($i = 0; $i < sizeof($users); $i++){
            $users[$i]['User']['confirmation'] = $users[$i]['User']['password'];
        }
        $this->create($this->User, $users);
    }

/**
 * Fill the database with some sample fixtures for development
 */
    public function initialize(){
        $this->clear(false);
        $this->initializeGroups();
        $this->initializeAccessControlLists();
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
