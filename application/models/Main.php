<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public function getTitle($route){
		$q = 'SELECT TITLE, HTML_DESCR, HTML_KEYWORDS FROM INDEX_PAGES AS IP INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = IP.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		$title = $this->db->row($q, $params);
		return $title[0];
	}

	public function getContent($route){
		$q = 'SELECT P.TITLE, P.DESCR, CONCAT(SUBSTR(LL.NAME, 1, INSTR(LL.NAME, "[0-9]{1,}")-1), P.LOC_NUMBER) as LINK, P.IMAGE  FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = "templates") AND (LL.ACTION = :ACTION)';
		$params = [
			'ACTION' => $route['action']
		];
		$result['PAGELIST'] = $this->db->row($q, $params);
		$q = 'SELECT IPC.VAR, IPC.VAL FROM INDEX_PAGE_CONTENT as IPC INNER JOIN (INDEX_PAGES as IP INNER JOIN LIB_LOCATIONS as LL ON LL.ID = IP.ID_LOCATION) ON IP.ID = IPC.ID_INDEX_PAGE WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = ['CONTROLLER' => $route['controller'], 'ACTION' => $route['action']];
		$result['CONTENT'] = $this->db->row($q, $params);
		foreach($result['CONTENT'] as $key => $val){
			if(!isset($result[$val['VAR']])){
				$result[$val['VAR']] = [];
			}
			array_push($result[$val['VAR']], $val['VAL']);
		}
		unset($result['CONTENT']);
		foreach($result as $key => $val){
			if(count($result[$key]) == 1){
				$result[$key] = $result[$key][0];
			}
		}
		return $result;
	}

}