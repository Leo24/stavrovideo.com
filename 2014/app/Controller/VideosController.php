<?php

        App::uses('AppController', 'Controller');

        class VideosController extends AppController
        {
                public $components = array('RequestHandler', 'Paginator');
                public $uses = array('Video', 'Category', 'VideoCategories');

                function beforeFilter()
                {

                        parent::beforeFilter();

                }

                function admin_index()
                {
                        $this->layout = "admin";
                        $this->set('page_header', 'Vimeo videos');
                        $this->set('videos', $this->Video->getVimeVideo(1));
                        $this->set('categories',  $this->Category->find('all'));
                }

                function admin_get_video_ajax($page)
                {
                        $this->layout = "";
                        $this->set('videos', $this->Video->getVimeVideo($page));
                        $this->set('categories', $this->Category->find('all'));
                        $this->set('page', $page);

                }

                function admin_change_video_category($video_id){
                        $this->layout = "";
                        if ($this->request->data['line_id'] == '0') {
                                $this->VideoCategories->delete($this->request->data['line_id']);
                        }
                                $data = array(
                                    'category_id' => $this->request->data['category_id'],
                                    'video_id' => $video_id
                                );
                                $this->VideoCategories->save($data);
                                $data['line_id'] = $this->VideoCategories->id;
                                echo json_encode(array('result' => $data));
                                die();
                }

                function admin_change_video_order($video_id)
                {
                        $this->layout = "";
                        $this_video = $this->Video->findByVideoId($video_id);
                        if (!empty($this_video)) {
                                $sql = 'UPDATE vimeo SET order_video = ' . (int)$this->request->data['order'] . ' WHERE video_id = ' . (int)$video_id;
                                $this->Video->query($sql);
                        } else {
                                echo json_encode(array('result' => 0, 'error' => 'First need choose category'));
                                exit();
                        }

                        echo json_encode(array('result' => $this->Video->getAffectedRows()));
                        exit();
                }



                function admin_get_list_categories($video_id)
                {
                        $data = array();
                        $data['video_id'] = $video_id;
                        $data['categories'] = $this->Category->find('all');
                        echo json_encode($data);
                        die();
                }

                function admin_add_video_category($video_id)
                {

                }

                function admin_remove_video_category($video_id)
                {
                        $this->layout = "";
                        if ($this->request->data['line_id'] !== '' && !empty($video_id)) {
                                $this->VideoCategories->delete($this->request->data['line_id']);
                                $data = "Item removed succesfully.";
                                echo json_encode(array('result' => $data));
                                die();

                        }
                }







                function admin_update_video_list(){
//                        $this->layout = "";
                        $recentlyAddedVideos = $this->Video->refreshVideoList();
                        if(false != $recentlyAddedVideos){
                                $data = array();
                                foreach ($recentlyAddedVideos as $video){
                                        $data[] =array(
                                            'video_url' => $video['video_url'],
                                            'video_img' => $video['video_img'],
                                            'video_name' => $video['video_name'],
                                            'video_desc' => $video['video_desc'],
                                            'category_id' => 0,
                                            'video_id' => $video['video_id'],
                                            'order_video' => 0,
                                            'main_site_video' => 0,
                                        );
                                }
                        $this->Video->saveMany($data);
                                echo json_encode(array('updated' => 'Videos Succesfully Refreshed'));

//                        return $this->redirect(
//                            array('controller' => 'videos', 'action' => 'index')
//                        );
                        die();
                        }else{
                                echo json_encode(array('upToDate' => 'All Videos are up to Date'));
                                die();
                        }



                }

//                function admin_refresh_caregories(){
//                        $this->layout = "";
//                        $videos = $this->Video->find('all');
//                        foreach($videos as $video){
//                                $data[] = array(
//                                    'category_id' => $video['Video']['category_id'],
//                                    'video_id' => $video['Video']['video_id']
//                                );
//                        }
//                        $this->VideoCategories->saveAssociated($data);
//                        return $this->redirect(
//                            array('controller' => 'videos', 'action' => 'index')
//                        );
//                }

        }