<?php
class photo_model extends CI_Model
{
	public $row_result;

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 取得資料 給分頁用
	**/
	public function getListBasic($inType)
	{
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('mp_type', $inType);
		$query = $this->db->get();
		
		return count($query->result_array());
	}

	/**
	* 取得資料 給select用
	**/
	public function getListContent($inType, $inStart, $inLimit, $inSortId = NULL, $inSortType = NULL)
	{
		
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('mp_type', $inType);
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * 取得類別
	 * @return array 
	 */
	public function getCategory()
	{
		$tempArray = Array();
		$this->db->select('*');
		$this->db->from('images_type');
		$query = $this->db->get();
		$row = $query->result_array();
		
		foreach($row as $value)
		{
			$tempArray[$value['it_id']] = $value['it_name'];
		}
		return $tempArray;
	}
}
?>