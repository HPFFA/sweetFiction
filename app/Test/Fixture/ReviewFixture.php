<?php
/**
 * ReviewFixture
 *
 */
class ReviewFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'review';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'reference_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'reference_type' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'user_name' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'text' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'updated' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'deleted' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'parent_id' => array('column' => 'parent_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'user_name' => array('column' => 'user_name', 'unique' => 0),
			'reference_id' => array('column' => 'reference_id', 'unique' => 0),
			'reference_type' => array('column' => 'reference_type', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'parent_id' => 1,
			'reference_id' => 1,
			'reference_type' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'user_name' => 'Lorem ipsum dolor sit amet',
			'text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => 1357990986,
			'updated' => 1357990986,
			'deleted' => 1357990986
		),
	);

}
