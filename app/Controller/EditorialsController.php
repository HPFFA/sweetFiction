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
}
