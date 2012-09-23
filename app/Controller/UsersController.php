<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Authentication->deny('edit');
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

    private function restoreSubmodelIds($id){
        $userData = $this->User->read(null, $id);
        $this->request->data['User']['id'] = $id;
        $this->request->data['UserProfile']['id'] = $userData['UserProfile']['id'];
        $this->request->data['UserProfile']['user-id'] = $userData['UserProfile']['user_id'];
        $this->request->data['UserContact']['id'] = $userData['UserContact']['id'];
        $this->request->data['UserContact']['user_id'] = $userData['UserContact']['user_id'];
        $this->request->data['UserSetting']['id'] = $userData['UserSetting']['id'];
        $this->request->data['UserSetting']['user_id'] = $userData['UserSetting']['user_id'];
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
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->restoreSubmodelIds($id);
            if ($this->User->saveAssociated($this->request->data)) {

                $this->Session->setFlash(__('The user has been updated'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be updated. Please try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        unset($this->request->data['User']['password']);
        $groups = $this->User->Group->find('list');
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
        $this->set('user', $this->User->read(null, $id));
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
