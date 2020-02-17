<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

	function __construct()
	{
		parent::__construct();     
	}

	Public function upload_post()
	{

		
		if(!empty($_FILES['files']['name'])){
			$count = count($_FILES['files']['name']);

			for($i=0;$i<$count;$i++){

				if(!empty($_FILES['files']['name'][$i])){

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = 'uploads/'; 
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = '5000';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload',$config); 

					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
						$file_name = $uploadData['file_name'];
						$insert_data = array('file_name' =>$file_name);
						$this->db->insert('file',$insert_data);	

						/* Setting files count for the response */
						if($count > 1 ){
							$total = $count.' Files';
						}else{
							$total = $count.' File';
						}
						$data = array(
							'status' => TRUE,
							'message' => $total.' uploaded successfully! '
						);

					}else{
						$data = array(
							'status' => TRUE,
							'message' => $this->upload->display_errors()
						);

					}
				}

			}
			

		}else{
			$data = array(
				'status' => TRUE,
				'message' => 'Must upload atleast one file to upload!'
			);
		}
		
		$this->response($data, REST_Controller::HTTP_OK);
	}
}