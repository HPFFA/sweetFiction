<?php
/**
 * Html Helper class file.
 *
 * Simplifies the construction of HTML elements.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Helper
 * @since         CakePHP(tm) v 0.9.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppHelper', 'View/Helper');
App::uses('CakeResponse', 'Network');

/**
 * Html Helper class for easy use of HTML widgets.
 *
 * HtmlHelper encloses all methods needed while working with HTML pages.
 *
 * @package       Cake.View.Helper
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/html.html
 */
class AuthHelper extends AppHelper {

/**
 * Reference to the Response object
 *
 * @var CakeResponse
 */
    public $response;

/**
 * Constructor
 *
 * ### Settings
 *
 * - `configFile` A file containing an array of tags you wish to redefine.
 *
 * ### Customizing tag sets
 *
 * Using the `configFile` option you can redefine the tag HtmlHelper will use.
 * The file named should be compatible with HtmlHelper::loadConfig().
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
        if (is_object($this->_View->response)) {
            $this->response = $this->_View->response;
        } else {
            $this->response = new CakeResponse(array('charset' => Configure::read('App.encoding')));
        }
        if (!empty($settings['configFile'])) {
            $this->loadConfig($settings['configFile']);
        }
    }

    public function user($property = null){
        return AuthComponent::user($property);
    }

    public function currentUser($property = null){
        return AuthComponent::user($property);
    }
}
