<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller
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
			//新增資料
			case 1:
				if($this->input->post('captcha') == $this->session->userdata('captcha'))
				{
					echo json_encode($this->contact_us_model->add($this->input->post(NULL, TRUE)));
				}else{
					echo json_encode(array('status' => 0,'errorMessage' => '驗証碼錯誤'), JSON_FORCE_OBJECT);
				}
				exit();
			break;
			//分頁資料
			case 4:
				$this->getPage();
			break;
			default:
				$data['captcha'] = $this->captcha_img();

				$this->view_page($data);
			break;
		}
	}
	
	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		$count = $this->photo_model->getListBasic();
		
		$tempArray = Array(
			'totalPage' => ceil($count / 16),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}
	
	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{

		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('contact_us', $inData);
		$this->load->view('footer');
	}

	/**
	 * 驗証器
	 * @return string html img
	 */
	private function captcha_img()
    {
        $pool = '0123456789';
        $word = '';
        for ($i = 0; $i < 4; $i++){
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        $this->session->set_userdata('captcha', $word);
        $vals = array(
            'word'  => $word,
            'img_path'  => './captcha/',
            'img_url'  => './captcha/',
            'expiration' => 1200
            );
        $cap = create_captcha($vals);
        return $cap['image'];
    }
}