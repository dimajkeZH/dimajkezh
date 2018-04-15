<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

	public function getTitle($route){
		$q = 'SELECT TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGE_GROUPS AS PG INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = PG.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		$title = $this->db->row($q, $params);
		return $title[0];
	}

	public function getContent($route){
		$result['PAGELIST'] = $this->pagelist($route);
		$result['CONTENT'] = $this->content($route);
		return $result;
	}

	public function getVacancies($route){
		$result['VACANCIESLIST'] = $this->vacancieslist($route);
		$result['CONTENT'] = $this->content($route);
		return $result;
	}

	public function getNews($route){
		if($route['param'] == 0){
			$route['param'] = 1;
		}
		$countNews = 5;
		$limA = ($route['param'] - 1) * $countNews;
		$allcountNews = $this->db->column('SELECT COUNT(ID) FROM DATA_NEWS;');
		$allcountPage = intdiv($allcountNews, $countNews);
		if($allcountNews % $countNews > 0){
			$allcountPage++;
		}
		if($route['param'] > $allcountPage AND $allcountPage > 1){
			\application\core\View::errorCode(404);
		}
		$result['PAGINATION'] = $this->pagination($route['param'], $allcountPage);
		$result['PAGE'] = $route['param'];
		$result['NEWSLIST'] = $this->db->row('SELECT * FROM DATA_NEWS ORDER BY DATE_ADD DESC, TIME_ADD DESC LIMIT '.$limA.','.$countNews.';');
		$result['CONTENT'] = $this->content($route);
		return $result;
	}

	private function pagelist($route){
		$q = 'SELECT P.TITLE, P.DESCR, CONCAT(SUBSTR(LL.NAME, 1, INSTR(LL.NAME, "[0-9]{1,}")-1), P.LOC_NUMBER) as LINK, P.IMAGE  FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = "templates") AND (LL.ACTION = :ACTION)';
		$params = [
			'ACTION' => $route['action']
		];
		return $this->db->row($q, $params);
	}

	private function content($route){
		$q = 'SELECT PGC.VAR, PGC.VAL FROM PAGE_GROUPS_CONTENT as PGC INNER JOIN (PAGE_GROUPS as PG INNER JOIN LIB_LOCATIONS as LL ON LL.ID = PG.ID_LOCATION) ON PG.ID = PGC.ID_GROUP WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = ['CONTROLLER' => $route['controller'], 'ACTION' => $route['action']];
		$result = $this->db->row($q, $params);
		if(count($result) == 0){
			return NULL;
		}
		foreach($result as $key => $val){
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

	private function vacancieslist($route){
		return $this->db->row('SELECT TITLE, IMAGE, DESCR  FROM DATA_VACANCIES');
	}

	private function pagination($cur, $all){
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