<?php

namespace application\core;

use application\lib\Db;

abstract class Model {

	public $db;
	
	public function __construct() {
		$this->db = new Db;
	}

	public function getContent($param) {
		if($param == 0){
			return 0;
		}else{
			//$tmpls = $this->db->row('');
			foreach($tmpls as $ID){
				//$data = $this->db->row('');
			}
		}
		
		
	}

	public function getTitle($param){
		//$result = $this->db->column('');
	}
}