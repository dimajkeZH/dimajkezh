<?php

namespace application\controllers;

use application\controllers\UserController;

class TemplatesUserController extends UserController {

	private function render($content = []){
		$this->view->render($this->model->pg_type, $this->model->getTitle($this->route), $content, $this->model->getViews($this->route));
	}

	public function pageAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));
		}else{
			$this->notFound();
		}
	}

	public function servicesAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));
		}else{
			$this->notFound();
		}
	}

	public function busesAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));	
		}else{
			$this->notFound();
		}
	}

	public function minivansAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));
		}else{
			$this->notFound();
		}	
	}

	public function excursionsAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));	
		}else{
			$this->notFound();
		}
	}

	public function contactsAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));	
		}else{
			$this->notFound();
		}
	}
	
	public function newsAction() {
		if($this->model->setConf($this->route)){
			$this->render($this->model->getContent($this->route));	
		}else{
			$this->notFound();
		}
	}
}