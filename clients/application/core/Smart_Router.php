<?php
class Smart_Router extends CI_Router {

    //put your code here
    public function __construct($routing = NULL) {
        parent::__construct($routing);
		$this->_set_default_controller();
    }

    protected function _set_default_controller() {
    if (empty($this->default_controller)) {
        show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
    }
    // Is the method being specified?
    if (sscanf($this->default_controller, '%[^/]/%[^/]/%s', $directory, $class, $method) !== 3) {
        $method = 'index';
    }
	$CI =& load_class('Session','libraries/Session');
	$session = $CI->userdata('hiapp_teknisi');
	//$this->directory = "kurir/";
	$directory = $this->directory;
	$class = empty($this->class)?$this->default_controller:$this->class;
	$method = $this->method;
		
	if(!empty($directory))
	{
			
		if((!isset($session['id']) || empty($session['id'])) &&  $class!='login')
		{
			//$class = 'login';
		}
	}
    if (is_dir(APPPATH . 'controllers' . DIRECTORY_SEPARATOR . $directory) === true) {
        if (!file_exists(APPPATH . 'controllers' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . ucfirst($class) . '.php')) {
            // This will trigger 404 later
            return;
        }
        $this->set_directory($directory);
        $this->set_class($class);
        $this->set_method($method);
    } else {
        if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2) {
            $method = 'index';
        }
        if (!file_exists(APPPATH . 'controllers' . DIRECTORY_SEPARATOR . ucfirst($class) . '.php')) {
            // This will trigger 404 later
            return;
        }
        $this->set_class($class);
        $this->set_method($method);
    }
    // Assign routed segments, index starting from 1
	$this->uri->rsegments[1] = $class;
	$this->uri->rsegments[2] = $method;
    log_message('debug', 'No URI present. Default controller set.');
   }

}
