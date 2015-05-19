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
                                        $ContactUsInfo = $this->ContactUsInfo->find('all');
                                        $sendTo = $ContactUsInfo[0]['ContactUsInfo']['email'];

                                        $Email = new CakeEmail('default');
                                        $Email->template('contact-email');
//                                              ->to($this->Configuration->params['email_contact'])
                                        $Email->to($sendTo);
                                        $Email->emailFormat('html');
                                        $Email->subject('New contact message from site');
                                        $Email->viewVars(array('data' => $this->data));
//                                        $Email->from($this->data['email']);
                                        $Email->from($sendTo);
                                        $Email->send();

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

public function sendThankYouMessage(){

        $ContactUsInfo = $this->ContactUsInfo->find('all');
        $sendTo = $ContactUsInfo[0]['ContactUsInfo']['email'];
        $subject = $ContactUsInfo[0]['ContactUsInfo']['message_subject'];
        $message = $ContactUsInfo[0]['ContactUsInfo']['message_body'];

        $Email = new CakeEmail('default');
        $Email->template('thankyou');
        $Email->to($this->data['email']);
        $Email->emailFormat('html');
        $Email->subject($subject);
//        $Email->viewVars($message);
        $Email->from($sendTo);
        $Email->send($message);



}

        }
?>