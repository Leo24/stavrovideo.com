<? echo json_encode(
        array(
                'paging' => $this->element('paging', array('page' => (empty($page) ? 1 : $page), 'total_pages' => ceil($videos->videos->total/9) )),
                'html' =>  $this->element('video', array('videos' => $videos))
        )
); ?>