<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		$this->lang->load('main_chinese', 'chinese');
	}
	
	public function index()
	{
		//確認權限
		
		//縮圖
		/* $config['image_library'] = 'gd2';
		$config['source_image']	= './uploads/Desert.jpg';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 75;
		$config['height']	= 50;
		
		$this->load->library('image_lib', $config); 

		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		} */
		
		
		$this->view_page();
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page()
	{
		$data["lang"] = $this->lang;
		
		$this->load->view('header');
		$this->load->view('navbar', $data);
		$this->load->view('index');
		$this->load->view('footer');
	}
}