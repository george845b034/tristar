<?php
class customer_detail_model extends CI_Model
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
		$this->db->from('customer');
		$query = $this->db->get();
		
		return count($query->result_array());
	}
	
	/**
	* 取得資料 給select用
	**/
	public function getListContent($inStart, $inLimit, $inSortId = NULL, $inSortType = NULL)
	{
		$this->db->select('*');
		$this->db->from('customer');
		if($inSortId)$this->db->order_by($inSortId, $inSortType); 
		$this->db->limit($inLimit, $inStart);
		$query = $this->db->get();
		
		// $this->db->select('Kalix2.ph_Companies.CompanyName');
		// $this->db->where('Kalix2.ph_Companies.Cust_ID', $custid);
		// $this->db->select_sum('Asterisk.cdr.call_length_billable')->from('Asterisk.cdr');
		// $this->db->group_by('Asterisk.cdr.CompanyName');
		// $this->db->join('Kalix2.ph_Companies', 'Kalix2.ph_Companies.CompanyName = Asterisk.cdr.CompanyName');
		
		return $query->result_array();
	}
	
	/**
	* 取得資料 欲更新用
	**/
	public function getListById($inId)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $inId);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 取得資料 個案列表
	**/
	public function getProjectListById($inId)
	{
		$this->db->select('*');
		$this->db->from('customer_and_project_group');
		$this->db->where('c_id', $inId);
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
		$this->db->join('customer_and_project_group', 'customer.id = customer_and_project_group.c_id');
		$this->db->like('name', $searchString);
		$this->db->or_like('title', $searchString); 
		$this->db->or_like('phone1', $searchString); 
		$this->db->or_like('ca_company', $searchString); 
		$this->db->limit($inStart, $inLimit);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/**
	* 更新資料
	**/
	public function updateList($inId, $inData)
	{	
		$data = array();
		$dataBatch = array();
		
		//處理個案列表
		$this->db->where('c_id', $inId);
		$this->db->delete('customer_and_project_group');
		
		foreach($inData as $key => $value)
		{
			if($key == 'type' || $key == 'id' || $key == 'annual' 
				|| $key == 'department' || $key == 'designer' 
				|| $key == 'company')continue;
			$data[$key] = $value;
		}
		
		$this->db->update('customer', $data, "id = ". $inId);
		
		//處理個案列表
		$i = 0;
		if(array_key_exists('annual', $inData))
		{
			foreach($inData["annual"] as $key => $value)
			{
				$dataBatch[$i] = array(
					'c_id' => $inId,
					'ca_annual' => $inData["annual"][$i],
					'ca_department' => $inData["department"][$i],
					'ca_designer' => $inData["designer"][$i],
					'ca_company' => $inData["company"][$i]
				);
				$i++;
			}
			$this->db->insert_batch('customer_and_project_group', $dataBatch);
		}
		
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
		$data = array();
		$dataBatch = array();
		
		//處理個案列表
		$this->db->where('c_id', $inData["id"]);
		$this->db->delete('customer_and_project_group');
		
		foreach($inData as $key => $value)
		{
			if($key == 'type' || $key == 'id' || $key == 'annual' 
				|| $key == 'department' || $key == 'designer' 
				|| $key == 'company')continue;
				
			$data[$key] = $value;
		}
		$this->db->insert('customer', $data);
		
		//處理個案列表
		$i = 0;
		if(array_key_exists('annual', $inData))
		{
			foreach($inData["annual"] as $key => $value)
			{
				$dataBatch[$i] = array(
					'c_id' => $this->db->insert_id(),
					'ca_annual' => $inData["annual"][$i],
					'ca_department' => $inData["department"][$i],
					'ca_designer' => $inData["designer"][$i],
					'ca_company' => $inData["company"][$i]
				);
				$i++;
			}
			$this->db->insert_batch('customer_and_project_group', $dataBatch);
		}
		
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
		//處理個案列表
		$this->db->where('c_id', $inId);
		$this->db->delete('customer_and_project_group');
		
		$this->db->where('id', $inId);
		$this->db->delete('customer');
		
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
		$this->db->from('category');
		$query = $this->db->get();
		$row = $query->result_array();
		
		foreach($row as $value)
		{
			$tempArray[$value['c_id']] = $value['c_name'];
		}
		return $tempArray;
	}
	
}
?>