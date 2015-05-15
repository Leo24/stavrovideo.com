<?php
        App::uses('AppController', 'Controller');

        class UsersController extends AppController {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('User');

                function beforeFilter() {
                        if(isset($this->params['admin'])) {
                                $this->layout = 'stafflayout';
                                $this->User->loginRedirect = array(
                                    'controller' => 'users',
                                    'action' => 'admin_index',
//                                    'prefix' => 'admin',
                                    'admin' => true
                                );
                        }
//                        parent::beforeFilter();

                }

                function admin_login() {


                        $this->layout = 'login';

        		//$salt = Configure::read('Security.salt');
        		//echo md5('password'.$salt);

        		// redirect user if already logged in


        		if( $this->Session->check('Admin') ) {
                        $this->redirect(array('controller'=>'videos','action'=>'index','admin'=>true));
        		}

        		if(!empty($this->data)) {
        			// set the form data to enable validation
        			$this->User->set( $this->data );
        			// see if the data validates

        			if($this->User->validates()) {
        				// check user is valid
        				$result = $this->User->check_user_data($this->data);

        				if( $result !== FALSE ) {
        					// update login time
                                                /*
        					$this->User->id = $result['User']['id'];
        					$this->User->saveField('last_login',date("Y-m-d H:i:s"));
                                                */
        					// save to session
        					$this->Session->write('Admin',$result);
        					$this->Session->setFlash('You have successfully logged in','flash_good');
        					$this->redirect(array('controller'=>'videos','action'=>'index','admin'=>true));
        				} else {
        					$this->Session->setFlash('Either your Email of Password is incorrect','flash_bad');
        				}
        			}
        		}
                        $this->set('msg', '');
                        $this->set('title_for_layout', '- Login');
                        //print_r($this->layout); exit();
        	}


                function admin_logout() {
                        if($this->Session->check('User')) {
                                $this->Session->delete('User');
                                $this->Session->setFlash('You have successfully logged out','flash_good');
                        }elseif( $this->Session->check('Admin') ) {
                                $this->Session->delete('Admin');
                        }
                        $this->redirect(array('controller'=>'admin', 'action'=>'login', 'admin'=>true));
                }

                public function admin_change_password() {
                        if($this->request->is('post')) {
                                if(isset($this->data['User']['password']) && isset($this->data['User']['new_password']) && isset($this->data['User']['password_confirm'])
                                        && $this->data['User']['password'] != '' && $this->data['User']['new_password'] != '' && $this->data['User']['password_confirm'] != ''
                                        && $this->data['User']['new_password'] == $this->data['User']['password_confirm']
                                        && $this->User->check_user_data($this->data)
                                ) {
                                        $CurrentUser = $this->User->check_user_data($this->data);
                                        $this->User->delete($CurrentUser['User']['id']);
                                        $this->User->set('username', $this->data['User']['new_username']);
                                        $this->User->set('password', md5($this->data['User']['new_password']));
                                        $this->User->save();
                                        $result = true;
                                } else {
                                        $result = false;
                                }

                                $this->set('result',  $result);
                        }

                        $this->layout = 'admin';
                        $this->set('page_header',  'Change Username and Password');
                        $this->set('main_id',  'forms_page');
                        $user = $this->User->get_user_data();
                        $this->set('user',  $user[0]);
                }
        }
