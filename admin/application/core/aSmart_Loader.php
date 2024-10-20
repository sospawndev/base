<?php

class Smart_Loader extends CI_Loader {

    public function __construct() {

        $this->_ci_ob_level  = ob_get_level();
		$CI =& load_class('Session','libraries/Session');
		$session = $CI->userdata('inipasar_auth');
		$CS =& get_instance();
		if(isset($session['id']) && !empty($session['id']) && $session['level']==2 )
		{
			$this->_ci_view_paths = array(
				APPPATH . 'views/manager/management/' => TRUE
			);
		}
        log_message('debug', "Loader Class Initialized");
    }
}