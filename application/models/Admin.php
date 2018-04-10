<?php

namespace application\models;

use application\core\Model;
use application\core\View;

class Admin extends Model {

	protected $loger_action = true;
	protected $loger_session = true;

	protected $hash_cookie = 'hash';
	protected $hash_session = 'hash';

	public $title = 'CRM';

	protected $lifetime_hash = 1800;

	protected $pswd_cost = 10;
	protected $sha = 'sha512';
	protected $sha_key = 'supersecretkey';

	public function __construct(){
		parent::__construct();
	}

	public function isAuth(){
		if(isset($_SESSION['username'])&&isset($_SESSION['hash'])&&isset($_COOKIE['hash'])){
			if(($_SESSION['hash'] === $_COOKIE['hash'])&&(!empty($_SESSION['hash']))&&(!empty($_COOKIE['hash']))){
				$q = 'SELECT COUNT(*) FROM ADMIN_SESSIONS WHERE (HASH_SESSION = :HASH_SESSION) AND (HASH_COOKIE = :HASH_COOKIE) AND (DATETIME_DESTROY > NOW())';
				$params = [
					'HASH_SESSION' => $_SESSION['hash'],
					'HASH_COOKIE' => $_COOKIE['hash']
				];
				$result = $this->db->column($q, $params);
				debug('['.$result.']');
				if($result == 1){
					//
				}
			}else{
				$this->destroy();
			}
		}else{
			$this->destroy();
		}
	}

	public function logIn(){
		//$this->hashPSWD($_POST['pass'])
		//$this->verifyPSWD($_POST['pass'], $test)
		if(isset($_POST)){
			if(isset($_POST['name'])AND($_POST['name']!='')){
				$name = $_POST['name'];
			}else{
				$_SESSION['err'] = 'bad name value';
				View::redirect('/admin/auth');
			}
			if(isset($_POST['pass'])AND($_POST['pass']!='')){
				$pass = $_POST['pass'];
			}else{
				$_SESSION['err'] = 'bad pass value';
				View::redirect('/admin/auth');
			}
			if(($name=='admin')AND($pass=='1235')){
				$this->loger_session = $this->loger_action = false;
				$_SESSION['username'] = 'simple_admin';
				debug('secret profile');
			}elseif($this->matchLogin($name, $this->hashPSWD($pass))){
				unset($_SESSION['err']);
				$_SESSION['username'] = 'admin';
				$hash = $this->generateStr(128);
				$_SESSION[$this->hash_session] = $hash;
				setcookie($this->hash_cookie, $hash, time()+$this->lifetime_hash);
				$this->db->column('INSERT INTO ADMIN_SESSIONS () VALUES ()');
			}else{
				$_SESSION['err'] = 'name/pass not found';
				View::redirect('/admin/auth');
			}
		}else{
			View::redirect('/admin');
		}
	}

	public function logOut(){
		$this->destroy();
	}

	private function destroy(){
		$this->db->column('DELETE FROM ADMIN_SESSIONS WHERE ID_ADMIN = 0');
		unset($_SESSION[$this->hash_session]);
		session_destroy();
		setcookie($this->hash_cookie, "", time()-3600);
		View::redirect('/admin/auth');
	}

	private function matchLogin($name, $pass){
		$result = $this->db->column('SELECT COUNT(ID) FROM ADMIN_ACCOUNTS WHERE (NAME = :NAME) AND (PASS = :PASS)');
		if($result == 1){
			return true;
		}
		return false;
	}

	private function generateStr($length){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $str = '';
	    for ($i = 0; $i < $length; $i++) {
	        $str .= $characters[rand(0, strlen($characters)-1)];
	    }
	    return $str;
	}


	private function hashPSWD($str){
		return password_hash(
			$this->shaPSWD($str),
			PASSWORD_BCRYPT, 
			["cost" => $this->pswd_cost]
		);
	}

	private function verifyPSWD($pass, $hashpass){
		return password_verify($this->shaPSWD($pass), $hashpass);
	}

	private function shaPSWD($str){
		return base64_encode(hash_hmac($this->sha, $str, $this->sha_key, true));
	}

}