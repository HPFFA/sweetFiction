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
            'alphanumeric' => array(
                'rule' => array('extendedAlphanumericValidation'),
                //'message' => 'Your custom message here',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                //'message' => 'Your custom message here',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                'on' => 'create'
            ),
        ),
    );

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'GroupAssociations' => array(
            'className' => 'UserGroupAssociation',
            'foreignKey' => 'user_id',
        )
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
            'dependent' => false,
            'conditions' => '',
        ),
        'UserContact' => array(
            'className' => 'UserContact',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
        ),
        'UserProfile' => array(
            'className' => 'UserProfile',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
        )
    );

    public function extendedAlphanumericValidation($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        //$value = trim(array_values($check)[0]);
        //return preg_match('|^[0-9a-zA-Z_-\s]*$|', $value);
        return true;
    }

    public static function securePassword(& $data)
    {
        $fields = array('password', 'confirmation');
        foreach ($fields as $field)
        {
            if (isset($data[$field]))
            {
                $data[$field] = AuthComponent::password($data[$field]);
            }
        }
    }

    public function beforeSave($options = array()) {
        // only a alias as reference to $this->data[$this->alias] to unclutter the code
        self::securePassword($this->data[$this->alias]);
        $data = & $this->data[$this->alias];
        if (isset($data['password'])) {
            // a password reset was requested - ensure matching confirmation
            return
                isset($data['confirmation'])
                && $data['password'] == $data['confirmation'];
        }
        return true;
    }
}
