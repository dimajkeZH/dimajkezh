<?php

namespace application\models;

use application\models\Admin;

class CronAdmin extends Admin {

	const CRON_DIR = '/application/views/layouts/cache/';

	const MENU_PATH = '';
	const MAIN_SLICK_PATH = '';
	const BUS_SLICK_PATH = '';
	const MINIVAN_SLICK_PATH = '';

	const CATALOG_SLICKS = '/assets/img/slick/';


	const SLICK_START = '<div class="main_courusel_wrapper">
			<div class="main_courusel">
				<div class="main_courusel_items">';

	const SLICK_END = '</div>
				<div class="next"><img src="/assets/img/static/next.png" alt=""></div>
				<div class="back"><img src="/assets/img/static/back.png" alt=""></div>
			</div>	
			<div class="main_courusel_prises">
			<a href=""><p>Тарифы</p></a>
			</div>
		</div>';

	private $SRV_DOCKS;

	private $uri;

	public function __construct(){
		parent::__construct();
		$this->SRV_DOCKS = $_SERVER['DOCUMENT_ROOT'].self::CRON_DIR;
		$this->uri = [
			'3' => 'uslugi',
			'5' => 'avtobusy',
			'7' => 'mikroavtobusy',
			'9' => 'avtobusnyie_ekskursii'
		];
	}

	public function updMenu(){
		$q = 'SELECT ID_LOCATION, TITLE, URI FROM PAGES WHERE ID_LOCATION IN (:LOC1, :LOC2, :LOC3, :LOC4) ORDER BY ID_LOCATION ASC, LOC_NUMBER ASC';
		$params = [
			'LOC1'=> 3,
			'LOC2'=> 5,
			'LOC3'=> 7,
			'LOC4'=> 9
		];
		$result = $this->db->row($q, $params);

		$menu = [
			'3' => '',
			'5' => '',
			'7' => '',
			'9' => ''
		];

		$title = [
			'3' => 'Услуги',
			'5' => 'Автобусы',
			'7' => 'Микроавтобусы',
			'9' => 'Экскурсии'
		];

		foreach($result as $key => $val){
			$num = $val['ID_LOCATION'];
			$TITLE = $val['TITLE'];
			$local_uri = $val['URI'];
			
			$URI = '/'.$this->uri[$num].'/'.$local_uri;
			$menu[$num] .= '<a href="'.$URI.'">'.$TITLE.'</a>';

		}

		$content = '';

		foreach(['3','5','7','9'] as $key => $num){
			$TITLE = $title[$num];
			$URI = '/'.$this->uri[$num];

			$content .= '<div class="nav_item"><a href="'.$URI.'">'.$TITLE.'</a><div class="subnav">'.$menu[$num].'</div></div>';
		}

		$content = '<div class="main_nav"><div class="burger"><span></span></div><nav class="nav">'.$content.'<div class="nav_item"><a href="/contacts">Контакты</a></div></nav></div>';
		

		$filename = $this->SRV_DOCKS.'menu.html';
		$file = fopen($filename, 'w');
		fwrite($file, $content);
		fclose($file);



		$q = 'SELECT NEW.TITLE, NUMBER, LL.CONTROLLER, LL.ACTION FROM (SELECT ID_LOCATION, TITLE, LOC_NUMBER as NUMBER FROM PAGES UNION ALL SELECT ID_LOCATION, TITLE, "0" as NUMBER FROM INDEX_PAGES WHERE ID_LOCATION > 1) as NEW INNER JOIN LIB_LOCATIONS as LL ON NEW.ID_LOCATION = LL.ID ORDER BY ID_LOCATION, NUMBER';
		$MENU = $this->db->row($q);
		for($i = 0; $i < count($MENU); $i++){
			$MENUARR[$MENU[$i]['CONTROLLER']][$MENU[$i]['ACTION']][$MENU[$i]['NUMBER']] = $MENU[$i]['TITLE'];
		}
	}

	public function updSlicks(){
		$this->slickFull($this->SRV_DOCKS.self::MAIN_SLICK_PATH);
		$this->slickBuses($this->SRV_DOCKS.self::BUS_SLICK_PATH);
		$this->slickMinivans($this->SRV_DOCKS.self::MINIVAN_SLICK_PATH);
	}



	private function slickFull($file){
		$q = 'SELECT ID_LOCATION, IMAGE, CHOICE_TITLE, URI FROM PAGES WHERE ID_LOCATION IN (:LOC1, :LOC2) ORDER BY ID_LOCATION ASC, LOC_NUMBER ASC';
		$params = [
			'LOC1' => 5,
			'LOC2' => 7
		];
		$result = $this->db->row($q, $params);
		#debug($result);
		$this->slicksDone($result, $this->SRV_DOCKS.'slickFull.html');
	}

	private function slickBuses($file){
		$q = 'SELECT ID_LOCATION, IMAGE, CHOICE_TITLE, URI FROM PAGES WHERE ID_LOCATION IN (:LOC1) ORDER BY ID_LOCATION ASC, LOC_NUMBER ASC';
		$params = [
			'LOC1' => 5
		];
		$result = $this->db->row($q, $params);
		#debug($result);
		$this->slicksDone($result, $this->SRV_DOCKS.'slickBuses.html');
	}

	private function slickMinivans($file){
		$q = 'SELECT ID_LOCATION, IMAGE, CHOICE_TITLE, URI FROM PAGES WHERE ID_LOCATION IN (:LOC2) ORDER BY ID_LOCATION ASC, LOC_NUMBER ASC';
		$params = [
			'LOC2' => 7
		];
		$result = $this->db->row($q, $params);
		#debug($result);
		$this->slicksDone($result, $this->SRV_DOCKS.'slickMinivans.html');
	}

	private function slicksDone($arr, $filename){
		$content = '';
		foreach($arr as $key => $val){
			$IMG = $val['IMAGE'];
			if($IMG != ''){
				$num = $val['ID_LOCATION'];
				$IMG = self::CATALOG_SLICKS.$IMG.'.png';
				$SIGN = $val['CHOICE_TITLE'];
				$URI = '/'.$this->uri[$num].'/'.$val['URI'];
				$content .= $this->getSlickItem($IMG, $SIGN, $URI);
			}	
		}
		$content = self::SLICK_START.$content.self::SLICK_END;

		$file = fopen($filename, 'w');
		fwrite($file, $content);
		fclose($file);
	}

	private function getSlickItem($IMG, $SIGN, $URI){
		return '<div class="main_courusel_item"><div class="data">'.$URI.'</div><div class="main_courusel_item_img"><img src="'.$IMG.'" alt=""><div class="main_courusel_item_text"><p>'.$SIGN.'</p></div></div><a href="'.$URI.'"></a></div>';
	}

}