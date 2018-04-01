<?php

namespace application\controllers;

use application\core\Controller;

class BusesController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Автобусы', $this->model->getIndexContent($this->route));
	}

}