<?php
App::uses('Review', 'Model');

/**
 * Review Test Case
 *
 */
class ReviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.review',
		'app.user',
		'app.user_setting',
		'app.user_contact',
		'app.user_profile',
		'app.user_group_association',
		'app.group',
		'app.story',
		'app.story_chapter'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Review = ClassRegistry::init('Review');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Review);

		parent::tearDown();
	}

}
