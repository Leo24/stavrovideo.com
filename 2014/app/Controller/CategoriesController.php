<?php
        App::uses('AppController', 'Controller'); 
        App::uses('CakeEmail', 'Network/Email');
        
        class CategoriesController extends AppController {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('Category');
                
                function beforeFilter() { 
                        
                        parent::beforeFilter();
                        
                }
                
                public function admin_index() {
                        $this->layout = 'admin';
                        $this->set('page_header',  'Categories');
                        $this->set('main_id',  'tables_page');
                        $this->set('categories',  $this->Category->find('all', array('order' => array('category_order') ) ));
                }
                
                public function admin_edit($id = null) {
                        
                        if($this->request->is('post') && !empty($id)) {
                                $this->Category->id = $id;
                                if($this->Category->save($this->data)) {
                                        $result = true;
                                } else {
                                        $result = false;
                                }
                                
                                $this->set('result',  $result);
                        }
                        
                        $this->layout = 'admin';
                        $this->set('page_header',  'Category edit');
                        $this->set('main_id',  'tables_page');
                        $this->set('category',  $this->Category->findByCategoryid($id));
                        
                }
                
                public function admin_add() {
                        
                        if($this->request->is('post')) {
                                if($this->Category->save($this->data)) {
                                        $result = true;
                                        $this->redirect(array('controller' => 'categories', 'action' => 'index', 'prefix' => 'admin'));
                                        exit();
                                } else {
                                        $result = false;
                                }
                                
                                $this->set('result',  $result);
                        }
                        
                        $this->layout = 'admin';
                        $this->set('page_header',  'New Category');
                        $this->set('main_id',  'tables_page');
                        
                }
                
                public function admin_delete($id = null) {
                        $this->layout = 'admin';
                        
                        if(!empty($id)) {
                                $this->Category->delete($id);
                        }
                        
                        $this->redirect(array('controller' => 'categories', 'action' => 'index', 'prefix' => 'admin'));
                        exit();
                }
        }
?>