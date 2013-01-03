<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class StoriesController extends AppController {


    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

	function isAuthorized() {
        // $userAllowedAction = array('add', 'edit', 'delete');
        // if (in_array($this->request->params['action'], $userAllowedAction)) {
        //     if ($this->Auth->user('id') != $this->User->id)
        //     {
        //         throw new ForbiddenException();
        //     }
        // }
        return true;
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
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Story->create();
			// since we use hasMany associations, the framework requires, that the nested data is inside an array
			$this->request->data['Story']['user_id'] = $this->Auth->user('id');
			$this->request->data['StoryChapter']['user_id'] = $this->Auth->user('id');
			$this->request->data['StoryChapter']['chapter_number'] = 1;
			$this->request->data['StoryChapter'] = array($this->request->data['StoryChapter']);
			if ($this->Story->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The story has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The story could not be saved. Please, try again.'));
			}
		}
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
