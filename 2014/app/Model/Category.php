<?php                           

        class Category extends AppModel {
                
                public $useTable = 'category';
                public $name = 'Category';
                public $order = 'Category.category_order';
                var $primaryKey = 'categoryId';
                
        }
?>