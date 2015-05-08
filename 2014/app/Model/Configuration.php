<?php
        
        class Configuration extends AppModel {
                
                public $useTable = 'config';
                
                public $params = array();
                
                public function __construct($id = false, $table = null, $ds = null) {
                        parent::__construct($id, $table, $ds);
                        
                        $params = $this->find('all');
                        
                        foreach($params as $param) {
                                $this->params[$param['Configuration']['key']] = $param['Configuration']['values'] ;
                        }
                        
                }
        }
?>