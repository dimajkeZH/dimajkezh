<?php

namespace application\controllers;

use application\core\Controller;

class TemplatesController extends Controller {

	public function pageAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function servicesAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function busesAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function minivansAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function excursionsAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function contactsAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}

	public function newsAction() {
		$this->view->renderPage($this->model->getTitle($this->route), $this->model->getContent($this->route));
	}
}