<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Главная страница', $this->model->getIndexContent($this->route));
	}

}