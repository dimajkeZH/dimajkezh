<?php

namespace application\models;

use application\core\Model;

class Excursions extends Model {

	public function getIndexContent($route){
		$q = 'SELECT P.TITLE, P.DESCR, CONCAT(SUBSTR(LL.NAME, 1, INSTR(LL.NAME, "[0-9]{1,}")-1), P.LOC_NUMBER) as LINK  FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = "page")';
		$params = ['CONTROLLER' => $route['controller']];
		$result['PAGELIST'] = $this->db->row($q, $params);
		return $result;
	}
}