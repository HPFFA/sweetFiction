<?php
App::uses('AppController', 'Controller');
/**
 * UserSettings Controller
 *
 * @property UserSetting $UserSetting
 */
class UserSettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserSetting->recursive = 0;
		$this->set('userSettings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserSetting->id = $id;
		if (!$this->UserSetting->exists()) {
			throw new NotFoundException(__('Invalid user setting'));
		}
		$this->set('userSetting', $this->UserSetting->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserSetting->create();
			if ($this->UserSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The user setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user setting could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserSetting->User->find('list');
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
		$this->UserSetting->id = $id;
		if (!$this->UserSetting->exists()) {
			throw new NotFoundException(__('Invalid user setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserSetting->save($this->request->data)) {
				$this->Session->setFlash(__('The user setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user setting could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserSetting->read(null, $id);
		}
		$users = $this->UserSetting->User->find('list');
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
		$this->UserSetting->id = $id;
		if (!$this->UserSetting->exists()) {
			throw new NotFoundException(__('Invalid user setting'));
		}
		if ($this->UserSetting->delete()) {
			$this->Session->setFlash(__('User setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User setting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
