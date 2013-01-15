<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'The name cannot be empty.',
            ),
            'alphanumeric' => array(
                'rule' => 'extendedAlphanumericValidation',
                'required' => true,
                'message' => 'Your name must start and end with a number or letter and must have a length of three.',
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'required' => true,
                'message' => 'The name is already in use.',
            ),
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'The email cannot be empty.',
            ),
            'email' => array(
                'rule' => array('email'),
                'required' => true,
                'message' => 'The provided email seems not to be valid, try another.',
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'required' => true,
                'message' => 'The email is already in use.',
            ),
        ),
        'password' => array(
            'notempty_creation' => array(
                'rule' => array('notempty'),
                'message' => 'The password cannot be empty.',
                'on' => 'create'
            ),
            'length' => array(
                'rule' => array('minLength', 4),
                'message' => 'The password should be at least four characters long.',
                'on' => 'create'
            ),
            'confiration' => array(
                'rule' => 'checkPasswordConfirmationMatch',
                'message' => 'The password and confirmation does not match.'
            ), 

        ),
    );

    public function checkPasswordConfirmationMatch($check) {
        return $this->data['User']['password'] == $this->data['User']['confirmation'];
    }

    public function extendedAlphanumericValidation($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $data = array_values($check);
        $value = trim($data[0]);
        return preg_match('/^[0-9a-zA-Z][0-9a-zA-Z_-\s]+[0-9a-zA-Z]$/', $value);
    }

/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'GroupAssociations' => array(
            'className' => 'UserGroupAssociation',
            'foreignKey' => 'user_id',
        ),
        'Story' => array(
            'className' => 'Story',
            'foreignKey' => 'user_id'
        ),
        'StoryChapter' => array(
            'className' => 'StoryChapter',
            'foreignKey' => 'user_id'
        ),
        'StoryReview' => array(
            'className' => 'Review',
            'foreignKey' => 'user_id',
            'conditions' => array('StoryReview.reference_type' => 'story'),
        ),
        'StoryChapterReview' => array(
            'className' => 'Review',
            'foreignKey' => 'user_id',
            'conditions' => array('StoryChapterReview.reference_type' => 'story_chapter'),
        ),
    );

/**
 * hasOne associations
 *
 * @var array
 */
    public $hasOne = array(
        'UserSetting' => array(
            'className' => 'UserSetting',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
        ),
        'UserContact' => array(
            'className' => 'UserContact',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
        ),
        'UserProfile' => array(
            'className' => 'UserProfile',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
        )
    );

    public static function securePassword(& $data)
    {
        $fields = array('password', 'confirmation');
        foreach ($fields as $field)
        {
            if (!empty($data[$field]))
            {
                $data[$field] = AuthComponent::password($data[$field]);
            }
        }
    }

    public function beforeSave($options = array()) {
        // only a alias as reference to $this->data[$this->alias] to unclutter the code
        self::securePassword($this->data[$this->alias]);
        $data = & $this->data[$this->alias];
        $valid = true;
        if (isset($data['password'])) {
            // a password reset was requested - ensure matching confirmation
            $valid = isset($data['confirmation'])
                        && $data['password'] == $data['confirmation'];
        }
        if (!$valid || (empty($data['password']) || empty($data['confirmation'])))
        {
            unset($data['password']);
            unset($data['confirmation']);
        }
        return true;
    }
}
