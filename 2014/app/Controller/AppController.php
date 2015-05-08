<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
        var $layout = 'main';
        public $uses = array('Configuration');

        function beforeFilter() {
                
                if(isset($this->params['admin']) && $this->params['admin']) {
                        $this->layout = 'admin';
                        
			// check user is logged in
			if( !$this->Session->check('Admin') || !$this->Session->read('Admin.User.username') ) {
				$this->Session->setFlash('You must be logged in for that action.','flash_bad');
				$this->redirect('/admin/login');
			}

			// save user data
			$this->_User = $this->Session->read('Admin');
			$this->set('user',$this->_User);

			// change layout and theme
                        
			//$this->layout = 'admin';
                        //$this->theme = 'Assets';
		} else {      
                        App::import('Vendor', 'facebook-php-sdk-master/facebook');
                        $this->Facebook = new Facebook(array(
                                'appId'     =>  '732365850172547',
                                'secret'    =>  '6a3962dca81fa5c21b35e812ec042ec0',
                                'fileUpload' => false
                        ));
		}
        }
}
