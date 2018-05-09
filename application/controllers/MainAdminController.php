<?php

namespace application\controllers;

use application\controllers\AdminController;

class MainAdminController extends AdminController {

	public function mainAction(){	
		$this->isAuth();
		$this->settings();
		$this->render($this->model->getContent());
	}

	public function authAction(){
		if(!$this->model->isAuth()){
			$this->settings('adminEmpty');
			$this->render();
		}else{
			$this->view->redirect('/admin');
		}
	}

	public function loginAction(){	
		if($this->model->logIn()){
			$this->view->redirect('/admin');
		}else{
			$this->view->redirect('/admin/auth');
		}
	}

	public function logoutAction(){	
		$this->model->logOut();
		$this->view->redirect('/admin/auth');
	}















		public function settingsAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->settingsContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'settingsAction');
	}

	public function siteContentAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->siteContent($this->route);
		//debug($content);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'siteAction');
	}

	public function siteSettingsAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->siteSettingsContent();
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'siteSettingsAction');
	}

	public function sitePageGroupsAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->sitePageGroupsContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'sitePageGroupsAction');
	}

	public function siteCaseGroupsAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->siteCaseGroupsContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'siteCaseGroupsAction');
	}

	public function siteCasesAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->siteCasesContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
		//$this->model->message(true, 'siteCasesAction');
	}

	public function getSiteTreeAction(){
		$this->model->message(true, $this->model->getSiteTreeHTML());
	}
















	

}