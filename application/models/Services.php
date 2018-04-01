<?php

namespace application\models;

use application\core\Model;

class Services extends Model {

	public function getIndexContent($route){
		$q = 'SELECT P.TITLE, P.DESCR, CONCAT(SUBSTR(LL.NAME, 1, INSTR(LL.NAME, "[0-9]{1,}")-1), P.LOC_NUMBER) as LINK, P.IMAGE  FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = "page")';
		$params = ['CONTROLLER' => $route['controller']];
		$result['PAGELIST'] = $this->db->row($q, $params);
		$q = 'SELECT IPC.VAR, IPC.VAL FROM INDEX_PAGE_CONTENT as IPC INNER JOIN (INDEX_PAGES as IP INNER JOIN LIB_LOCATIONS as LL ON LL.ID = IP.ID_LOCATION) ON IP.ID = IPC.ID_INDEX_PAGE WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = ['CONTROLLER' => $route['controller'], 'ACTION' => $route['action']];
		$result['CONTENT'] = $this->db->row($q, $params);
		$result['TITLE'] = $result['DESCR'] = [];
		foreach($result['CONTENT'] as $key => $val){
			array_push($result[$val['VAR']], $val['VAL']);
		}
		unset($result['CONTENT']);
		return $result;
	}
}