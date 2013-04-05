<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
App::uses('Utility', 'CakeTime');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $findMethods = array('exists' =>  true);

    protected function _findExists($state, $query, $results = array()) {
        if ($state == 'before') {
            $query['limit'] = 1;
            return $query;
        }
        if ($state == 'after') {
            return sizeof($results) > 0;
        }
    }

    private function isNew(){
        return !(array_key_exists('id', $this->data) && $this->exists($this->data['id']));
    }

    public function beforeSave($options = array()) {
        $current_time = date('Y-m-d H:m:s', time());
        if ($this->isNew())
        {
            $this->data[$this->name]['created'] = $current_time;
        }
        $this->data[$this->name]['updated'] = $current_time;
        return parent::beforeSave($options);
    }
}
