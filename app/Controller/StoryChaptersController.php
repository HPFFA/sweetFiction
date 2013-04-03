<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class StoryChaptersController extends AppController {

	public $components = array('Review');
    public $uses = array('StoryChapter', 'Story');
    public $helpers = array('Form', 'Html', 'Review', 'Editor');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'add_review');
    }

	function isAuthorized() {
		$userAllowedAction = array('edit', 'delete', 'add');
		if (in_array($this->request->params['action'], $userAllowedAction)) {
            $this->Story->id = $this->request->params['pass']['0'];
            if ($this->Auth->user('id') != $this->Story->field('user_id')) {
                throw new ForbiddenException();
            }
        }
        return true;
    }
	
	private function ensureValidChapterAccess($story_id, $chapter_id) {
		$this->StoryChapter->id = $chapter_id;
		$invalidChapter = !$this->StoryChapter->exists() ;
		if (!$invalidChapter)
		{
			$storyChapter = $this->StoryChapter->read('story_id', $chapter_id);
			$invalidChapter = $storyChapter['StoryChapter']['story_id'] != $story_id;
		}
		if ($invalidChapter) {
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
	public function view($story_id, $chapter_id) {
		$this->StoryChapter->Story->id = $story_id;
		$this->StoryChapter->id = $chapter_id;
		if (!$this->StoryChapter->exists() && !$this->StoryChapter->Story->exists()) {
			throw new NotFoundException(__('Invalid chapter'));
		}
		$this->set('story', $this->StoryChapter->Story->read(null, $story_id));
		$this->set('storyChapter', $this->StoryChapter->read(null, $chapter_id));
		$this->set('storyChapterNeighbours', $this->StoryChapter->find('neighbors', array(
			'conditions' => array('story_id' => $story_id),
		    'order' => 'chapter_number DESC',
		    'fields' => array('chapter_number', 'id', 'title')
	    )));
	    $this->set('reviews', $this->Review->findFor($this->StoryChapter, $chapter_id));
	}

	private function setVariablesForView($id) {
		$this->Story->id = $id;
		$this->set('story', $this->Story->read(null, $id));
		$this->set('storyChapters', $this->Story->StoryChapter->find(
		 	'all', array('conditions' => array('story_id' => $id))));
		$this->set('reviews', $this->Review->findFor($this->Story, $id));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_chapter($story_id = null, $chapter_id = null) {
		
	}

/**
 * add method
 *
 * @return void
 */
	public function edit_review($id, $review_id) {
		$this->Story->StoryChapter;
		if ($this->Review->edit($this->Story->Review, $this->request, $review_id)) {
           $this->redirect(array('controller' => 'stories', 'action' => 'view', $id));
		} else {
			$this->setVariablesForView($id);
			$this->render('view');
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
	public function add($story_id) {
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
		$this->StoryChapter->Story->read(null, $story_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($story_id, $chapter_id) {
		$this->ensureValidChapterAccess($story_id, $chapter_id);
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
	public function delete($story_id, $chapter_id) {
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
			$this->redirect(array('controller' => 'stories', 'action' => 'edit', $story_id));
		}
		$this->Session->setFlash(__('Chapter was not deleted'));
		$this->redirect(array('action' => 'edit', $story_id, $chapter_id));
	}
}
