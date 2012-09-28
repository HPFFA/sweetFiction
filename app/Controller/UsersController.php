<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $uses = array('User', 'Group');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('register', 'index', 'view');
    }




/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    private function restoreSubmodelIds($user){

        $this->request->data['User']['id'] = $user['User']['id'];
        $this->request->data['UserProfile']['id'] = $user['UserProfile']['id'];
        $this->request->data['UserProfile']['user-id'] = $user['UserProfile']['user_id'];
        $this->request->data['UserContact']['id'] = $user['UserContact']['id'];
        $this->request->data['UserContact']['user_id'] = $user['UserContact']['user_id'];
        $this->request->data['UserSetting']['id'] = $user['UserSetting']['id'];
        $this->request->data['UserSetting']['user_id'] = $user['UserSetting']['user_id'];
    }


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        $this->User->id = $id;
        $user = $this->User->read(null, $id);
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->restoreSubmodelIds($user);
            if ($this->User->saveAssociated($this->request->data)) {

                $this->Session->setFlash(__('The user has been updated'));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The user could not be updated. Please try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        unset($this->request->data['User']['password']);
        $groups = $this->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user profile'));
        }
        $user = $this->User->read(null, $id);
        $this->set('user', $user);
        $groups = array();
        foreach ($user['GroupAssociations'] as $association){
            $groups[] = $this->Group->read(null, $association['group_id']);
        }
        $this->set('groups', $groups);

    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
