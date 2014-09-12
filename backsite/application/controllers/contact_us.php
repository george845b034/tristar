<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller
{
	private $message;
	private $currentPage = 0;

	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('contact_us_model', 'check_session_model'));
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
		switch ($type) {
			//刪除資料
			case 2:
				echo json_encode($this->contact_us_model->deleteList($id));
				exit();
			break;
			//分頁
			case 4:
				$this->getPage();
				exit();
			break;
			
			default:
				$this->getList();
			break;
		}
	}
	
	private function getList()
	{
		$limit = $this->session->userdata('row_limit');
		$start = (($this->currentPage - 1) * $this->session->userdata('row_limit'));
		$sortId = null;
		$sort = null;

		$result['result'] = $this->contact_us_model->getListContent($start, $limit, $sortId, $sort);
		$this->view_page($result);
	}

	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		$count = $this->contact_us_model->getListBasic();
		
		$tempArray = Array(
			'totalPage' => ceil($count / $this->session->userdata('row_limit')),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}

	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{
		$inData["lang"] = $this->lang;
		$inData["message"] = $this->message;
		// $inData["category"] = $this->contact_us_model->getCategory();

		$this->load->view('header');
		$this->load->view('navbar', $inData);
		$this->load->view('contact_us', $inData);
		$this->load->view('footer');
	}
}