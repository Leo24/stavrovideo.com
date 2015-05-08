<?php                           

        class Gb extends AppModel {
                
                public $useTable = 'gb'; // This model does not use a database table
                public $name = 'Gb';
                public $order = 'Gb.create_time DESC';
                
                var $datasource;
                
                public function __construct($id = false, $table = null, $ds = null) {
                        parent::__construct($id, $table, $ds);
                        $this->datasource = $this->getDataSource();
                }
        }
?>