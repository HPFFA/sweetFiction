<?php
App::uses('AppModel', 'Model');
/**
 * Story Model
 *
 * @property User $User
 * @property Chapter $Chapter
 */
class Story extends AppModel {

	public $actAs = array('Containable');

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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'StoryChapter' => array(
			'className' => 'StoryChapter',
			'foreignKey' => 'story_id',
			'order' => 'chapter_number',
			'dependent' => true
		),
        'Review' => array(
            'className' => 'Review',
            'foreignKey' => 'id',
            'conditions' => array('Review.reference_type' => 'story'),
        ),
        'Editorial' => array(
            'className' => 'Editorial',
            'foreignKey' => 'story_id'
        )
	);

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'required' => true,
                'message' => 'The title cannot be empty.',
            )
        )
    );



}
