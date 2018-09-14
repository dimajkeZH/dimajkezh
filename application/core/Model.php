<?php

namespace application\core;

use application\lib\Db;
use application\core\View;

abstract class Model {

	public $db;

	public function __construct() {
		$this->db = new Db;
	}

	//send finally message to user
	public function message($status, $message, $data = []){
		exit(json_encode(['status' => $status, 'message' => $message, 'data' => $data]));
	}

	//full clear data
	public function clear($str) {
		$str = trim($str);
	    $str = strip_tags($str);
	    return $str;
	}

	//clear data and save tags
	public function clearHTML($str) {
	    $str = trim($str);
	    $str = stripslashes($str);
	    $str = htmlspecialchars($str);
	    return $str;
	}
}