<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property Review $ParentReview
 * @property User $User
 * @property Review $ChildReview
 */
class Review extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'review';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentReview' => array(
			'className' => 'Review',
			'foreignKey' => 'parent_id',
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Story' => array(
			'className' => 'Story',
			'foreignKey' => 'reference_id',
			'conditions' => array('Review.reference_type' => 'story')),
		'StoryChapter' => array(
			'className' => 'Story',
			'foreignKey' => 'reference_id',
			'conditions' => array('Review.reference_type' => 'story_chapter')
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildReview' => array(
			'className' => 'Review',
			'foreignKey' => 'parent_id',
		)
	);

}
