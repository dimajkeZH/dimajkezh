<?php

namespace application\controllers;

use application\core\Controller;

class ExcursionsController extends Controller {

	public function indexAction() {
		$this->view->render('Экскурсии');
	}

}