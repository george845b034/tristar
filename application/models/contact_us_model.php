<?php
class contact_us_model extends CI_Model
{
	public $row_result;

    function __construct()
    {
        parent::__construct();
    }
	
	/**
	* 新增資料
	**/
	public function add($inData)
	{
		$data = array();
		$result = array();
		$data['cu_ip'] = $_SERVER["REMOTE_ADDR"];
		foreach($inData as $key => $value)
		{
			if($key == 'cu_name' || $key == 'cu_mail' || $key == 'cu_title' || $key == 'cu_message')
			{
				$data[$key] = $value;
			}
		}
		$this->db->insert('contact_us', $data);
		
		if ($this->db->affected_rows() > 0) {
			$result['status'] = 1;
			$result['message'] = '留言完畢';
		} else {
			$result['status'] = 0;
			$result['errorMessage'] = '無法留言';
		}
		return $result;
	}
	
}
?>