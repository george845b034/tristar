<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	private $currentPage = 0;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('category_model', 'check_session_model'));
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
				if(!$id)return false;
				if(!$value)return false;
				$this->save($id, $value);
			break;
			//刪除資料
			case 2:
				if(!$id)return false;
				$this->delete($id);
			break;
			//新增資料
			case 3:
				if(!$value)return false;
				$this->add($value);
			break;
			//分頁資料
			case 4:
				$this->getPage();
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
		$count = $this->category_model->getListBasic();
		$tempArray = Array(
			'totalPage' => ceil($count / $this->session->userdata('row_limit')),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
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
		$data["result"] = $this->category_model->getListContent($start, $limit, $sortId, $sort);
		$data["lang"] = $this->lang;
		$this->view_page($data);
	}
	
	/**
	* 新增資料
	**/
	private function add($inValue)
	{
		$result = $this->category_model->addList($this->input->post(NULL, TRUE));
		
		echo json_encode($result);
	}
	
	/**
	* 更新資料
	**/
	private function save($inId, $inValue)
	{
		$id = $this->input->post('id');
		$result = $this->category_model->updateList($id, $this->input->post(NULL, TRUE));
		
		echo json_encode($result);
	}
	
	/**
	* 刪除資料
	**/
	private function delete($inId)
	{
		$id = $this->input->post('id');
		$result = $this->category_model->deleteList($id);
		
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
		$this->load->view('category', $inData);
		$this->load->view('footer');
	}
}