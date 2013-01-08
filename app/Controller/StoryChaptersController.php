<?php
App::uses('AppController', 'Controller');
/**
 * StoryChapters Controller
 *
 * @property StoryChapter $StoryChapter
 */
class StoryChaptersController extends AppController {

    public $uses = array('Story', 'StoryChapter');

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

	private function getHighestChapterOrderFor($story_id)
	{
		return $this->StoryChapter->find('first', array(
    				'conditions' => array('story_id' => $story_id), 
    				'fields' => array('MAX(chapter_number) AS chapter_number')));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($story_id = null) {
		$user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$highest_chapter_number = $this->getHighestChapterOrderFor($story_id);
			$this->StoryChapter->create();
			$this->request->data['Story']['id'] = $story_id;
			$this->request->data['StoryChapter']['story_id'] = $story_id;
			$this->request->data['StoryChapter']['user_id'] = $user_id;
			$this->request->data['StoryChapter']['chapter_number'] = $highest_chapter_number[0]['chapter_number'] + 1;
			if ($this->StoryChapter->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The story chapter has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The story chapter could not be saved. Please, try again.'));
			}
		}
		$this->Story->read(null, $story_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($story_id = null, $chapter_id = null) {
		$this->Story->id = $story_id;
		$this->StoryChapter->id = $chapter_id;
		if (!$this->StoryChapter->exists() 
			|| $story_id != $this->StoryChapter->read('story_id', $chapter_id)['StoryChapter']['story_id']) {
			throw new NotFoundException(__('Invalid story chapter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Story']['id'] = $story_id;
			$this->request->data['StoryChapter']['id'] = $chapter_id;
			if (!array_key_exists('completed', $this->request->data['Story']))
			{
				// Cake swallows the field in case it is unchecked - so we must "restore" the value explicitly
				$this->request->data['Story']['completed'] = 0;
			}
			if ($this->StoryChapter->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The story chapter has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The story chapter could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->StoryChapter->read(null, $chapter_id);
			//$this->StoryChapter->read(null, $chapter_id);
			//$this->Story->read(null, $story_id);
		}
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
