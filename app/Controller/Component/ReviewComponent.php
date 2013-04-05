<?php

App::uses('Component', 'Controller');

class ReviewComponent extends Component {

    public $components = array('Session', 'Auth');

    public function initialize(Controller $controller) {
        parent::initialize($controller);
    }

    public function findFor($parent_model, $id) {
        return $parent_model->Review->find('all', 
                array('conditions' => array_merge(
                    array('Review.reference_id' => $id), 
                    $parent_model->hasMany['Review']['conditions'])));
    }
    
    private function completeReviewData(&$request, $reference_type) {
        $request->data['Review']['parent_id'] = $request->params['parent_id'];
        $request->data['Review']['reference_id'] = $request->params['reference_id'];
        $request->data['Review']['reference_type'] = $reference_type;
        if ($this->Auth->user() != null)
        {
            $request->data['Review']['user_id'] = $this->Auth->user('id');
        }
    }

    public function create(Review $model, $request, $reference_type) {
        $saved = false;
        debug($request->data);
        if ($request->is('post')) {
            $model->create();
            $this->completeReviewData($request, $reference_type);
            if ($model->save($request->data)) {
                $message = __('The review has been saved');
                $saved = true;
            } else {
                $message = __('The review could not be saved. Please, try again.');
            }
        }
        $this->Session->setFlash($message);
        return $saved;
    }

    private function isAuthorized(Review $model) {
        if ($this->Auth->user('id') != $model->field('user_id')) {
            throw new ForbiddenException();
        }
        return true;
    }

    public function edit(Review $model, $request, $id) {
        $model->id = $id;
        $saved = false;
        if (!$model->exists() || !$this->isAuthorized($model)) {
            throw new NotFoundException(__('Invalid review'));
        }
        if ($request->is('post') || $this->request->is('put')) {
            if ($model->save($request->data)) {
                $this->Session->setFlash(__('The review has been saved'));
                $saved = true;
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'));
                $request->data = $model->read(null, $id);
            }
        } else {
            $this->request->data = $model->read(null, $id);
        }
        return $saved;
    }

    public function delete() {

    }
}

?>