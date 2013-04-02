<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('FormHelper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class EditorHelper extends AppHelper {

    public $helpers = array('Form', 'Html' , 'Js');

    private static $INITIALIZED = false;

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    private function addEditor($field, $options){
        $output = "";
        if (!self::$INITIALIZED) {
            self::$INITIALIZED = true;
            $output .= $this->Html->script('ckeditor/ckeditor');
            return $output;
        }
        return "";
    }

    public function input($fieldName, $options = array()) {
        $output = $this->addEditor($fieldName, $options);
        $output .= $field = $this->Form->input($fieldName, $options);
        $output .= $this->Html->scriptBlock(
            "$(document).on('ready', function() { window['CKEDITOR'].replace('".$this->getId($field)."', { customConfig: '".$this->webroot."js/editor.configuration.js' }); });");
        return $output;
    }

    private function getId($html){
        $matches = array();
        preg_match('/<textarea ([^>])*>/', $html, $matches);
        $textarea = $matches[0];
        $matches = array();
        preg_match('/id="([^"])*"/', $textarea, $matches);
        $id = substr($matches[0], 4, strlen($matches[0]) - 5);
        return $id;
    }
}
