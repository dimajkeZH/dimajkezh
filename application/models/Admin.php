<?php

namespace application\models;

use application\core\Model;

abstract class Admin extends Model {

	/* CLASS VARIABLES */
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

	const IMAGE_FILE_FORMAT = 'png';

	const SESSION_ERR_NAME = 'err';
	/* CLASS VARIABLES END */





	/* BOOLEAN PUBLIC FUNCTIONS */
	//user is authorized or not
	public function isAuth(){
		if(isset($_SESSION['hash']) && isset($_COOKIE['hash']) && !empty($_SESSION['hash']) && !empty($_COOKIE['hash'])){
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
		$this->sessionDestroy();
		return false;
	}

	public function isSupportedMethod($supported_methods = []){
		return in_array($_SERVER["REQUEST_METHOD"], $supported_methods);
	}

	//get type of response
	public function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}
	/* BOOLEAN PUBLIC FUNCTIONS END */





	/* PUBLIC FUNCTIONS */
	//session destroy
	public function sessionDestroy(){
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
	public function sessionCreate($id_admin, $remember = false){
		if($remember){
			$this->lifetime_hash *= 1500;
		}
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


	//logging actions
	public function loger($number, $cur){

	}

	//get CURRENT TIME with shift on some seconds
	public function now($sec = 0){
		return date_modify(date_create(), "+$sec sec")->format('Y-m-d H:i:s');
	}

	public function trace_err($msg = ''){
		if($msg != ''){
			$_SESSION[self::SESSION_ERR_NAME] = $msg;
		}
	}

	public function clear_err($msg = ''){
		unset($_SESSION[self::SESSION_ERR_NAME]);
	}
	/* PUBLIC FUNCTIONS END */	


	/* PRIVATE FUNCTIONS */
	//string generation the specified length
	public function generateStr($length){
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
	public function verifyPSWD($name, $pass){
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
	public function shaPSWD($str){
		return base64_encode(hash_hmac($this->sha, $str, $this->sha_key, true));
	}

	/* PRIVATE FUNCTIONS END */

}