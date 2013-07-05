<?php
App::uses('AppController', 'Controller');
/**
 * Stories Controller
 *
 * @property Story $Story
 */
class EditorialsController extends AppController {

    public $uses = array('Editorial', 'Story');
    public $helpers = array('Form', 'Html', 'Editor');

     public $paginate = array(
        'Editorial' => array(
            'conditions' => array('Editorial.completed' => null), 
        )
    );

    function isAuthorized() {
        $editorialAllowedAction = array('index');
        if (in_array($this->request->params['action'], $editorialAllowedAction)) {
            if (!$this->isGroupMember($this->Auth->user('id'), 'editorial')) {
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
        $this->Editorial->recursive = 0;
        $this->set('editorials', $this->paginate());  
    }


    public function view_story($id){
        $this->Story->id = $id;
        if (!$this->Story->exists()) {
            throw new NotFoundException(__('Invalid story'));
        }
        $this->set('story', $this->Story->read(null, $id));
        $this->set('storyChapters', $this->Story->StoryChapter->find(
            'all', array('conditions' => array('StoryChapter.story_id' => $id))));
        $this->set('editorials', $this->Editorial->find(
            'all', array('conditions' => array('Editorial.story_id' => $id))));
    }

    public function edit_story($id = null) {
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
}
