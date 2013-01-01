<?php
App::uses('AppController', 'Controller');
/**
 * StoryChapters Controller
 *
 * @property StoryChapter $StoryChapter
 */
class StoryChaptersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->StoryChapter->recursive = 0;
		$this->set('storyChapters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->StoryChapter->id = $id;
		if (!$this->StoryChapter->exists()) {
			throw new NotFoundException(__('Invalid story chapter'));
		}
		$this->set('storyChapter', $this->StoryChapter->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->StoryChapter->create();
			if ($this->StoryChapter->save($this->request->data)) {
				$this->Session->setFlash(__('The story chapter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story chapter could not be saved. Please, try again.'));
			}
		}
		$users = $this->StoryChapter->User->find('list');
		$stories = $this->StoryChapter->Story->find('list');
		$this->set(compact('users', 'stories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->StoryChapter->id = $id;
		if (!$this->StoryChapter->exists()) {
			throw new NotFoundException(__('Invalid story chapter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->StoryChapter->save($this->request->data)) {
				$this->Session->setFlash(__('The story chapter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story chapter could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->StoryChapter->read(null, $id);
		}
		$users = $this->StoryChapter->User->find('list');
		$stories = $this->StoryChapter->Story->find('list');
		$this->set(compact('users', 'stories'));
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
		$this->StoryChapter->id = $id;
		if (!$this->StoryChapter->exists()) {
			throw new NotFoundException(__('Invalid story chapter'));
		}
		if ($this->StoryChapter->delete()) {
			$this->Session->setFlash(__('Story chapter deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Story chapter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
