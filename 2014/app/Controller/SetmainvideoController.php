<?php

        App::uses('AppController', 'Controller');

        class SetMainVideoController extends AppController
        {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('Video', 'Category', 'VideoCategories');

                function beforeFilter()
                {

                        parent::beforeFilter();

                }

                /*Functionality for editing main site video*/

                function admin_set_main_video_list_categories(){
                        $this->layout = "admin";
                        if($mainVideo = $this->Video->find('all', array('conditions' => array('main_site_video' => 1)))){
                                $this->set('mainVideo', $mainVideo[0]);
                        }

                        $this->set('videos', $this->Video->find('all'));
                        $this->set('categories', $this->Category->find('all'));
                }

                function admin_category_videos_list(){
                        $this->layout = "admin";
                        $categories = $this->Category->find('all');
                        $categoryID = '';
                        if(isset($this->request->params['pass'][0])) {
                                $categoryID = $this->request->params['pass'][0];
                                $videoID_list = $this->VideoCategories->find('all', array('conditions' => array('category_id' => $categoryID )));
                        }else{
                                $firstCategoryId = $categories[0]['Category']['categoryId'];
                                $videoID_list = $this->VideoCategories->find('all', array('conditions' => array('category_id' => $firstCategoryId)));
                        }
                        $videosList = array();
                        foreach($videoID_list as $video){
                                $videosList[] = $video['VideoCategories']['video_id'];
                        }
                        $videos = $this->Video->find('all', array('conditions' => array('Video.video_id' => $videosList)));

                        $videoOrderInCategory = $this->VideoCategories->find('all', array('conditions' => array('video_id' => $videosList), 'order' => array('video_order_in_category')));

                        foreach ($videos as $key => $video){
                                foreach($videoOrderInCategory as $value){
                                        if($value['VideoCategories']['video_id'] == $video['Video']['video_id']){
                                                $videos[$key]['Video']['video_order_in_category'] = $value['VideoCategories']['video_order_in_category'];
                                                $videos[$key]['Video']['line_id'] = $value['VideoCategories']['id'];
                                        }
                                }

                        }
                        $videosSortedByOrderInCategory = Hash::sort($videos, '{n}.Video.video_order_in_category', 'asc', 'natural');
                        if(isset($this->request->params['pass'][0])){
                                foreach($categories as $key => $category){
                                        if($category['Category']['categoryId'] == $categoryID ){
                                                $categories[$key]['Category']['Videos'] = $videosSortedByOrderInCategory ;
                                        }
                                }
                        }else{
                                $categories[0]['Category']['Videos'] =  $videosSortedByOrderInCategory ;
                        }
                        if($mainVideo = $this->Video->find('all', array('conditions' => array('main_site_video' => 1)))){
                                $this->set('mainVideo', $mainVideo[0]);
                        }
                        $this->set('categories',  $categories);
                        $this->render('admin_set_main_video_list_categories');
                }

                function admin_set_main_video(){
                        $video_id = $this->request->data['video_id'];
                        $this->clear_main_video();
                        $startVideo = $this->Video->find('all', array('conditions' => array('video_id' => $video_id)));
                        $startVideoLineID = $startVideo[0]['Video']['id'];
                        $this->Video->read(null, $startVideoLineID);
                        $this->Video->set('main_site_video', 1);
                        $this->Video->save();
                        $startVideo = $this->Video->find('all', array('conditions' => array('main_site_video' => 1)));
                        echo json_encode(array('result' => $startVideo[0]));
                        die();
                }

                protected function clear_main_video(){
                        if($video = $this->Video->find('all', array('conditions' => array('main_site_video' => 1)))){
                                $video_id = $video[0]['Video']['id'];
                                $this->Video->read(null, $video_id);
                                $this->Video->set('main_site_video', 0);
                                $this->Video->save();
                        }

                }

                function admin_remove_main_video(){
                        if($video = $this->Video->find('all', array('conditions' => array('main_site_video' => 1)))){
                                $video_id = $video[0]['Video']['id'];
                                $this->Video->read(null, $video_id);
                                $this->Video->set('main_site_video', 0);
                                $this->Video->save();
                                echo json_encode(array('result' => 'Main Video Successfully Removed'));
                                die();
                        }
                }




        }