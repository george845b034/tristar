<?php
class image_model extends CI_Model
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
		$this->db->from('images');
		$query = $this->db->get();
		
		return count($query->result_array());
	}
	
	/**
	* 取得資料 給分頁用for search
	**/
	public function getListBasicForSearch($searchString)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('customer_and_project_group', 'customer.id = customer_and_project_group.c_id', 'left');
		$this->db->join('category', 'customer.category = category.c_id');
		$this->db->like('name', $searchString);
		$this->db->or_like('title', $searchString); 
		$this->db->or_like('phone1', $searchString); 
		$this->db->or_like('ca_company', $searchString); 
		$this->db->or_like('c_name', $searchString); 
		$this->db->group_by('customer.id');
		$query = $this->db->get();
		
		return count($query->result_array());
	}
	
	/**
	* 取得資料 給select用
	**/
	public function getListContent($inStart, $inLimit, $inSortId = NULL, $inSortType = NULL)
	{
		$this->db->select('*');
		$this->db->from('images');
		$this->db->join('images_type', 'mp_type = it_id');
		if($inSortId)$this->db->order_by($inSortId, $inSortType); 
		$this->db->limit($inLimit, $inStart);
		$this->db->order_by('mp_id', 'desc');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	/**
	* 取得資料 欲更新用
	**/
	public function getUpdateData($inId)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $inId);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 取得Search後的資料
	**/
	public function getListSearch($searchString, $inStart, $inLimit)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('customer_and_project_group', 'customer.id = customer_and_project_group.c_id', 'left');
		$this->db->join('category', 'customer.category = category.c_id');
		$this->db->like('name', $searchString);
		$this->db->or_like('title', $searchString); 
		$this->db->or_like('phone1', $searchString); 
		$this->db->or_like('ca_company', $searchString);  
		$this->db->or_like('c_name', $searchString); 
		$this->db->group_by('customer.id'); 
		$this->db->limit($inLimit, $inStart);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 更新資料
	**/
	public function updateList($inId, $inData)
	{	
		$data = array();
		foreach($inData as $key => $value)
		{
			if($key == 'type' || $key == 'id')continue;
			$data[$key] = $value;
		}
		
		$this->db->update('images', $data, "mp_id = ". $inId);
		
		if ($this->db->affected_rows() >= 0) {
			return "SUCCESS";
		} else {
			return "FAIL";
		}
	}
	
	/**
	* 新增資料
	**/
	public function addList($inData, $inImageData)
	{
		$data = array();
		$imageData = array();
		foreach ($inImageData as $key => $value) {
			array_push($imageData, $value['file_name']);
		}
		$data['mp_image'] = json_encode($imageData);
		foreach($inData as $key => $value)
		{
			if($key == 'type' || $key == 'id')continue;
			$data[$key] = $value;
		}
		
		$this->db->insert('images', $data);
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
		$this->db->where('mp_id', $inId);
		$this->db->delete('images');

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
	 * @return array result
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