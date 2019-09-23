<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

	function __construct()
	{
		parent::__construct();     
	}


    // Vaidating the user 
	Public function users_get()
	{
		$data = array(
			'status' => TRUE,
			'message' => 'Its working '
		);
		$this->response($data, REST_Controller::HTTP_OK);
	}
}