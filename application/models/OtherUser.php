<?php

namespace application\models;

use application\core\Model;

class OtherUser extends User {


	public function getHeaders($route){
		$q = 'SELECT HTML_TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGES AS P INNER JOIN LIB_LOCATIONS AS LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		#debug([$this->db->row($q, $params), $q]);
		return $this->db->row($q, $params)[0];
	}

	public function getView($route){
		$q = 'SELECT V.NAME FROM LIB_VIEWS as V INNER JOIN (PAGES AS P INNER JOIN LIB_LOCATIONS AS L ON L.ID = P.ID_LOCATION) ON P.ID_VIEW = V.ID WHERE (L.CONTROLLER = :CONTROLLER) AND (L.ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action'],
		];
		return $this->db->column($q, $params);
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
		if(count($return['CONTENT']) == 0){
			return false;
		}
		return $return;
	}

}