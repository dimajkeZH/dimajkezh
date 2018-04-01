<?php

namespace application\models;

use application\core\Model;

class Contacts extends Model {

	public function getIndexContent($route){
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