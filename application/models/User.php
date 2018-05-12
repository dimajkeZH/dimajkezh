<?php

namespace application\models;

use application\core\Model;

abstract class User extends Model {


	public function pagination($cur, $all){
		$n = 2;
		$return = [];
		if($all <= (2*$n + 2)){
			for($i = 1; $i <= $all; $i++){
				array_push($return, $i);
			}
			return $return;
		}
		if($cur > ($n + 2) AND $cur < ($all - $n - 2)){
			array_push($return, '1', '...');
			for($i = ($cur - $n); $i <= ($cur + $n); $i++){
				array_push($return, $i);
			}
			array_push($return, '...', $all);
			return $return;
		}
		//начало
		if($cur >= 1 AND $cur <= $n){
			for($i = 1; $i <= (2*$n); $i++){
				array_push($return, $i);
			}
			array_push($return, '...', $all);
			return $return;
		}
		//начало + 1
		if($cur == $n+1){
			for($i = 1; $i <= (2*$n+1); $i++){
				array_push($return, $i);
			}
			array_push($return, '...', $all);
			return $return;
		}
		//начало + 2 (не скрывать 1 цифру за ...)
		if($cur == $n+2){
			for($i = 1; $i <= (2*$n+2); $i++){
				array_push($return, $i);
			}
			array_push($return, '...', $all);
			return $return;
		}
		//конец - 2 (не скрывать 1 цифру за ...)
		if($cur == ($all - $n - 2)){
			array_push($return, '1', '...');
			for($i = ($all - 2*$n - 2); $i <= $all; $i++){
				array_push($return, $i);
			}
			//debug($CUR_PAGE >= ($all - 2*$N) AND $CUR_PAGE <= $all);
			return $return;
		}
		//конец - 1
		if($cur == ($all - $n - 1)){
			array_push($return, '1', '...');
			for($i = ($all - 2*$n - 1); $i <= $all; $i++){
				array_push($return, $i);
			}
			//debug($CUR_PAGE >= ($all - 2*$N) AND $CUR_PAGE <= $all);
			return $return;
		}
		//конец
		if($cur >= ($all - $n) AND $cur <= $all){
			array_push($return, '1', '...');
			for($i = ($all - 2*$n); $i <= $all; $i++){
				array_push($return, $i);
			}
			//debug($CUR_PAGE >= ($all - 2*$N) AND $CUR_PAGE <= $all);
			return $return;
		}
	}
	
}