<?php

class Home extends MY_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('Home');
	}
}