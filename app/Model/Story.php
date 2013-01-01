<?php
App::uses('AppModel', 'Model');
/**
 * Story Model
 *
 * @property User $User
 * @property Chapter $Chapter
 */
class Story extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'story';

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
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'StoryChapter' => array(
			'className' => 'StoryChapter',
			'joinTable' => 'story_chapter',
			'foreignKey' => 'story_id',
			'associationForeignKey' => 'chapter_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
