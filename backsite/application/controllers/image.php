<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller
{
	private $message;
	private $currentPage = 0;

	function __construct()
	{
		parent::__construct();
		$this->load->model(Array('image_model', 'check_session_model'));
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
			//新增圖片
			case 1:
				echo json_encode($this->addImage());
				exit();
			break;
			//刪除圖片
			case 2:
				echo json_encode($this->image_model->deleteList($id));
				exit();
			break;
			//編輯圖片
			case 3:
				echo json_encode($this->image_model->updateList($id, $this->input->post(NULL, TRUE)));
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

		$result['result'] = $this->image_model->getListContent($start, $limit, $sortId, $sort);
		$this->view_page($result);
	}

	/**
	* 取得分頁資料
	**/
	private function getPage()
	{
		if($this->input->get("search"))
		{	
			$count = $this->image_model->getListBasicForSearch($this->input->get("search"));
		}else{
			$count = $this->image_model->getListBasic();
		}
		$tempArray = Array(
			'totalPage' => ceil($count / $this->session->userdata('row_limit')),
			'currentPage' => $this->currentPage
		);
		echo json_encode($tempArray);
	}

	/**
	 * 新增圖片
	 */
	private function addImage()
	{
		$result = array();
		$config['upload_path'] = './../uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '1000';
		$config['max_width']  = '2048';
		$config['max_height']  = '1536';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_multi_upload('mp_image'))
		{
			$error = array('error' => $this->upload->display_errors());

			$result['message'] = $error;
			$result['status'] = 'FAIL';
		}
		else
		{
			$data = $this->upload->get_multi_upload_data();
			$this->load->library('image_lib');

			foreach ($data as $key => $value) {
				//縮圖
				$config['image_library'] = 'gd2';
				$config['source_image']	= $value['full_path'];
				$config['new_image']	= $value['file_path']. 'thumb/'. $value['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width']	 = 75;
				$config['height']	= 50;
				 
				$this->image_lib->initialize($config);
				if ( ! $this->image_lib->resize())
				{
					echo $this->image_lib->display_errors();
				}
			}

			$result['message'] = $data;
			$result['status'] = 'SUCCESS';
		}
		
		$result['status'] = $this->image_model->addList($this->input->post(NULL, TRUE), $data);

		return $result;
	}

	/**
	* 顯示頁面
	**/
	private function view_page($inData)
	{
		$inData["lang"] = $this->lang;
		$inData["message"] = $this->message;
		$inData["category"] = $this->image_model->getCategory();

		$this->load->view('header');
		$this->load->view('navbar', $inData);
		$this->load->view('image', $inData);
		$this->load->view('footer');
	}
}