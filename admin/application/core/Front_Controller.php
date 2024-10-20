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
		$ses = $this->session->userdata('customermeong_login');
		 
		 
		//insert_fcm();
		$class = $this->router->fetch_class();
		if($class=='login' && !empty($ses))
		{
			redirect('plg/home');
			return;
		}
		if(empty($ses))
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('customermeong_login');
			//header("location:../../../");
			redirect('plg/login');
			return;
		}
	}
}