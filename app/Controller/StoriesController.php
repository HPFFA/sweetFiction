<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class StoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Story->recursive = 0;
		$this->set('stories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Story->id = $id;
		if (!$this->Story->exists()) {
			throw new NotFoundException(__('Invalid story'));
		}
		$this->set('story', $this->Story->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Story->create();
			if ($this->Story->save($this->request->data)) {
				$this->Session->setFlash(__('The story has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story could not be saved. Please, try again.'));
			}
		}
		$users = $this->Story->User->find('list');
		$chapters = $this->Story->StoryChapter->find('list');
		$this->set(compact('users', 'chapters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Story->id = $id;
		if (!$this->Story->exists()) {
			throw new NotFoundException(__('Invalid story'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Story->save($this->request->data)) {
				$this->Session->setFlash(__('The story has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Story->read(null, $id);
		}
		$users = $this->Story->User->find('list');
		$chapters = $this->Story->Chapter->find('list');
		$this->set(compact('users', 'chapters'));
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
		$this->Story->id = $id;
		if (!$this->Story->exists()) {
			throw new NotFoundException(__('Invalid story'));
		}
		if ($this->Story->delete()) {
			$this->Session->setFlash(__('Story deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Story was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
