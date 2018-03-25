<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		$this->view->render('Услуги');
	}

}