<?php

namespace application\controllers;

use application\controllers\AdminController;
use application\controllers\CronAdminController;

class AjaxAdminController extends AdminController {


	const MESSAGE__NO_VALUES = 'Нет параметров';
	const MESSAGE__BAD_VALUES = 'Не все параметры заполнены правильно';

	const MESSAGE__CHANGE_GOOD = 'Данные успешно изменены';
	const MESSAGE__CHANGE_BAD = 'Изменение данных не произошло';

	const MESSAGE__DELETE_GOOD = 'Данные успешно удалены';
	const MESSAGE__DELETE_BAD = 'Удаление данных не произошло';

	public function saveSettingsAction(){
		if($_POST){
			if($this->model->verSettingsAction()){
				if($this->model->saveSettingsAction()){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSiteContentAction(){	
		if($_POST){
			if($this->model->verSiteContent()){
				if($this->model->saveSiteContent()){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSiteSettingsAction(){	
		if($_POST){
			if($this->model->verSiteSettings()){
				if($this->model->saveSiteSettings()){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSitePageGroupsAction(){	
		if($_POST){
			if($this->model->verSitePageGroups()){
				if($this->model->saveSitePageGroups()){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSiteCaseGroupsAction(){	
		if($_POST){
			if($this->model->verSiteCaseGroups()){
				if($this->model->saveSiteCaseGroups()){
					$this->model->updCron();
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSiteCasesAction(){	
		if($_POST && $_FILES){
			if($this->model->verSiteCases()){
				if($this->model->saveSiteCases()){
					$this->model->updCron();
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}





	public function del/*NAME*/Action(){
		if($_POST){
			if($this->model->ver/*NAME*/()){
				if($this->model->del/*NAME*/()){
					$this->model->message(true, self::MESSAGE__DELETE_GOOD);
				}$this->model->message(false, self::MESSAGE__DELETE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}


}