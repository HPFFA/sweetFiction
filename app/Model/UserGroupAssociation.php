<?php
App::uses('AppModel', 'Model');
/**
 * User-Group-Association Model
 *
 * @property User $Users
 */
class UserGroupAssociation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user_group_association';

    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
}
