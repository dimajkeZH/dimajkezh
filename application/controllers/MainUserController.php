<?php

namespace application\controllers;

use application\controllers\UserController;

class MainUserController extends UserController {

	public function mainAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::USER_CHOICE,
				$this->model::PAGELIST,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

	public function servicesAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::USER_CHOICE,
				$this->model::PAGELIST,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

	public function busesAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::USER_CHOICE,
				$this->model::PAGELIST,
				$this->model::LOCATION,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

	public function minivansAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::USER_CHOICE,
				$this->model::PAGELIST,
				$this->model::LOCATION,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

	public function excursionsAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::USER_CHOICE,
				$this->model::PAGELIST,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

	public function contactsAction() {
		$content = $this->model->getContent(
			$this->route,
			[
				$this->model::CONTENT,
				$this->model::VACANCIESLIST,
			]
		);
		if($content){
			$this->render($content);
		}else{
			$this->notFormed();
		}
	}

}