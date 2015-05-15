<?php
        App::uses('AppController', 'Controller'); 
        App::uses('CakeEmail', 'Network/Email');
        
        class GbController extends AppController {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('Gb');
                
                function beforeFilter() { 
                        
                        parent::beforeFilter();
                        
                }
                
                function add() {
                        $this->layout = 'main';
                        if($this->request->is('post')) {
                                if(!isset($this->data['q_t']) && $this->Gb->save($this->data)) {
                                        $email = new CakeEmail('default');              
                        
                                        $email->template('comment-email')
                                              ->to($this->Configuration->params['email_comment'])
                                              ->emailFormat('html')
                                              ->subject('New comment on site')
                                              ->viewVars(array('data' => $this->data))
                                              ->send();
                                }
                                exit();
                        }
                }
                
                public function admin_index() {
                        $this->layout = 'admin';
                        $this->set('page_header',  'Guest book');
                        $this->set('main_id',  'tables_page');
                        $this->set('comments',  $this->Gb->find('all', array('order' => array('create_time DESC') ) ));
                }
                
                public function admin_edit($id = null) {
                        
                        if($this->request->is('post') && !empty($id)) {
                                $this->Gb->id = $id;
                                $this->request->data['approved'] = (!empty($this->data['approved']) ? 1 : 0);
                                if($this->Gb->save($this->data)) {
                                        $result = true;
                                } else {
                                        $result = false;
                                }
                                
                                $this->set('result',  $result);
                        }
                        
                        $this->layout = 'admin';
                        $this->set('page_header',  'Guest book edit');
                        $this->set('main_id',  'tables_page');
                        $this->set('comment',  $this->Gb->findById($id));
                        
                }
                
                public function admin_delete($id = null) {
                        $this->layout = 'admin';
                        
                        if(!empty($id)) {
                                $this->Gb->delete($id);
                        }
                        
                        $this->redirect(array('controller' => 'gb', 'action' => 'index', 'prefix' => 'admin'));
                        exit();
                }
                
                public function admin_unapprove($id = null) {
                        $this->layout = 'admin';
                        
                        if(!empty($id)) {
                                $this->Gb->id = (int)$id;
                                $this->Gb->saveField('approved', '0');
                        }
                        
                        $this->redirect(array('controller' => 'gb', 'action' => 'index', 'prefix' => 'admin'));
                        exit();
                }
                
                public function admin_approve($id = null) {
                        $this->layout = 'admin';
                        
                        if(!empty($id)) {
                                $this->Gb->id = (int)$id;
                                $this->Gb->saveField('approved', '1');
                        }
                        
                        $this->redirect(array('controller' => 'gb', 'action' => 'index', 'prefix' => 'admin'));
                        exit();
                }
        }
?>