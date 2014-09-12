<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Controller
{
	private $currentPage = 0;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('customer_model', 'check_session_model'));
		$this->load->helper('url');
		$this->check_session_model->checkSession();
		
		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{
		//分頁的資料
		$this->currentPage = ($this->input->get("currentPage"))?$this->input->get("currentPage"):1;
		//ajax傳來的資料
		$type = $this->input->post("type");
		$id = $this->input->post("id");
		$value = $this->input->post("value");
		
		switch($type)
		{
			//更新資料
			case 1:
				if(!$this->input->post(NULL, TRUE))return false;
				if(!$id)return false;
				$this->save($id, $this->input->post(NULL, TRUE));
			break;
			//刪除資料
			case 2:
				if(!$id)return false;
				$this->delete($id);
			break;
			//新增資料
			case 3:
				if(!$this->input->post(NULL, TRUE))return false;
				$this->add();
			break;
			//分頁資料
			case 4:
				$this->getPage();
			break;
			//取得欲更新的資料
			case 5:
				if(!$id)return false;
				$this->getUpdateData($id);
			break;
			default:
				$this->getList();
			break;
		}
	}
	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		if($this->input->get("search"))
		{	
			$count = $this->customer_model->getListBasicForSearch($this->input->get("search"));
		}else{
			$count = $this->customer_model->getListBasic();
		}
		$tempArray = Array(
			'totalPage' => ceil($count / $this->session->userdata('row_limit')),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}
	
	/**
	* 取得欲更新的資料
	**/
	private function getUpdateData($inId)
	{
		$result = $this->customer_model->getUpdateData($inId);
		echo json_encode($result);
	}
	
	/**
	* 取得資料
	**/
	private function getList()
	{
		$limit = $this->session->userdata('row_limit');
		$start = (($this->currentPage - 1) * $this->session->userdata('row_limit'));
		$sortId = null;
		$sort = null;
		if($this->input->get("search"))
		{
			$data["result"] = $this->customer_model->getListSearch($this->input->get("search"), $start, $limit);
		}else{
			$data["result"] = $this->customer_model->getListContent($start, $limit, $sortId, $sort);
		}
		$data["category"] = $this->customer_model->getCategory();
		$data["lang"] = $this->lang;
		$this->view_page($data);
	}
	
	/**
	* 新增資料
	**/
	private function add()
	{
		$result = $this->customer_model->addList($this->input->post(NULL, TRUE));
		
		echo json_encode($result);
	}
	
	/**
	* 更新資料
	**/
	private function save($inId, $inValue)
	{
		$result = $this->customer_model->updateList($inId, $inValue);
		
		echo json_encode($result);
	}
	
	/**
	* 刪除資料
	**/
	private function delete($inId)
	{
		$id = $this->input->post('id');
		$result = $this->customer_model->deleteList($id);
		
		echo json_encode($result);
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{
		//是否顯示搜尋
		$inData["is_display"] = true;
		
		$this->load->view('header', $inData);
		$this->load->view('navbar', $inData);
		$this->load->view('search_bar', $inData);
		$this->load->view('customer', $inData);
		$this->load->view('footer');
	}
}