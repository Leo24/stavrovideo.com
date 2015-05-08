<?php                           

        class Videocategories extends AppModel {
                
                public $useTable = 'video_categories';
                public $name = 'Videocategories';
                public $order = 'Videocategories.video_order_in_category';
                var $primaryKey = 'id';



                function get_videos_fit_categories(){
                        $Video = ClassRegistry::init('Video');
                        $videos = $Video->find('all');
                        $listVideoAttributes = $this->find('all');
                        $videoCategories = array();
                        foreach($videos as $key=>$video){
                                $videoID = $video['Video']['video_id'];
                                foreach($listVideoAttributes as $attribute){
                                        if($videoID == $attribute['VideoCategory']['video_id']){
                                                $videoCategories[] = $attribute['VideoCategory']['category_id'];
                                        }
                                }
                                        $videos[$key]['Video']['video_categories'] = $videoCategories;
                        }
                        return $videos;
                }

        }
