<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Услуги', $this->model->getIndexContent($this->route));
	}

}