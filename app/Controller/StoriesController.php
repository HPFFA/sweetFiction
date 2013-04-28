<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class StoriesController extends AppController {

    public $components = array('Review');
    public $uses = array('Story');
    public $helpers = array('Form', 'Html', 'Review', 'Editor');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'add_review');
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
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Story->recursive = 0;
        if ($this->request->is('requested')) 
            return $this->paginate();
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
        $this->setVariablesForView($id);
    }

    private function setVariablesForView($id) {
        $this->Story->id = $id;
        $this->set('story', $this->Story->read(null, $id));
        $this->set('storyChapters', $this->Story->StoryChapter->find(
            'all', array('conditions' => array('story_id' => $id))));
        $this->set('reviews', $this->Review->findFor($this->Story, $id));
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

    public function add_review($id, $parent_id = null) {
        if ($this->Review->create($this->Story->Review, $this->request, 'story')) {
           $this->redirect(array('controller' => 'stories', 'action' => 'view', $id));
        } else  {
            $this->setVariablesForView($id);
            $this->render('view');
        }
    }


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
        return $this->Story->StoryChapter->find('first', array(
                    'conditions' => array('story_id' => $story_id), 
                    'fields' => array('MAX(chapter_number) AS chapter_number')));
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
