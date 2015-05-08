<?php

        class Video extends AppModel {

                public $useTable = 'vimeo'; // This model does not use a database table
                public $name = 'Video';
                public $order = 'Video.order_video';
                //public $primaryKey = 'video_id';

                var $datasource;
                
                public function __construct($id = false, $table = null, $ds = null) {
                        parent::__construct($id, $table, $ds);
                        $this->datasource = $this->getDataSource();
                }
                /*
                public $belongsTo = array(
                        'User' => array(
                            'className' => 'User',
                            'foreignKey' => 'UID'
                        )
                );
                */
                /*
                public $virtualFields = array(
                        'commentsCount' => 'SELECT COUNT(Comment.COMID) FROM comments AS Comment WHERE Comment.VID = Video.VID AND Comment.is_video = 1',
                        'likesCount' => 'SELECT COUNT(VideosLike.id) FROM videos_likes AS VideosLike WHERE VideosLike.video_id = Video.VID',
                        'thumbPath' => 'SELECT ConfigMedia.param_value FROM config_media AS ConfigMedia WHERE ConfigMedia.param_name = Video.config_dir_tmb_key ',
                        'thumbUrl' => 'SELECT ConfigMedia.param_value FROM config_media AS ConfigMedia WHERE ConfigMedia.param_name = Video.config_url_tmb_key ',
                        'flvUrl' => 'SELECT ConfigMedia.param_value FROM config_media AS ConfigMedia WHERE ConfigMedia.param_name = Video.config_url_key_flv ',
                        'flvPath' => 'SELECT ConfigMedia.param_value FROM config_media AS ConfigMedia WHERE ConfigMedia.param_name = Video.config_dir_key_flv '
                );
                */
                
                 function getUserVideosCount($UID) {
                        $settings['conditions'] = array_merge(array('Video.UID' => $UID), $this->_mainConditions);
                        
                        return $this->find('count', $settings);
                 }
                
                function addViewNumber($videoId) {
                        $sql = 'UPDATE video SET viewnumber = viewnumber + 1 WHERE VID = '.$this->datasource->value($videoId);
                        $this->query($sql);
                }
                
                function getVimeVideo($page = 1) {
                        App::import('Vendor', 'phpVimeo');
                        $videos = array();
                        $vimeo = new phpVimeo('ca3cb901abfe407a1d0029da5559015a2aad1347', '5f4656e7545f3a3065f4a27086a66ba85db24251');
                        try {
                            $videos = $vimeo->call('vimeo.videos.getUploaded', array('user_id' => 'stavrovideo', 'sort' => 'newest', 'page'=>$page, 'per_page'=>9));
                        }catch (VimeoAPIException $e) {
                                    //echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
                        }
                        $i=0;
                        foreach($videos->videos->video as $video) {
                                $video_thumb = $vimeo->call('vimeo.videos.getThumbnailUrls', array('video_id' => $video->id));
                                $videos->videos->video[$i]->thumbnail_medium = $video_thumb->thumbnails->thumbnail[1]->_content;
                                $videos->videos->video[$i]->category = null;
                                $videos->videos->video[$i]->order = null;
                                
                                $this_video = $this->findByVideoId($video->id);


                                $VideoCategories = ClassRegistry::init('Videocategories');
                                $listVideoAttributes = $VideoCategories->find('all');
                                        $videoCategories = array(

                                        );
                                                $videoID = $video->id;
                                                foreach($listVideoAttributes as $attribute){
                                                        if($videoID == $attribute['Videocategories']['video_id']){
                                                                $videoCategories[] = $attribute;
                                                        }
                                                }
                                $videos->videos->video[$i]->categories = $videoCategories;



//                                if(!empty($this_video)) {
//                                        $videos->videos->video[$i]->category = $this_video['Video']['category_id'];
//                                        $videos->videos->video[$i]->order = $this_video['Video']['order_video'];
//                                }

                                $i++;
                        }
                        return $videos;
                }
                
                function add($video_id, $category, $id = null) {
                        App::import('Vendor', 'phpVimeo');
                        $videos = array();
                        $vimeo = new phpVimeo('ca3cb901abfe407a1d0029da5559015a2aad1347', '5f4656e7545f3a3065f4a27086a66ba85db24251');
                        try {
                            $video_info = $vimeo->call('vimeo.videos.getInfo', array('video_id' => $video_id));
                        }catch (VimeoAPIException $e) {
                                    //echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
                        }
                        if(!empty($video_info) && $video_info->stat == 'ok') {
                                
                                if(!empty($id)) {
                                        $this->id = $id;
                                }
                                
                                $this->save(array(
                                        'video_url' => $video_info->video[0]->urls->url[0]->_content,
                                        'video_img' => $video_info->video[0]->thumbnails->thumbnail[1]->_content,
                                        'video_name' => $video_info->video[0]->title,
                                        'video_desc' => $video_info->video[0]->description,
                                        'category_id' => $category,
                                        'video_id' => $video_id,
                                ));
                        }                        
                }

                function refreshVideoList($page = 1) {
                        App::import('Vendor', 'phpVimeo');
                        $vimeo = new phpVimeo('ca3cb901abfe407a1d0029da5559015a2aad1347', '5f4656e7545f3a3065f4a27086a66ba85db24251');
                        $videosFromVimeo = $vimeo->call('vimeo.videos.getUploaded', array('user_id' => 'stavrovideo', 'sort' => 'newest', 'page'=>$page, 'per_page'=>10000000));
                        $videosFromDB = $this->find('all');
                        $videosFromVimeo = $videosFromVimeo->videos->video;
                        foreach($videosFromVimeo as $key => $videoFromVimeo){
                                foreach($videosFromDB as $videoFromDB){
                                        if($videoFromVimeo->id == $videoFromDB['Video']['video_id']){
                                              unset($videosFromVimeo[$key]);
                                        }
                                }
                        }

                        if(count($videosFromVimeo) != 0){
                                foreach($videosFromVimeo as $videoFromVimeo){
                                        $video_info = $vimeo->call('vimeo.videos.getInfo', array('video_id' => $videoFromVimeo->id));
                                        $recentlyAddedVideos[] = array(
                                            'video_url' => $video_info->video[0]->urls->url[0]->_content,
                                            'video_img' => $video_info->video[0]->thumbnails->thumbnail[1]->_content,
                                            'video_name' => $video_info->video[0]->title,
                                            'video_desc' => $video_info->video[0]->description,
                                            'category_id' => 0,
                                            'video_id' => $videoFromVimeo->id,
                                            'order_video' => 0,
                                            'main_site_video' => 0,
                                        );
                                }
                        }

                        if(isset($recentlyAddedVideos)){
                                return $recentlyAddedVideos;
                        }else{
                                return false;
                        }


                }
        }
?>