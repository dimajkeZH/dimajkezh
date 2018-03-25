<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		$vars = $this->model->getData($this->route['param']);
		$this->view->render('Услуги',$vars);
	}

}