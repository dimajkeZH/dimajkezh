<?php

namespace application\core;

use application\lib\Db;

abstract class Model {

	public $db;

	public function __construct() {
		$this->db = new Db;
	}

	public function getContent($route) {
		if($route['controller'] AND $route['action'] AND $route['param']){
			$tmpls = $this->db->row('');
			$content = '';
			foreach($tmpls as $ID){
				//$data = $this->db->row('');
			}
			debug($content);
			return $content;	
		}else{
			View::errorCode(404, 4);
		}
	}
	public function caseLayout($name){

	}

	public function loadBlockHeaderOrder(){
		//db
		//extract
		//require layout
	}

	public function loadBlockHeaderImages(){

	}

	public function loadBlockTable(){

	}

	public function loadBlockMultiTable(){

	}

	public function loadBlockText(){

	}

	public function loadBlockImages(){

	}

	public function getTitle($route){
		//$result = $this->db->column('');
		return $route['param'];
	}
}

/*
$content = "";
foreach([1,2,3] as $path){
	$vars = DB($path);
	extract($vars);
	$path .= '.php';
	ob_start();
	require $path;
	$content .= ob_get_clean();
}
echo $content;

function DB($number){
	switch($number){
		case 1:
			$str = 'first';
			break;
		case 2:
			$str = 'second';
			break;
		case 3:
			$str = 'third';
			break;
	}
	return [$str => $number.$number.$number];
}
*/