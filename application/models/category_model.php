<?php
class category_model extends CI_Model
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
		$this->db->from('category');
		$query = $this->db->get();
		
		return count($query->result_array());
	}
	
	/**
	* 取得資料 給select用
	**/
	public function getListContent($inStart, $inLimit, $inSortId = NULL, $inSortType = NULL)
	{
		$this->db->select('*');
		$this->db->from('category');
		if($inSortId)$this->db->order_by($inSortId, $inSortType); 
		$this->db->limit($inLimit, $inStart);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 取得Search後的資料
	**/
	public function getListSearch($searchOper, $searchField, $searchString, $inStart, $inLimit)
	{
		$tempObject = new temp_object;
		$table = 'product.';
		$condition = $tempObject->dbCondition($table, $searchOper, $searchField, $searchString);
		
		$this->db->select('d_id, d_title, d_content, d_material, d_image, p_name, d_serialize');
		$this->db->from('product');
		$this->db->join('product_category', 'product.d_category = product_category.p_id');
		$this->db->where($condition, NULL, FALSE);
		$this->db->limit($inStart, $inLimit);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 更新資料
	**/
	public function updateList($inId, $inData)
	{	
		$data = array(
		   'c_name' => $inData['value']
		);
		$this->db->update('category', $data, "c_id = ". $inId);
		
		if ($this->db->affected_rows() > 0) {
			return "SUCCESS";
		} else {
			return "FAIL";
		}
	}
	
	/**
	* 新增資料
	**/
	public function addList($inData)
	{
		
		$data = array(
		   'c_name' => $inData['value']
		);

		$this->db->insert('category', $data);
		if ($this->db->affected_rows() > 0) {
			return "SUCCESS";
		} else {
			return "FAIL";
		}
	}
	
	/**
	* 刪除資料
	**/
	public function deleteList($inId)
	{
		$this->db->where('c_id', $inId);
		$this->db->delete('category');
		
		if ($this->db->affected_rows() > 0) {
			return "SUCCESS";
		} else {
			return "FAIL";
		}
	}
	
	/**
	* 清除圖片
	**/
	public function clearPicture($inId, $inData)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where("d_id = ". $inId, NULL, FALSE);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			$tempArray = explode(",", $row[$inData['key']]);
			$replaceArray = str_replace($inData['name'], "", $tempArray);
			//刪除空值的陣列
			if(($key = array_search("", $replaceArray)) !== false)
			{
				unset($replaceArray[$key]);
			}
		   
			$replaceWord = implode(",", $replaceArray);
		}
		// return $replaceWord;
		$data = array(
		   $inData['key'] => $replaceWord
		);
		
		
		$this->db->update('product', $data, "d_id = ". $inId);
		
		if ($this->db->affected_rows() > 0) {
			return $replaceWord;
		} else {
			return "FAIL";
		}
	}
	
	/**
	* 取得系列
	**/
	public function getSerialize()
	{
		$tempArray = Array();
		$this->db->select('*');
		$this->db->from('product_serialize');
		$this->db->join('product_main_serialize', 'product_serialize.s_main_title = product_main_serialize.id');
		$query = $this->db->get();
		$row = $query->result_array();
		
		foreach($row as $value)
		{
			$tempArray[$value['s_id']] = $value['title'] ."-". $value['s_title'];
		}
		return $tempArray;
	}
	
	/**
	* 取得系列資料
	**/
	public function getSerializeData($inIdArray)
	{
		$tempArray = Array();
		$this->db->where_in('s_id', $inIdArray);
		$query = $this->db->get('product_serialize');
		$row = $query->result_array();
		
		foreach($row as $value)
		{
			$newName = explode("<br/>", $value['s_title']);
			array_push($tempArray, $newName[0]);
		}
		
		return $tempArray;
	}
	
	/**
	* 取得類別
	**/
	public function getCategory()
	{
		$tempArray = Array();
		$this->db->select('*');
		$this->db->from('product_category');
		$query = $this->db->get();
		$row = $query->result_array();
		
		foreach($row as $value)
		{
			$tempArray[$value['p_id']] = $value['p_name'];
		}
		return $tempArray;
	}
	
}
?>