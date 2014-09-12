<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test2 extends CI_Controller
{
	var $message;

	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('image_model', 'check_session_model'));
		$this->load->helper('url');
		
		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{	
		$this->view_page();
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page()
	{
		$this->load->view('test');
	}
}