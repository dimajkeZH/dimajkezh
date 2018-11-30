<?php

namespace application\controllers;

use application\controllers\AdminController;

class MainAdminController extends AdminController {

	protected $SUPPORTED_METHODS = ['GET', 'POST'];


	public function mainAction(){	
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$this->model->message(true, '', []);
		}else{
			$this->render();
		}
	}

	public function configAction(){	
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->model->configContent();
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}



	public function authAction(){
		if(!$this->model->isAuth()){
			$this->init('adminEmpty');
			$this->render(true);
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





	public function siteContentAction(){	
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->model->siteContent();
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}

	public function sitePagesAction(){	
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['PAGE'], $this->model->sitePagesContent($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}

	public function siteSettingsAction(){	
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->model->siteSettingsContent();
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}





	public function reportAccountsAction(){
		#debug($this->model->reportAccounts());
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['REPORT'], $this->model->reportAccounts());
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	public function reportSessionsAction(){
		#debug($this->model->reportSessions($this->route));
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['REPORT'], $this->model->reportSessions($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	public function reportActionsAction(){
		#debug($this->model->reportActions($this->route));
		$this->isAuth();
		$this->init();
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['REPORT'], $this->model->reportActions($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	




	public function catalogBusesAction(){
		$this->isAuth();
		$this->init();
		#debug($this->model->catalogBusesContent($this->route));
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['CATALOG'], $this->model->catalogBusesContent($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	public function catalogMinivansAction(){
		$this->isAuth();
		$this->init();
		#debug($this->model->catalogMinivansContent($this->route));
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['CATALOG'], $this->model->catalogMinivansContent($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	public function catalogNewsAction(){
		$this->isAuth();
		$this->init();
		#debug($this->model->catalogNewsContent($this->route));
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['CATALOG'], $this->model->catalogNewsContent($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}
	public function catalogVacanciesAction(){
		$this->isAuth();
		$this->init();
		#debug($this->model->catalogVacanciesContent($this->route));
		if($this->isAjax){
			$content = $this->outer_struct(self::PAGE_TYPES['CATALOG'], $this->model->catalogVacanciesContent($this->route));
			$this->model->message(true, '', $content);
		}else{
			$this->render();
		}
	}

}