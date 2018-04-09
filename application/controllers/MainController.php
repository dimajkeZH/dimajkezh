<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function mainAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function servicesAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function busesAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function minivansAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function excursionsAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function contactsAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getVacancies($this->route));
	}

	public function newsAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getNews($this->route));
	}

	public function busAction() {
		$this->view->renderIndex($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}
}