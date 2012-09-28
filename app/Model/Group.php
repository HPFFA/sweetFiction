<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $Users
 */
class Group extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'group';

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
                'rule' => array('alphanumeric'),
                //'message' => 'Your custom message here',
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'UserAssociations' => array(
            'className' => 'UserGroupAssociation',
            'foreignKey' => 'group_id',
        )
    );

}
