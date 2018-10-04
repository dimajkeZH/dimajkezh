<?php

namespace application\controllers;

use application\core\Controller;

abstract class UserController extends Controller {

	public function notFound(){
		$this->view::errorCode(404);
	}

}