<?php

class User extends AppModel {

        function check_user_data($data) {
		// init
		$return = FALSE;

		// find user with passed email
		$conditions = array(
			'User.username'=>$data['User']['username']
		);
		$user = $this->find('first',array('conditions'=>$conditions));
		// not found
		if(!empty($user)) {
			//$salt = Configure::read('Security.salt');
			// check password
			if($user['User']['password'] == md5($data['User']['password'])) {
				$return = $user;
			}
                        //$return = $user;
		}

	       return $return;
	}


		function get_user_data(){
			$user = $this->find('all');
			return $user;
		}


}

