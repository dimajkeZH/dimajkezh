<?php

namespace application\models;

use application\models\User;

class MainUser extends User {

	const ControlTemplatesName = 'TemplatesUser';

	public function getTitle($route){
		$q = 'SELECT HTML_TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGE_GROUPS AS PG INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = PG.ID_LOCATION WHERE (LL.CONTROLLER LIKE :CONTROLLER) AND (LL.ACTION LIKE :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		$title = $this->db->row($q, $params);
		if(count($title) == 0){
			$q = 'SELECT TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER LIKE :CONTROLLER) AND (LL.ACTION LIKE :ACTION)';
			$params = [
				'CONTROLLER' => $route['controller'],
				'ACTION' => $route['action']
			];
			$title = $this->db->row($q, $params);
		}
		$title[0]['USER_CHOICE'] = $this->choice_list();
		return (count($title) > 0) ? $title[0] : [];
	}

	public function getContent($route){
		$result['PAGELIST'] = $this->pagelist($route);
		$result['CONTENT'] = $this->content($route);
		$result['USER_CHOICE'] = $this->choice_list();
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

	public function getBus($route){
		$q = 'SELECT * FROM DATA_BUSES WHERE URI LIKE :URI';
		$params = ['URI' => $route['param']];
		$return['CONTENT'] = $this->db->row($q, $params);
		return $return;
	}

	private function pagelist($route){
		$q = 'SELECT P.TITLE, P.DESCR, P.URI/*CONCAT(SUBSTR(LL.NAME, 1, INSTR(LL.NAME, "[0-9]{1,}")-1), P.LOC_NUMBER)*/ as LINK, P.IMAGE  FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => self::ControlTemplatesName,
			'ACTION' => $route['action']
		];
		return $this->db->row($q, $params);
	}

	private function content($route){
		$q = 'SELECT PGC.VAR, PGC.VAL FROM PAGE_GROUPS_CONTENT as PGC INNER JOIN (PAGE_GROUPS as PG INNER JOIN LIB_LOCATIONS as LL ON LL.ID = PG.ID_LOCATION) ON PG.ID = PGC.ID_GROUP WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'], 
			'ACTION' => $route['action']
		];
		$result = $this->db->row($q, $params);
		if(count($result) == 0){
			return NULL;
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

	private function vacancieslist($route){
		return $this->db->row('SELECT TITLE, IMAGE, DESCR  FROM DATA_VACANCIES');
	}

}