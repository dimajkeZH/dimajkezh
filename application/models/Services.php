<?php

namespace application\models;

use application\core\Model;

class Services extends Model {

	public function getData($param) {
		$result = [];
		//$result['layout_type'] = $this->db->row('SELEC * FROM kek;',[0=>123,1=>321]);
		return $result;
	}

}