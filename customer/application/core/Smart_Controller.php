<?php
class Smart_Controller extends CI_Controller
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
		$class = $this->router->fetch_class();
		#phone
		/*if($class!='profile' && !empty($ses))
		{
			$phone_verification = user_balance("phone_verification");
			 
			if($phone_verification==0)
			{
				redirect('otp/verify');
				return;	
			}
		}*/
		if($class=='withdraws' && !empty($ses))
		{
			$phone_verification = user_balance("phone_verification");
			 
			if($phone_verification==0)
			{
				redirect('otp/verify');
				return;	
			}
		}
		#phone
		//insert_fcm();
		
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