<?php

namespace application\controllers;

use application\core\Controller;

class ExcursionsController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Экскурсии', $this->model->getIndexContent($this->route));
	}

}