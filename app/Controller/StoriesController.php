<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class StoriesController extends AppController {


    public $uses = array('Story', 'StoryChapter');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'view_chapter');
    }

	function isAuthorized() {
		$userAllowedAction = array('edit', 'delete', 'add_chapter', 'edit_chapter', 'delete_chapter');
		if (in_array($this->request->params['action'], $userAllowedAction)) {
            $this->Story->id = $this->request->params['pass']['0'];
            if ($this->Auth->user('id') != $this->Story->field('user_id')) {
                throw new ForbiddenException();
            }
        }
        return true;
    }
	
	private function ensureValidChapterAccess($story_id, $chapter_id) {
		$this->Story->id = $story_id;
		$this->StoryChapter->id = $chapter_id;
		if (!$this->StoryChapter->exists() 
			|| $story_id != $this->StoryChapter->read('story_id', $chapter_id)['StoryChapter']['story_id']) {
			throw new NotFoundException(__('Invalid chapter'));
		}
	}
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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_chapter($id = null, $chapter_id) {
		//$this->Story->id = $id;
		$this->StoryChapter->id = $chapter_id;
		if (!$this->StoryChapter->exists()) {
			throw new NotFoundException(__('Invalid chapter'));
		}
		$this->set('storyChapter', $this->StoryChapter->read(null, $chapter_id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Story->create();
			// since we use hasMany associations, the framework requires, that the nested data is inside an array
			$this->request->data['Story']['user_id'] = $this->Auth->user('id');
			$this->request->data['StoryChapter'][0]['user_id'] = $this->Auth->user('id');
			$this->request->data['StoryChapter'][0]['chapter_number'] = 1;
			
			if ($this->Story->saveAssociated($this->request->data, array('deep' => true))) {
				$this->Session->setFlash(__('The story has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story could not be saved. Please, try again.'));
			}
		}
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
	public function add_chapter($story_id = null) {
		$user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$highest_chapter_number = $this->getHighestChapterOrderFor($story_id);
			$this->StoryChapter->create();
			$this->request->data['Story']['id'] = $story_id;
			$this->request->data['StoryChapter']['story_id'] = $story_id;
			$this->request->data['StoryChapter']['user_id'] = $user_id;
			$this->request->data['StoryChapter']['chapter_number'] = $highest_chapter_number[0]['chapter_number'] + 1;
			if ($this->StoryChapter->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The chapter has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The chapter could not be saved. Please, try again.'));
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
	public function edit($id = null) {
		$this->Story->id = $id;
		if (!$this->Story->exists()) {
			throw new NotFoundException(__('Invalid story'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Story->save($this->request->data)) {
				$this->Session->setFlash(__('The story has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The story could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Story->read(null, $id);
		}
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_chapter($story_id = null, $chapter_id = null) {
		$this->ensureValidChapterAccess($story_id, $chapter_id);
		$this->Story->id = $story_id;
		$this->StoryChapter->id = $chapter_id;
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Story']['id'] = $story_id;
			$this->request->data['StoryChapter']['id'] = $chapter_id;
			if (!array_key_exists('completed', $this->request->data['Story']))
			{
				// Cake swallows the field in case it is unchecked - so we must "restore" the value explicitly
				$this->request->data['Story']['completed'] = 0;
			}
			if ($this->StoryChapter->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The chapter has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The chapter could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->StoryChapter->read(null, $chapter_id);
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

	/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete_chapter($story_id = null, $chapter_id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ensureValidChapterAccess($story_id, $chapter_id);

		$this->Story->id = $story_id;
		$this->StoryChapter->id = $chapter_id;

		if ($this->Story->StoryChapter->find('count') == 1)
		{
			if ($this->Story->delete()) {
				$this->Session->setFlash(__('Story with last chapter deleted'));
				$this->redirect(array('controller' => 'stories', 'action' => 'index'));
			}
		} else if ($this->StoryChapter->delete()) {
			$this->Session->setFlash(__('Chapter deleted'));
			$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
		}
		$this->Session->setFlash(__('Chapter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
