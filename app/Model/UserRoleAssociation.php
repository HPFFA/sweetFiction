<?php
App::uses('AppModel', 'Model');
/**
 * User-Group-Association Model
 *
 * @property User $Users
 */
class UserRoleAssociation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user_role_association';

    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
}
