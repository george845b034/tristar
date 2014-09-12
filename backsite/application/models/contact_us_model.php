<?php
class contact_us_model extends CI_Model
{
	public $row_result;

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 取得資料 給分頁用
	**/
	public function getListBasic()
	{
		$this->db->select('*');
		$this->db->from('contact_us');
		$query = $this->db->get();
		
		return count($query->result_array());
	}
	
	/**
	* 取得資料 給select用
	**/
	public function getListContent($inStart, $inLimit, $inSortId = NULL, $inSortType = NULL)
	{
		$this->db->select('*');
		$this->db->from('contact_us');
		if($inSortId)$this->db->order_by($inSortId, $inSortType); 
		$this->db->limit($inLimit, $inStart);
		$this->db->order_by('cu_id', 'desc');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	/**
	* 刪除資料
	**/
	public function deleteList($inId)
	{
		$this->db->where('cu_id', $inId);
		$this->db->delete('contact_us');

		if ($this->db->affected_rows() > 0) {
			return "SUCCESS";
		} else {
			return "FAIL";
		}
	}
}
?>