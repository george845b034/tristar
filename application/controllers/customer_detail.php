<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_detail extends CI_Controller
{
	private $currentPage = 0;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('customer_detail_model', 'check_session_model'));
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
				exit();
			break;
			//刪除資料
			case 2:
				if(!$id)return false;
				$this->delete($id);
				exit();
			break;
			//新增資料
			case 3:
				if(!$this->input->post(NULL, TRUE))return false;
				$this->add();
				exit();
			break;
			//分頁資料
			case 4:
				$this->getPage();
			break;
			default:
				if(!$this->input->get("id"))
				{
					$this->getList();
				}else{
					$this->getListById($this->input->get("id"));
				}
			break;
		}
	}
	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		$count = $this->customer_detail_model->getListBasic();
		$tempArray = Array(
			'totalPage' => ceil($count / $this->session->userdata('row_limit')),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}
	
	/**
	* 取得欲更新的資料
	**/
	private function getListById($inId)
	{
		$data["result"] = $this->customer_detail_model->getListById($inId);
		$data["projectList"] = $this->customer_detail_model->getProjectListById($inId);
		$data["category"] = $this->customer_detail_model->getCategory();
		$data["lang"] = $this->lang;
		$this->view_page($data);
	}
	
	/**
	* 取得資料
	**/
	private function getList()
	{
		$data["result"] = array();
		$data["projectList"] = array();
		$data["category"] = $this->customer_detail_model->getCategory();
		$data["lang"] = $this->lang;
		$this->view_page($data);
	}
	
	/**
	* 新增資料
	**/
	private function add()
	{
		$result = $this->customer_detail_model->addList($this->input->post(NULL, TRUE));
		
		echo json_encode($result);
	}
	
	/**
	* 更新資料
	**/
	private function save($inId, $inValue)
	{
		$result = $this->customer_detail_model->updateList($inId, $inValue);
		
		echo json_encode($result);
	}
	
	/**
	* 刪除資料
	**/
	private function delete($inId)
	{
		$id = $this->input->post('id');
		$result = $this->customer_detail_model->deleteList($id);
		
		echo json_encode($result);
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{
		//是否顯示搜尋
		$data["is_display"] = false;
		
		$this->load->view('header', $data);
		$this->load->view('navbar', $inData);
		$this->load->view('search_bar', $data);
		$this->load->view('customer_detail', $inData);
		$this->load->view('footer');
	}
}