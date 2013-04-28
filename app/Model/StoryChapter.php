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
    );

    public $hasMany = array(
        'Review' => array(
            'className' => 'Review',
            'foreignKey' => 'id',
            'conditions' => array('Review.reference_type' => 'story_chapter'),
        ),
	);

    public $hasOne = array(
        'Editorial' => array(
            'className' => 'Editorial',
            'foreignKey' => 'story_chapter_id'
        )
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
