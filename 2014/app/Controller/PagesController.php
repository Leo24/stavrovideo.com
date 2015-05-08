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

App::uses('AppController', 'Controller', 'VideoCategories');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Video', 'Category', 'Gb', 'VideoCategories');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
	       
	        $pagefeed = $this->Facebook->api("/StavroVideoProductions/feed");
                
                $this->set('pagefeed', $pagefeed);
		        $this->set('categories', $this->Category->find('all'));
                $this->set('videos', $this->Video->find('all'));
//                $this->set('video_about', $this->Video->find('first', array('conditions' => array('category_id' => -2) )));

                $this->set('video_main', $this->Video->find('all', array('conditions' => array('main_site_video' => 1))));
                $this->set('comments', $this->Gb->find('all', array('conditions' => array('approved' => 1) )));

    }


    public function list_category_videos(){

        if(isset($this->request->data['category_id'])) {
            $categoryID = $this->request->data['category_id'];
        }
        $videoID_list = $this->VideoCategories->find('all', array('conditions' => array('category_id' => $categoryID )));
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
        echo json_encode(array('videos' => $videosSortedByOrderInCategory));
        die();

    }


}
