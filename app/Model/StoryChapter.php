<?php
App::uses('AppModel', 'Model');
/**
 * StoryChapter Model
 *
 * @property User $User
 * @property Story $Story
 */
class StoryChapter extends AppModel {

	public $actAs = array('Containable');
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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Story' => array(
			'className' => 'Story',
			'foreignKey' => 'story_id',
		),
        'Review' => array(
            'className' => 'Review',
            'foreignKey' => 'user_id',
            'conditions' => array('Review.reference_type' => 'story_chapter'),
        ),
	);


/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'The text cannot be empty.',
            ),
        ),

    );
}
