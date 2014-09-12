<?php
class login_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 檢查帳號密碼
	**/
	public function checkUser($inUserName, $inPassword)
	{
		if(!empty($inUserName) && !empty($inPassword))
		{
			$tempPower = array();
			$where = array('m_account' => $inUserName, 'm_password' => md5($inPassword));
			
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where($where);
			$query = $this->db->get();
			$result = $query->row_array();

			if ($query->num_rows() > 0)
			{
				$this->session->set_userdata("is_login", true);
				$this->session->set_userdata("language", 'chinese');
				$this->session->set_userdata("username", $result['m_account']);
				return true;
			}else{
				$this->session->set_userdata("is_login", false);
				return false;
			}
		}
	}
}
?>