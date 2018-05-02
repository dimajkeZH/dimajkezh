<?php

namespace application\controllers;

use application\core\Controller;

class TemplatesController extends Controller {

	private function settings(){
		$this->model->setConf($this->route);
	}

	private function render($content = []){
		$this->view->render($this->model->pg_type, $this->model->getTitle($this->route), $content, $this->model->getViews($this->route));
	}

	public function pageAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));
	}
	public function servicesAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));
	}
	public function busesAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));	
	}
	public function minivansAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));	
	}
	public function excursionsAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));	
	}
	public function contactsAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));	
	}
	public function newsAction() {
		$this->settings();
		$this->render($this->model->getContent($this->route));	
	}
}