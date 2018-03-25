<?php

namespace application\models;

use application\core\Model;

class Services extends Model {

	public function getSomething($param) {
		$result = $param;
		return $result;
	}

}