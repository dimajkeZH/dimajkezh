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
			$q = 'SELECT LT.ID, LT.PATH FROM PAGE_TEMPLATES AS PT INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON P.ID_LOCATION = LL.ID) ON P.ID = PT.ID_PAGE INNER JOIN LIB_TEMPLATES AS LT ON LT.ID = PT.ID_TEMPLATE WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
			$params = [
				'COL_NUMBER' => $route['param'],
				'CONTROLLER' => $route['controller'],
				'ACTION' => $route['action']
			];
			$tmpls = $this->db->row($q, $params);
			if(!$tmpls){
				View::errorCode(404);
			}
			$content = '';
			for($i = 0; $i < count($tmpls); $i++){
				$vars = $this->caseVars($tmpls[$i]['ID']);
				extract($vars);
				ob_start();
				require 'application/views/layouts/templates/'.$tmpls[$i]['PATH'].'.php';
				$content .= ob_get_clean();
			};
			return $content;	
		}else{
			View::errorCode(404);
		}
	}
	public function caseVars($ID){
		
		return [];

		switch($ID){
			case 1:
				$this->loadBlockHeaderOrder();
				break;
			case 2:
				$this->loadBlockHeaderImages();
				break;
			case 3:
				$this->loadBlockTable();
				break;
			case 4:
				$this->loadBlockMultiTable();
				break;
			case 5:
				$this->loadBlockText();
				break;
			case 6:
				$this->loadBlockImages();
				break;
			case 7:
				$this->loadBlockLinks();
				break;
		}
	}

	public function loadBlockHeaderOrder(){
		//db
		//extract
		//require layout
		//return ob_get_clean();
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

	public function loadBlockLinks(){

	}

	public function getTitle($route){
		$q = 'SELECT TITLE FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = P.ID_LOCATION WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
		$params = [
			'COL_NUMBER' => $route['param'],
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		$title = $this->db->column($q, $params);
		return $title;
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