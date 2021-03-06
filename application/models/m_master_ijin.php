<?php
class M_master_ijin extends App_Model{
	var $mainSql = "SELECT 
				*
				FROM ijin 
			WHERE id IS NOT NULL 
	";
	
	function __construct(){
        parent::__construct();
        $this->table_name = 'master_ijin';
        $this->column_primary = 'id';
        $this->column_order = 'id ASC';
		$this->column_unique = '';
    }
	
	function getList($params){
		extract($params);
		$sql = $this->mainSql;
		if(@$searchText != ''){
			$sql .= "
				AND (
					nama LIKE '%".$searchText."%'
					)
			";
		}
				if(@$limit_start != 0 && @$limit_start != 0){
			$sql .= " LIMIT ".@$limit_start.", ".@$limit_end." ";
		}
		$result = $this->__listCore($sql, $params);
		return $result;
	}
	
	function search($params){
		extract($params);
		
		$sql = $this->mainSql;
		
		if(@$NAMA_IJIN != ''){
			$sql .= " AND NAMA_IJIN LIKE '%".$NAMA_IJIN."%' ";
		}
		if(@$NAMA_PEJABAT != ''){
			$sql .= " AND NAMA_PEJABAT LIKE '%".$NAMA_PEJABAT."%' ";
		}
		if(@$NIP_PEJABAT != ''){
			$sql .= " AND NIP_PEJABAT LIKE '%".$NIP_PEJABAT."%' ";
		}
		if(@$JABATAN != ''){
			$sql .= " AND JABATAN LIKE '%".$JABATAN."%' ";
		}
		if(@$PANGKAT != ''){
			$sql .= " AND PANGKAT LIKE '%".$PANGKAT."%' ";
		}
		if(@$ATASNAMA != ''){
			$sql .= " AND ATASNAMA LIKE '%".$ATASNAMA."%' ";
		}
		if(@$limit_start != 0 && @$limit_start != 0){
			$sql .= " LIMIT ".@$limit_start.", ".@$limit_end." ";
		}
		$result = $this->__listCore($sql, $params);
		return $result;
	}
	
	function printExcel($params){
		extract($params);
		if(@$currentAction == "GETLIST"){
			$result = $this->getList($params);
		}else if(@$currentAction == "SEARCH"){
			$result = $this->search($params);
		}
		return $result;
	}
	
}