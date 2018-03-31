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
			$q = 'SELECT PT.ID AS ID, LT.ID AS TMPL_NUMBER, LT.PATH FROM PAGE_TEMPLATES AS PT INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON P.ID_LOCATION = LL.ID) ON P.ID = PT.ID_PAGE INNER JOIN LIB_TEMPLATES AS LT ON LT.ID = PT.ID_TEMPLATE WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
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
				$vars = $this->caseVars($tmpls[$i]['TMPL_NUMBER'], $tmpls[$i]['ID']);
				extract($vars);
				if(isset($CONTENT[0])){
					$CONTENT = $CONTENT[0];
				}
				ob_start();
				require 'application/views/layouts/templates/'.$tmpls[$i]['PATH'].'.php';
				$content .= ob_get_clean();
			};
			return $content;	
		}else{
			View::errorCode(404);
		}
	}
	public function caseVars($TMPL, $ID){
		$return['CONTENT'] = [];
		$return['DATA'] = [];
		switch($TMPL){
			case 1:
				$return['CONTENT'] = $this->db->row('SELECT * FROM BLOCK_HEADER_ORDER WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				return $return;
				break;
			case 2:
				$return['CONTENT'] = $this->db->row('SELECT * FROM BLOCK_HEADER_IMAGES WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				return $return;
				break;
			case 3:
				$return['CONTENT'] = $this->db->row('SELECT * FROM BLOCK_TABLE WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				$return['DATA'] = $this->db->row('SELECT * FROM DATA_TABLE WHERE ID_TABLE = :ID', ['ID' => $return['CONTENT'][0]['ID']]);
				return $return;
				break;
			case 4:
				return [];
				$this->loadBlockMultiTable();
				return $this->db->row('SELECT * FROM BLOCK_HEADER_ORDER WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				break;
			case 5:
				return $this->db->row('SELECT * FROM BLOCK_TEXT WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				break;
			case 6:
				return [];
				$this->loadBlockImages();
				return $this->db->row('SELECT * FROM BLOCK_HEADER_ORDER WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				break;
			case 7:
				//return $this->db->row('SELECT * FROM BLOCK_LINKS WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				return [];
				break;
		}
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