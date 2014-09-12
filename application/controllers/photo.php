<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller
{
	private $currentPage = 0;
	private $mp_type = 1;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('photo_model', 'check_session_model'));
		$this->load->helper('url');
		$this->check_session_model->checkSession();
		
		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{
		//分頁的資料
		$this->currentPage = ($this->input->get("currentPage"))?$this->input->get("currentPage"):1;
		$this->mp_type = ($this->input->get("mp_type"))?$this->input->get("mp_type"):1;
		//ajax傳來的資料
		$type = $this->input->post("type");
		$id = $this->input->post("id");
		$value = $this->input->post("value");
		
		switch($type)
		{
			//分頁資料
			case 4:
				$this->getPage();
			break;
			default:
				$this->view_page();
			break;
		}
	}
	
	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		$count = $this->photo_model->getListBasic($this->mp_type);
		
		$tempArray = Array(
			'totalPage' => ceil($count / 16),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page()
	{
		$limit = $this->session->userdata('row_limit');
		$start = (($this->currentPage - 1) * $this->session->userdata('row_limit'));
		$sortId = null;
		$sort = null;

		$data["category"] = $this->photo_model->getCategory();
		$data["result"] = $this->photo_model->getListContent($this->mp_type, $start, $limit, $sortId, $sort);
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('photo', $data);
		$this->load->view('footer');
	}
}