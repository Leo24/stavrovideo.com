<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class VideoSearchController extends AppController {
    public $uses = array('Video', 'Category', 'VideoCategories');

    function admin_index()
    {
        $this->layout = "admin";
//        $this->set('page_header', 'Vimeo videos');
//        $this->set('videos', $this->Video->getVimeVideo(1));
//        $this->set('categories',  $this->Category->find('all'));
    }

    public function findVideo(){
        if( $this->request->is('ajax') ) {
            $searchParam = $this->request->data('searchQuery');
        }

        $videos = $this->Video->find('all');
        $searchResults= array();
        foreach($videos as $video){
            foreach($video['Video'] as $value){
                if (strpos(strtolower($value), strtolower($searchParam)) !== false) {
                    $searchResults[] = $video['Video'];
                }
            }
        }
        $this->autoRender = false;
        $this->set('searchResults', $searchResults);
        $this->render('findVideo', 'ajax');
    }


    public function admin_getSingleVideo(){
        if (isset($this->request->params['pass'][0])){
            $video_id = $this->request->params['pass'][1];
            $video = $this->Video->find('all', array('conditions' => array('video_id' => $video_id)));
            $searchResults = $video[0];
            $this->VideoCategories->find('all');
            $video[0]['Video']['categories'] = $this->VideoCategories->find('all', array('conditions' => array('video_id' => $video_id)));
            $this->set('searchResults', $searchResults);
            $this->set('categories', $this->Category->find('all'));
            $this->render('admin_index');
        }
       return false;
    }



    public function admin_preSearchList(){
        $this->layout = "admin";
        if( $this->request->is('ajax') ) {
            $searchParam = $this->request->data('searchQuery');
        }

        $videos = $this->Video->find('all');
        $searchResults= array();
        foreach($videos as $video){
            foreach($video['Video'] as $value){
                if (strpos(strtolower($value), strtolower($searchParam)) !== false) {
                    $searchResults[] = $video['Video'];
                }
            }
        }
        $this->autoRender = false;
        echo json_encode(array($searchResults));
        die();
    }


    function admin_videosList(){
        $this->layout = "admin";
        if( $this->request->is('post') ) {
            $searchParam = $this->data['searchQuery'];
        }

        $videos = $this->Video->find('all');
        $categories = $this->Category->find('all');
        $this->VideoCategories->find('all');
        $searchResults= array();
        foreach($videos as $video){

                if (strpos(strtolower($video['Video']['video_name']), strtolower($searchParam)) !== false) {
                    $videoCategories = $this->VideoCategories->find('all', array('conditions' => array('video_id' => $video['Video']['video_id'])));
                    if(count($videoCategories) != 0 ){
                        foreach($videoCategories as $category){
                            if($category['VideoCategories']['category_id'] != 0){
                                $video['Video']['categories'][] = $this->Category->find('all', array('conditions' => array('categoryId' => $category['VideoCategories']['category_id'])));
                                $video['Video']['categories'][0][0]['Category']['id'] = $category['VideoCategories']['id'];
                            }
                        }
                    }
                    $searchResults[] = $video['Video'];
                    unset($videoCategories);
                }
        }
        $this->set('searchResults', $searchResults);
        $this->set('categories', $categories);
        $this->render('admin_index');
    }

}