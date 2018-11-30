<?php

namespace application\controllers;

use application\controllers\AdminController;

class ApiAdminController extends AdminController {

	protected $SUPPORTED_METHODS = ['POST'];


	public function SiteTreeAction(){
		if($this->model->isAuth()){
			$content = $this->model->getSiteTree();
			$this->model->message(true, '', $content);
		}else{
			$this->model->message(false, self::NOT_AUTH);
		}
	}

	public function CheckURIAction(){
		$this->settings();
		if($this->post){
			if($this->model->checkURI($this->post)){
				$this->model->message(true, self::URI_CHECK_GOOD);
			}else{
				$this->model->message(false, self::URI_CHECK_BAD);
			}
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

}