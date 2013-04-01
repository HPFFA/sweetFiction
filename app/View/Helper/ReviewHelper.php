<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class ReviewHelper extends Helper {

    public $helpers = array('Auth');

    private $reviewValidationErrors = array();
    private $review = array();
    
    /**
 * Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
        if (array_key_exists('Review', $this->_View->validationErrors)) {
            $this->reviewValidationErrors = $this->_View->validationErrors['Review'];
        }
        if (array_key_exists('Review', $this->_View->request->data)) {
            $this->review = $this->_View->request->data['Review'];
        }
        $this->unsetErrorsForForm();
    }

    private function hasErrors() {
        return !empty($this->review);
    }

    private function hasNewReviewErrors($parent) {
        return (($parent == null && $this->review['parent_id'] == 0) 
                || ($parent['Review']['id'] == $this->review['parent_id'] && !array_key_exists('id', $this->review)));
    }

    private function hasExistingReviewErrors($review) {
        return $review != null 
            && array_key_exists('id', $this->review) 
            && $this->review['id'] == $review['Review']['id'];
    }

    public function shouldRenderForm($is_author, $review, $parent) {
        return !$is_author
                && (!isset($review) || ($review['Review']['user_id'] != $this->Auth->user('id')))
                && ($parent == null || ($parent['Review']['user_id'] != $this->Auth->user('id')));
    }

    public function childReviews($reviews, $parent) {
        $child_reviews = array();
        foreach ($reviews as $potentialChildReview)
        {
            if ($potentialChildReview['Review']['parent_id'] == $parent['Review']['id'])
            {
                $child_reviews[] = $potentialChildReview;
            }
        }
        return $child_reviews;
    }

    public function showFormFor($review) {
        $show = false;
        if ($this->hasErrors()) {
            $show = $this->hasExistingReviewErrors($review);
        } else {
            $show = $review == null;
        }
        return $show;
    }

    public function showForm($parent) {
        $show = false;
        if ($this->hasErrors()) {
            $show = $this->hasNewReviewErrors($parent);
        }
        return $show;
    }

    public function showFormAfter($parent) {
        $show = false;
        if ($this->hasErrors()) {
            $show = $this->hasNewReviewErrors($parent);
        } 
        return $show;
    }



    public function addUrl($reference_id, $parent) {
        return array(
                'controller' => $this->request->params['controller'],
                'action' => 'reviews',
                $reference_id, 
                'add',
                $parent == null ? 0 : $parent['Review']['id'],
            );
    }

    public function editUrl($review) {
        return array('controller' => $this->request->params['controller'],
                'action' => 'reviews',
                $review['Review']['reference_id'],
                'edit',
                $review['Review']['id']);
    }

    private function setErrorsForRendering(){
        $this->_View->request->data['Review'] = $this->review;
        $this->_View->validationErrors['Review'] = $this->reviewValidationErrors;
    }

    private function unsetErrorsForRendering(){
        $this->_View->validationErrors['Review'] = array();
        $this->_View->request->data['Review'] = array();    
    }

    public function setErrorsForForm($review) {
        //debug($this->hasNewReviewErrors($review));
        //debug($this->hasExistingReviewErrors($review));
        if ($this->hasErrors() && ($this->hasNewReviewErrors($review) || $this->hasExistingReviewErrors($review)))
        {
            $this->setErrorsForRendering();
        } else {
            $this->unsetErrorsForRendering();
        }
    }

    public function unsetErrorsForForm() {
        $this->unsetErrorsForRendering();
    }
}
