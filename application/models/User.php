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

	public function choice_list(){
		$return = '<option value="0">---Выбор транспорта---</option>';
		$q = 'SELECT P.ID as VAL, P.CHOICE_TITLE as TITLE FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON P.ID_LOCATION = LL.ID WHERE (LL.ID IN (7, 5)) AND (P.CHOICE_TITLE NOT LIKE "") ORDER BY P.ID_LOCATION DESC, P.LOC_NUMBER ASC;';
		$result = $this->db->row($q);
		foreach($result as $key => $val){
			$return .= '<option value="'.$val['VAL'].'">'.$val['TITLE'].'</option>';
		}
		return $return;
	}
	
}