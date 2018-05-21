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
			$this->view->redirect('/admin/main');
		}
	}

	public function loginAction(){	
		if($this->model->logIn()){
			$this->view->redirect('/admin/main');
		}else{
			$this->view->redirect('/admin/auth');
		}
	}

	public function logoutAction(){	
		$this->model->logOut();
		$this->view->redirect('/admin/auth');
	}





	public function configAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->configContent();
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}

	public function siteContentAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->siteContent();
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
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
	}

	public function sitePagesAction(){	
		$this->isAuth();
		$this->settings();
		$content = $this->model->sitePagesContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}

	public function catalogCitiesAction(){
		$this->isAuth();
		$this->settings();
		$content = $this->model->catalogCitiesContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}

	public function catalogBusesAction(){
		$this->isAuth();
		$this->settings();
		$content = $this->model->catalogBusesContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}

	public function catalogNewsAction(){
		$this->isAuth();
		$this->settings();
		$content = $this->model->catalogNewsContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}

	public function catalogVacanciesAction(){
		$this->isAuth();
		$this->settings();
		$content = $this->model->catalogVacanciesContent($this->route);
		if($this->model->isAjax()){
			$this->ajax($content);
		}else{
			$this->render($content);
		}
	}






	public function getSiteTreeAction(){
		$this->model->message(true, $this->model->getSiteTreeHTML());
	}





	private function settings($layout = 'admin'){
		$this->view->layout = $layout;
	}

	private function render($content = []){
		$this->view->renderAdmin($this->model->getHeaders(), $content);
	}

	private function ajax($content = []){
		$out = $this->view->outputAjax($this->model->getHeaders(), $content);
		$this->model->message(true, $out);
	}

}