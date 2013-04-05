<?php
App::uses('AppModel', 'Model');

App::uses('User', 'Model');
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
			'className' => 'StoryChapter',
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

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'user_name' => array(
            'conditional_on_login' => array(
                'rule' => 'guestNameValidation',
                'message' => 'As guest you need to specify a username.',
            ),
            'not_in_database' => array(
                'rule' => 'preventUserNameMisuseValidation',
                'message' => 'The name is already in use and cannot be used as guest.',
            ),
        ),
        'text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'The text cannot be empty.',
            )
        )
    );

    public function guestNameValidation($check) {
    	if ($this->data['Review']['user_id'] == 0)
    	{
    		$data = array_values($check);
        	$value = trim($data[0]);
        	$result = preg_match('/^[0-9a-zA-Z][0-9a-zA-Z_-\s]+[0-9a-zA-Z]$/', $value);	
        	return $result;
    	}
    	return true;
    }

    public function preventUserNameMisuseValidation($check) {
    	if ($this->data['Review']['user_id'] == 0)
    	{
    		$data = array_values($check);
        	$value = trim($data[0]);
    		return !$this->User->find('exists', array('limit' => 1, 'conditions' => array('User.name' => $value)));
    	}
    	return true;
    }
}
