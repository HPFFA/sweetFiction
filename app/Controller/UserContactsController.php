<?php
App::uses('AppController', 'Controller');
/**
 * UserContacts Controller
 *
 * @property UserContact $UserContact
 */
class UserContactsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserContact->recursive = 0;
		$this->set('userContacts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserContact->id = $id;
		if (!$this->UserContact->exists()) {
			throw new NotFoundException(__('Invalid user contact'));
		}
		$this->set('userContact', $this->UserContact->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserContact->create();
			if ($this->UserContact->save($this->request->data)) {
				$this->Session->setFlash(__('The user contact has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user contact could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserContact->User->find('list');
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
		$this->UserContact->id = $id;
		if (!$this->UserContact->exists()) {
			throw new NotFoundException(__('Invalid user contact'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserContact->save($this->request->data)) {
				$this->Session->setFlash(__('The user contact has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user contact could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserContact->read(null, $id);
		}
		$users = $this->UserContact->User->find('list');
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
		$this->UserContact->id = $id;
		if (!$this->UserContact->exists()) {
			throw new NotFoundException(__('Invalid user contact'));
		}
		if ($this->UserContact->delete()) {
			$this->Session->setFlash(__('User contact deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User contact was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
