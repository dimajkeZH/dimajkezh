<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		debug(0);
		$this->view->renderIndex('Услуги', $this->model->getIndexContent());
	}

	public function pageAction() {
		debug(1);
		$this->view->renderPage(
								$this->model->getTitle($this->route['param']),
								$this->model->getContent($this->route['param'])
								);
	}

}