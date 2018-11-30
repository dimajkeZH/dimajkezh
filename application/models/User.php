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
			return $return;
		}
		//конец - 1
		if($cur == ($all - $n - 1)){
			array_push($return, '1', '...');
			for($i = ($all - 2*$n - 1); $i <= $all; $i++){
				array_push($return, $i);
			}
			return $return;
		}
		//конец
		if($cur >= ($all - $n) AND $cur <= $all){
			array_push($return, '1', '...');
			for($i = ($all - 2*$n); $i <= $all; $i++){
				array_push($return, $i);
			}
			return $return;
		}
	}



	public function content($route){
		$q = '
			SELECT LVF.VAR, PC.VAL FROM PAGE_CONTENT AS PC
			INNER JOIN (PAGES as P
				INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION) 
			ON P.ID = PC.ID_PAGE
			INNER JOIN LIB_VIEW_FIELDS as LVF ON LVF.ID = PC.ID_FIELD
			WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'], 
			'ACTION' => $route['action']
		];
		$result = $this->db->row($q, $params);
		if(count($result) == 0){
			return [];
		}
		foreach($result as $key => $val){
			if(preg_match('#^DESCR[0-9]{0,}$#', $val['VAR'])){
				$val['VAR'] = 'DESCR';
			}
			if(!isset($return[$val['VAR']])){
				$return[$val['VAR']] = [];
			}
			array_push($return[$val['VAR']], $val['VAL']);
		}
		unset($result);
		foreach($return as $key => $val){
			if(count($return[$key]) == 1){
				$return[$key] = $return[$key][0];
			}
		}
		return $return;
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
	
	public function getView($route){
		$q = 'SELECT V.NAME FROM LIB_VIEWS as V INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS L ON L.ID = P.ID_LOCATION) ON P.ID_VIEW = V.ID WHERE (L.CONTROLLER = :CONTROLLER) AND (L.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action'],
		];
		if(isset($route['param']) && $route['param'] != ''){
			$params['URI'] = $route['param'];
			$q .= ' AND (P.URI = :URI)';
		}
		return $this->db->column($q, $params);
	}



	public function getHeaders($route){
		$q = 'SELECT HTML_TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		if(isset($route['param']) && $route['param'] != ''){
			$params['URI'] = $route['param'];
			$q .= ' AND (P.URI = :URI)';
		}
		return $this->db->row($q, $params)[0];
	}

}