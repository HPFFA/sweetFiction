<?php
App::uses('AppModel', 'Model');
/**
 * StoryChapter Model
 *
 * @property User $User
 * @property Story $Story
 */
class StoryChapter extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'story_chapter';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Story' => array(
			'className' => 'Story',
			'foreignKey' => 'story_id',
		)
	);
}
