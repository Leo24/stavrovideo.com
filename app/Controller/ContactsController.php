<?php
        App::uses('AppController', 'Controller'); 
        App::uses('CakeEmail', 'Network/Email');
        
        class ContactsController extends AppController {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('Contact', 'ContactUsInfo');
                
                function beforeFilter() { 
                        
                        parent::beforeFilter();
                        
                }
                
                function add() {
                        $this->layout = 'main';
                        if($this->request->is('post')) {
                                if(!isset($this->data['q_t']) && $this->Contact->save($this->data)) {
                                        $emailAddress = $this->ContactUsInfo->find('all')[0]['ContactUsInfo']['email'];
                                        $Email = new CakeEmail('default');
                                        $Email->template('contact-email');
//                                              ->to($this->Configuration->params['email_contact'])
                                        $Email->to($emailAddress);
                                        $Email->cc($emailAddress);
                                        $Email->bcc($emailAddress);
                                        $Email->emailFormat('html');
                                        $Email->subject('New contact message from site');
                                        $Email->viewVars(array('data' => $this->data));
                                        $Email->from($this->data['email']);
                                        $Email->send();
                                        $foo = false;
                                }
                                exit();
                        }


                }
                
                public function admin_index() {
                        $this->layout = 'admin';
                        $this->set('page_header',  'Contacts');
                        $this->set('main_id',  'tables_page');
                        $this->set('contacts',  $this->Contact->find('all'));
                }
                
                public function admin_delete($id = null) {
                        $this->layout = 'admin';
                        
                        if(!empty($id)) {
                                $this->Contact->delete($id);
                        }
                        
                        $this->redirect(array('controller' => 'contacts', 'action' => 'index', 'prefix' => 'admin'));
                        exit();
                }

        }
?>