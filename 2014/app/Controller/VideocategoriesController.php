<?php
App::uses('AppController', 'Controller');

class VideocategoriesController extends AppController {
//    public $components = array('RequestHandler', 'Paginator');
    public $uses = array('Video', 'Category', 'VideoCategories');


    function beforeFilter() {

        parent::beforeFilter();

    }

    function admin_change_video_order_in_category() {
        $reOrderedVideos = $this->request->data['reOrderedVideos'];

        foreach($reOrderedVideos as $video){
            $this->VideoCategories->read(null, $video['line_id']);
            $this->VideoCategories->set('video_order_in_category', $video['video_order_in_category']);
            $this->VideoCategories->save();
        }
        echo json_encode(array('result' => $reOrderedVideos));
        die();
    }

    function admin_remove_video_category() {


    }
    function admin_list_categories() {
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
            $this->set('categories',  $categories);
        }
}
