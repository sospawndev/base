<?php
class Wa_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->encryption->initialize(array('driver' => 'openssl'));
		
		$this->checkauth();
		
	}
	private  function checkauth()
	{
		
		$ses = $this->session->userdata('sospawn_customer');
		 
		if(check_proxy())
		{
			redirect('page-error/vpns');
			return;
		}
		//insert_fcm();
		$class = $this->router->fetch_class();
		if($class=='login' && !empty($ses))
		{
			if(isset($ses['status']))
			{
				if($ses['status']!=1)
				{
					$this->session->unset_userdata('sospawn_customer');
					redirect('login');
					return;
				}
			}
			redirect('home');
			return;
		}
		if(empty($ses))
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('sospawn_customer');
			redirect('login');
			return;
		}
	}
}