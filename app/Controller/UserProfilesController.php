<?php
App::uses('AppController', 'Controller');
/**
 * UserProfiles Controller
 *
 * @property UserProfile $UserProfile
 */
class UserProfilesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserProfile->recursive = 0;
		$this->set('userProfiles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserProfile->id = $id;
		if (!$this->UserProfile->exists()) {
			throw new NotFoundException(__('Invalid user profile'));
		}
		$this->set('userProfile', $this->UserProfile->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserProfile->create();
			if ($this->UserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The user profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserProfile->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UserProfile->id = $id;
		if (!$this->UserProfile->exists()) {
			throw new NotFoundException(__('Invalid user profile'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserProfile->save($this->request->data)) {
				$this->Session->setFlash(__('The user profile has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user profile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserProfile->read(null, $id);
		}
		$users = $this->UserProfile->User->find('list');
		$this->set(compact('users'));
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
		$this->UserProfile->id = $id;
		if (!$this->UserProfile->exists()) {
			throw new NotFoundException(__('Invalid user profile'));
		}
		if ($this->UserProfile->delete()) {
			$this->Session->setFlash(__('User profile deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User profile was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
