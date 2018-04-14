<?php

namespace application\models;

use application\core\Model;

class Templates extends Model {

	protected $tmpls = [];

	public function getContent($route) {
			$content = [];
			for($i = 0; $i < count($this->tmpls); $i++){
				$vars = $this->caseVars($this->tmpls[$i]['TMPL_NUMBER'], $this->tmpls[$i]['ID']);
				array_push($content, $vars);
				/*
				extract($vars);
				if(isset($CONTENT[0])){
					$CONTENT = $CONTENT[0];
				}
				ob_start();
				require 'application/views/layouts/templates/'.$this->tmpls[$i]['PATH'].'.php';
				$content .= ob_get_clean();
				*/
			}
			return $content;
	}

	private function caseVars($TMPL, $ID){
		//$return['CONTENT'] = [];
		//$return['DATA'] = [];
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
				$return['CONTENT'] = $this->db->row('SELECT ID, TITLE, DESCR, SUBTITLE FROM BLOCK_MULTITABLE WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				$return['DATA_NAV'] = $this->db->row('SELECT ID, SUBTITLE FROM BLOCK_MULTITABLE_CONTENT WHERE ID_MULTITABLE = :ID ORDER BY SERIAL_NUMBER ASC', ['ID' => $return['CONTENT'][0]['ID']]);
				$return['DATA_TABLE'] = $this->db->row('SELECT DM.ID_MULTITABLE_CONTENT, DM.ROW, DM.COL, DM.VAL FROM DATA_MULTITABLE as DM INNER JOIN BLOCK_MULTITABLE_CONTENT as BMC ON BMC.ID = DM.ID_MULTITABLE_CONTENT WHERE BMC.ID_MULTITABLE = :ID', ['ID' => $return['CONTENT'][0]['ID']]);
				return $return;
				break;
			case 5:
				$return['CONTENT'] = $this->db->row('SELECT * FROM BLOCK_TEXT WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				return $return;
				break;
			case 6:
				$return['CONTENT'] = $this->db->row('SELECT ID, TITLE, DESCR FROM BLOCK_IMAGES WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				$return['DATA'] = $this->db->row('SELECT IMAGE_LINK, SUBTITLE, IMAGE_SIGN FROM BLOCK_IMAGE_CONTENT WHERE ID_IMAGE = :ID ORDER BY SERIAL_NUMBER ASC', ['ID' => $return['CONTENT'][0]['ID']]);
				return $return;
				break;
			case 7:
				return [];
				//$return['CONTENT'] = $this->db->row('SELECT * FROM BLOCK_LINKS WHERE ID_PAGE_TEMPLATE = :ID', ['ID' => $ID]);
				return $return;
				break;
		}
	}

	public function getViews($route){
		$return = [];
		foreach($this->tmpls as $tmpl){
			array_push($return, 'layouts/templates/'.$tmpl['PATH']);
		}
		return $return;
	}

	public function setTmpls($route){
		if($route['controller'] AND $route['action'] AND $route['param']){
			$q = 'SELECT PT.ID AS ID, LT.ID AS TMPL_NUMBER, LT.PATH FROM PAGE_TEMPLATES AS PT INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON P.ID_LOCATION = LL.ID) ON P.ID = PT.ID_PAGE INNER JOIN LIB_TEMPLATES AS LT ON LT.ID = PT.ID_TEMPLATE WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
			$params = [
				'COL_NUMBER' => $route['param'],
				'CONTROLLER' => $route['controller'],
				'ACTION' => $route['action']
			];
			$tmpls = $this->db->row($q, $params);
			if(!$tmpls){
				\application\core\View::errorCode(404);
			}
			$this->tmpls = $tmpls;
		}else{
			\application\core\View::errorCode(404);
		}
	}

	public function getTitle($route){
		$q = 'SELECT TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = P.ID_LOCATION WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
		$params = [
			'COL_NUMBER' => $route['param'],
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		$title = $this->db->row($q, $params);
		return $title[0];
	}
}