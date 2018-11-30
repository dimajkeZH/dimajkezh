<?php

namespace application\models;

use application\models\Admin;

class ApiAdmin extends Admin {


	public function getSiteTree(){
		$parents = $this->db->row('SELECT ID, HTML_TITLE, CAN_BE_SUPPLEMENTED FROM PAGES WHERE ID_PARENT = 0 ORDER BY LOC_NUMBER ASC');
		if(!$parents){
			return;
		}
		$obj = [];

		#debug($parents);
		foreach($parents as $parent){
			$parent_obj = [
				'ID' => $parent['ID'],
				'TITLE' => $parent['HTML_TITLE'],
				'CAN_BE_SUPPLEMENTED' => $parent['CAN_BE_SUPPLEMENTED'],
			];

			if(!$parent['CAN_BE_SUPPLEMENTED']){
				array_push($obj, $parent_obj);
				continue;
			}

			$parent_obj['CHILDRENS'] = $this->getChildrens($parent['ID']);

			array_push($obj, $parent_obj);
		}

		#debug($obj);
		return $obj;
	}

	private function getChildrens($ID_PARENT){
		$q = 'SELECT ID, HTML_TITLE, CAN_BE_SUPPLEMENTED FROM PAGES WHERE ID_PARENT = :ID_PARENT ORDER BY LOC_NUMBER ASC';
		$params = [
			'ID_PARENT'=> $ID_PARENT,
		];
		$childrens = $this->db->row($q, $params);
		$children_obj =[];

		foreach($childrens as $children){
			$subchildren_obj = [
				'ID' => $children['ID'],
				'TITLE' => $children['HTML_TITLE'],
				'CAN_BE_SUPPLEMENTED' => $children['CAN_BE_SUPPLEMENTED'],
			];

			if(!$children['CAN_BE_SUPPLEMENTED']){
				array_push($children_obj, $subchildren_obj);
				continue;
			}

			array_push($children_obj['CHILDRENS'], $this->getChildrens($children['ID']));

			array_push($children_obj, $subchildren_obj);
		}

		return $children_obj;
	}

	public function checkURI($post){
		$ID_PAGE = $post['ID_PAGE'];
		$URI = $post['URI'];

		$q = 'SELECT count(*) as `COUNT` FROM PAGES WHERE (ID NOT IN (:ID)) AND (URI LIKE :URI)';
		$params = [
			'ID' => $ID_PAGE, 
			'URI' => $URI
		];
		$count = $this->db->column($q, $params);
		if($count == 0){
			return true;
		}
		return false;
	}
}