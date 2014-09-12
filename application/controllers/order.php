<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{
	private $currentPage = 0;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('contact_us_model', 'check_session_model'));
		$this->load->helper(array('url', 'captcha'));
		$this->check_session_model->checkSession();

		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{
		$data = array();
		//分頁的資料
		$this->currentPage = ($this->input->get("currentPage"))?$this->input->get("currentPage"):1;
		//ajax傳來的資料
		$type = $this->input->post("type");
		$id = $this->input->post("id");
		$value = $this->input->post("value");
		
		switch($type)
		{
			default:
				$this->view_page($data);
			break;
		}
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{

		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('order', $inData);
		$this->load->view('footer');
	}

}