<?php
App::uses('AppModel', 'Model');
/**
 * Editorial Model
 *
 * @property User $Users
 */
class Editorial extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'editorial';

/**
 * Display field
 *
 * @var string
 */
    //public $displayField = 'name';

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        ),
        'Story' => array(
            'className' => 'Story',
            'foreignKey' => 'story_id',
        ),
        'StoryChapter' => array(
            'className' => 'StoryChapter',
            'foreignKey' => 'story_chapter_id',
        ),
        'Editor' => array(
            'className' => 'User',
            'foreignKey' => 'editor_id',
        )
    );

}
