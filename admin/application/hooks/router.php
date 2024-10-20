<?php
if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
 
class Router{
     
    private static $_format = '';
    public function config() {
		include_once(BASEPATH.'core/Controller.php');
		$cici=new CI_Controller();
		print_r(get_class_methods($CI));
		exit;
		$session = $CI->session->userdata('inipasar_auth');
		if(isset($session['id']) && !empty($session['id']) && $session['level']==2)
		{
			echo "a";
			$CI->router->set_directory('kurir/');
		}
		//print_r(get_class_methods($CI->router));
	}
}