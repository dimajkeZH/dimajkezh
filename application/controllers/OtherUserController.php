<?php

namespace application\controllers;

use application\core\Controller;

class OtherUserController extends UserController {

	public function busAction() {
		$bus = $this->model->getBus($this->route);
		if($bus){
			$this->render($bus);
		}else{
			$this->notFound();
		}
		
	}

	public function newsAction() {
		$news = $this->model->getNews($this->route);
		if($news){
			$this->render($news);
		}else{
			$this->notFormed();
		}
	}
}