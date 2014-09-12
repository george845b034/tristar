<?php
class check_session_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 檢查基本資料
	**/
	public function checkSession()
	{
		$this->session->set_userdata("row_limit", 10);
		
		$is_login = $this->session->userdata('is_login');
		if(!$is_login)
		{
			redirect(site_url('login'), 'refresh');
			// header("Location: " . site_url('login'));
			exit();
		}
	}
}
?>