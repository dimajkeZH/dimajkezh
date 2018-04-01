<?php

namespace application\models;

use application\core\Model;

class Contacts extends Model {

	public function getIndexContent($route){
		$result['VACANCIESLIST'] = $this->db->row('SELECT TITLE, DESCR, IMAGE FROM VACANCIES_LIST ORDER BY ID');
		$q = 'SELECT IPC.VAR, IPC.VAL FROM INDEX_PAGE_CONTENT as IPC INNER JOIN (INDEX_PAGES as IP INNER JOIN LIB_LOCATIONS as LL ON LL.ID = IP.ID_LOCATION) ON IP.ID = IPC.ID_INDEX_PAGE WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = ['CONTROLLER' => $route['controller'], 'ACTION' => $route['action']];
		$result['CONTENT'] = $this->db->row($q, $params);
		foreach($result['CONTENT'] as $key => $val){
			$result[$val['VAR']] = $val['VAL'];
		}
		unset($result['CONTENT']);
		return $result;
	}
}