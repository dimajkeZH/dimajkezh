<?php

namespace application\models;

use application\models\User;

class TemplatesUser extends User {

	protected $tmpls = [];
	public $pg_type;

	public function getContent($route) {
		$content = [];
		if($this->pg_type == '1'){
			$content = $this->getVars($this->tmpls[0]['TMPL_NUMBER'], $this->tmpls[0]['ID']);
		}elseif($this->pg_type == '2'){
			for($i = 0; $i < count($this->tmpls); $i++){
				$vars = $this->caseVars($this->tmpls[$i]['TMPL_NUMBER'], $this->tmpls[$i]['ID']);
				array_push($content, $vars);
			}
		}
		return $content;
	}

	private function getVars($TMPL, $ID){
		$return['CONTENT'] = [];
		$result = $this->db->row('SELECT * FROM PAGE_FULL_CONTENT WHERE ID_FULL_PAGE = :ID', ['ID' => $ID]);
		foreach($result as $key => $val){
			$arrFields = [
				'INFO_TITLE', 'INFO_DESCR',
				'PRICE_SUBTITLE', 'PRICE_IMAGE', 'PRICE_COST', 'PRICE_TEXT', 
				'END_TEXT',
			];
			foreach($arrFields as $fieldkey => $fieldval){
				if(preg_match('#^'.$fieldval.'[0-9]{0,}$#', $val['VAR'])){
					$val['VAR'] = $fieldval;
				}
			}
			if(!isset($return['CONTENT'][$val['VAR']])){
				$return['CONTENT'][$val['VAR']] = [];
			}
			array_push($return['CONTENT'][$val['VAR']], $val['VAL']);
		}
		unset($result);
		foreach($return['CONTENT'] as $key => $val){
			if(count($return['CONTENT'][$key]) == 1){
				$return['CONTENT'][$key] = $return['CONTENT'][$key][0];
			}
		}
		return $return;
	}

	private function caseVars($TMPL, $ID){
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
				$q = 'SELECT ID, TITLE, IMAGE FROM DATA_BUSES_COUNTRIES ORDER BY SERIAL_NUMBER';
				$return['CONTENT'] = $this->db->row($q);
				foreach($return['CONTENT'] as $key => $val){
					$q = 'SELECT * FROM DATA_BUSES WHERE ID_COUNTRY = '.$val['ID'].' ORDER BY SERIAL_NUMBER';
					$return['CONTENT'][$key]['LIST'] = $this->db->row($q);
				}
				return $return;
				break;
		}
	}

	public function getViews($route){
		if($this->pg_type == 1){
			return $route['action'].'/'.$this->tmpls[0]['PATH'];
		}elseif($this->pg_type == 2){
			$return = [];
			foreach($this->tmpls as $tmpl){
				array_push($return, 'layouts/templates/'.$tmpl['PATH']);
			}
			return $return;
		}
	}

	public function setConf($route){
		if($route['controller'] && $route['action'] && $route['param']){
			$params = [
				'COL_NUMBER' => $route['param'],
				'CONTROLLER' => $route['controller'],
				'ACTION' => $route['action']
			];

			$q = 'SELECT ID_TYPE FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON P.ID_LOCATION = LL.ID WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
			$type = $this->db->row($q, $params);
			if($type){
				$this->pg_type = $type[0]['ID_TYPE'];

				$table = '';
				if($this->pg_type == '1'){
					$table = 'PAGE_FULL';
				}elseif($this->pg_type == '2'){
					$table = 'PAGE_TEMPLATES';
				}
				$q = 'SELECT PT.ID AS ID, LT.ID AS TMPL_NUMBER, LT.PATH FROM '.$table.' AS PT INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON P.ID_LOCATION = LL.ID) ON P.ID = PT.ID_PAGE INNER JOIN LIB_TEMPLATES AS LT ON LT.ID = PT.ID_TEMPLATE WHERE (P.LOC_NUMBER = :COL_NUMBER) AND (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION);';
				$tmpls = $this->db->row($q, $params);
				if($tmpls){
					$this->tmpls = $tmpls;
					return true;
				}
			}
		}
		return false;
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