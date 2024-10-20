<?php
class front_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->encryption->initialize(array('driver' => 'openssl'));
		
		$this->checkauth();
		
	}
	private  function checkauth()
	{
		$ses = $this->session->userdata('trashadmin_login');
		 
		 
		//insert_fcm();
		$class = $this->router->fetch_class();
		if($class=='login' && !empty($ses))
		{
			redirect('home');
			return;
		}
		if(empty($ses))
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('trashadmin_login');
			redirect('login');
			return;
		}
	}
}