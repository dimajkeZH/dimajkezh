<?php

namespace application\models;

use application\core\Model;

class Ajax extends Model {


	public function message($status, $message){
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function clean($str) {
	    $str = trim($str);
	    $str = stripslashes($str);
	    $str = strip_tags($str);
	    $str = htmlspecialchars($str);
	    return $str;
	}

}