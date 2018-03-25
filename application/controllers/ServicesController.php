<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		$result = $this->model->getSomething($this->route['param']);
		$vars = [
			'param' => $result,
		];
		$this->view->render('Услуги',$vars);
	}

}