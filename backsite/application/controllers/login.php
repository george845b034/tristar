<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller
{
	private $currentPage = 0;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('login_model', 'check_session_model'));
		$this->load->helper('url');
		
		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{
		//ajax傳來的資料
		$type = $this->input->post("type");
		$id = $this->input->post("id");
		$password = $this->input->post("password");
		
		switch($type)
		{
			//檢查login
			case 1:
				if(!$id)return false;
				if(!$password)return false;
				echo json_encode($this->login_model->checkUser($id, $password));
				exit();
			break;
			default:
				$this->view_page();
			break;
		}
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page()
	{
		//是否顯示搜尋
		$data["is_display"] = false;
		$data["is_login"] = false;
		$data["lang"] = $this->lang;
		$data["view_name"] = '';
		
		$this->load->view('header');
		$this->load->view('navbar', $data);
		$this->load->view('search_bar', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}
}