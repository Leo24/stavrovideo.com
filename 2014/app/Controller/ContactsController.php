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
                                        $email = new CakeEmail('default');              
                        $email = $this->ContactUsInfo->find('all')[0]['ContactUsInfo']['email'];
                                        $email->template('contact-email')
//                                              ->to($this->Configuration->params['email_contact'])
                                              ->to($email)
                                              ->emailFormat('html')
                                              ->subject('New contact message from site')
                                              ->viewVars(array('data' => $this->data))
                                              ->send();
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