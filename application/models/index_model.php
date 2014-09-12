<?php
class index_model extends CI_Model
{
	public $row_result;

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 取得資料 for index data all
	**/
	public function getListAll()
	{
		$this->db->select('*');
		$this->db->from('images');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
}
?>