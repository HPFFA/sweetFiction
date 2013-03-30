<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 */
abstract class ReviewsController extends AppController {

	public function beforeFilter(){
        parent::beforeFilter();
        //$this->Auth->allow('*');
    }

	function isAuthorized() {
		// $userAllowedAction = array('edit', 'delete', 'add_story_review', 'edit_chapter', 'delete_chapter');
		// if (in_array($this->request->params['action'], $userAllowedAction)) {
  //           $this->Story->id = $this->request->params['pass']['0'];
  //           if ($this->Auth->user('id') != $this->Story->field('user_id')) {
  //               throw new ForbiddenException();
  //           }
  //       }
        return true;
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->set('review', $this->Review->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($parent_id, $reference_type, $story_id) {
		if ($this->request->is('post')) {
			$this->Review->create();
			$this->completeReviewData($reference_type);
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		// $parentReviews = $this->Review->ParentRevieww->find('list');
		// $users = $this->Review->User->find('list');
		// $stories = $this->Review->Story->find('list');
		// $storyChapters = $this->Review->StoryChapter->find('list');
		// $this->set(compact('parentReviews', 'users', 'stories', 'storyChapters'));
	}

	private function ensureValidAccess($parent_id, $reference_id) {
		

		// $this->Review->id = $review_id;
		// $this->Story->id = $story_id;
		// $invalidChapter = !$this->StoryChapter->exists() ;
		// if (!$invalidChapter)
		// {
		// 	$storyChapter = $this->StoryChapter->read('story_id', $chapter_id);
		// 	$invalidChapter = $storyChapter['StoryChapter']['story_id'] != $story_id;
		// }
		// if ($invalidChapter) {
		// 	throw new NotFoundException(__('Invalid chapter'));
		// }
	}

	private function completeReviewData() {
		$this->request->data['Review']['parent_id'] = $this->request->params['parent_id'];
		$this->request->data['Review']['reference_id'] = $this->request->params['id'];
		$this->request->data['Review']['reference_type'] = $this->request->params['reference_type'];
		if ($this->Auth->user() != null)
		{
			$this->request->data['Review']['user_id'] = $this->Auth->user('id');
		}
	}

	public function add_story_review($parent_id, $reference_type, $story_id) {
		if ($this->request->is('post')) {
			$this->Review->create();
			$this->completeReviewData($reference_type);
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('controller' => 'stories', 'action' => 'view', $story_id));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		// $parentReviews = $this->Review->ParentRevieww->find('list');
		// $users = $this->Review->User->find('list');
		// $stories = $this->Review->Story->find('list');
		// $storyChapters = $this->Review->StoryChapter->find('list');
		// $this->set(compact('parentReviews', 'users', 'stories', 'storyChapters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit_story_review($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Review->read(null, $id);
		}
		$parentReviews = $this->Review->ParentReview->find('list');
		$users = $this->Review->User->find('list');
		$stories = $this->Review->Story->find('list');
		$storyChapters = $this->Review->StoryChapter->find('list');
		$this->set(compact('parentReviews', 'users', 'stories', 'storyChapters'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Review->read(null, $id);
		}
		$parentReviews = $this->Review->ParentReview->find('list');
		$users = $this->Review->User->find('list');
		$stories = $this->Review->Story->find('list');
		$storyChapters = $this->Review->StoryChapter->find('list');
		$this->set(compact('parentReviews', 'users', 'stories', 'storyChapters'));
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
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('Review deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Review was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
