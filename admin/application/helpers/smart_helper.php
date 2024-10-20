<?php
function json($output=array(),$security=false)
{
	if($security)
	{
		$output['security'] = token();
	}
	$CI =& get_instance();
	return $CI->output
	->set_status_header(200)
	->set_content_type('application/json','utf-8')
	->set_output(json_encode($output));
}
function token()
{
	$CI =& get_instance();
	return $CI->security->get_csrf_hash();
}
function user_info($key='')
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('adminsospawn_login');
	if(!is_array($ses) && !empty($ses))
	{
		$ses = (array) $ses;
	}
	$output = '';
	if(strpos($key,'.')!==false)
	{
		$ex = explode('.',$key);
		for($i=0;$i<count($ex);$i++)
		{
			if(is_numeric($ex[$i]))
				$ex[$i] = $ex[$i];
			else
				$ex[$i] = "'".$ex[$i]."'";
		}
		eval("\$output=isset(\$ses[".implode("][",$ex)."])?\$ses[".implode("][",$ex)."]:'';");
		return $output;
	}
	if(!empty($key) && isset($ses[$key]))
	{
		return $ses[$key];
	}
	elseif(empty($key) && !isset($ses[$key]))
	{
		return '';
	}
	elseif(empty($key))
	{
		return $ses;
	}
}
function user_front($key='')
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('customerdencity_login');
	if(!is_array($ses) && !empty($ses))
	{
		$ses = (array) $ses;
	}
	$output = '';
	if(strpos($key,'.')!==false)
	{
		$ex = explode('.',$key);
		for($i=0;$i<count($ex);$i++)
		{
			if(is_numeric($ex[$i]))
				$ex[$i] = $ex[$i];
			else
				$ex[$i] = "'".$ex[$i]."'";
		}
		eval("\$output=isset(\$ses[".implode("][",$ex)."])?\$ses[".implode("][",$ex)."]:'';");
		return $output;
	}
	if(!empty($key) && isset($ses[$key]))
	{
		return $ses[$key];
	}
	elseif(empty($key) && !isset($ses[$key]))
	{
		return '';
	}
	elseif(empty($key))
	{
		return $ses;
	}
}
 
function get_unique_file($name,$path='',$inc=0)
{
	$CI =& get_instance();
	if(empty($path))
	{
		$path = config_item('upload_path');
	}
	$t_name = url_title(pathinfo($name,PATHINFO_FILENAME));
	$t_ext  = pathinfo($name,PATHINFO_EXTENSION);
	$old_name = $name;
	$old_path = $path;
	if($inc>0)
	{
		$name = $t_name.'('.$inc.').'.$t_ext;
	}
	else
	{
		$name = $t_name.'.'.$t_ext;
	}
	if(file_exists($path.$name))
	{
		$name = get_unique_file($old_name,$old_path,$inc+1);
	}
	return $name;
}
function get_unique_file_manage($name,$path='',$inc=0)
{
	$CI =& get_instance();
	if(empty($path))
	{
		$path = config_item('tmp_image_path');
	}
	$t_name = url_title(pathinfo($name,PATHINFO_FILENAME));
	$t_ext  = pathinfo($name,PATHINFO_EXTENSION);
	$old_name = $name;
	$old_path = $path;
	if($inc>0)
	{
		$name = $t_name.'('.$inc.').'.$t_ext;
	}
	else
	{
		$name = $t_name.'.'.$t_ext;
	}
	if(file_exists($path.$name))
	{
		$name = get_unique_file_manage($old_name,$old_path,$inc+1);
	}
	return $name;
}
function getThumb($image,$width,$height,$path='')
{
	$CI =& get_instance();
	$CI->load->library('SmartThumb');
	$path = empty($path)?config_item('upload_path'):$path;
	$info = pathinfo($path.$image);
	if(!file_exists(config_item('cache_path').$info['filename'].'x'.$width.'x'.$height.'.'.$info['extension']))
	{
		$CI->smartthumb->PathImgOld = $path.$image;
		$CI->smartthumb->PathImgNew = config_item('cache_path').$info['filename'].'x'.$width.'x'.$height.'.'.$info['extension'];
		$CI->smartthumb->NewWidth = $width;
		$CI->smartthumb->NewHeight = $height;
		$CI->smartthumb->create_thumbnail_images();
	}
	return $info['filename'].'x'.$width.'x'.$height.'.'.$info['extension'];
}
function getCID($prefix,$id)
{
	$alpha = range('A','Z');
	if($id<100)
	{
		return $prefix.$alpha[0].$alpha[0].$alpha[0].(strlen($id)==1?'0'.$id:$id);
	}
	else
	{	
		$length = strlen($id);
		//get numeric
		$numeric = substr($id,$length-2,2);
		$id = substr($id,0,$length-2);
		$loop_length = strlen($id)>3?3:strlen($id);
		$al = '';
		for($i=0;$i<$loop_length;$i++)
		{
			$al = $al.($alpha[substr($id,$i,1)]);
		}
		$id = substr($id,strlen($al),strlen($id));
		$lt = 4-strlen($al);
		for($i=1;$i<=$lt;$i++)
		{
			$al = 'A'.$al;
		}
		$al = $prefix.substr($al,1,strlen($al));
		return $al.$id.$numeric;
	}
}
 
function getUserIP()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return $ip;
}
function get_unique_users_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('activation_code',$rand)->get('users');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function get_unique_vote_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',8);
	$rs = $CI->db->where('pid',$rand)->get('vote');
	if($rs->num_rows()>0)
	{
		return get_unique_vote_code();
	}
	return $rand;
}
function get_unique_promo_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',8);
	$rs = $CI->db->where('pid',$rand)->get('promo');
	if($rs->num_rows()>0)
	{
		return get_unique_promo_code();
	}
	return $rand;
}
function get_unique_order()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',15);
	$rand = "P-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('order');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function get_unique_customer_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('activation_code',$rand)->get('customer');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function sendmail($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<img src="//'.$_SERVER['SERVER_NAME'].'/uploads/'.config_item('logo').'" alt="'.config_item('site_name').' Activation User" />';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Activation Code :</strong> </td><td>" . strip_tags($in['activation_code']) . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($config);
    $CI->email->from(get_setting('email'), get_setting('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(get_setting('site_name').' Activation User');
    $CI->email->message($message);
    if($CI->email->send())
	{
		
	}
}
function send_mail_link($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Email:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($config);
    $CI->email->from(config_item('email'), config_item('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(config_item('site_name').' Link Confirmation');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
}
function send_mail_forgot($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Forgot:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($config);
    $CI->email->from(config_item('email'), config_item('site_name'));
    $CI->email->to($in['email']);
    $CI->email->subject(config_item('site_name').' Link Forgot');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
}
function email_config()
{
	/*$config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://srv127.niagahoster.com',
		'smtp_port' => 465,
		'smtp_user' => 'noreply@artsky.cloud',
		'smtp_pass' => '!Gatekbgt2',
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1'
	);
	*/	
	$config = Array(
		'protocol' => 'smtp',		'_smtp_auth' => true,		'wordwrap' => true,		'priority' =>3,
		'smtp_host' => 'ssl://smtp.zoho.com',
		'smtp_port' => 465,
		'smtp_user' => 'noreply@aleominingpool.com',//'info@aleominingpool.com',
		'smtp_pass' => 'WWe45$$#Ghhh',//'!Gatekbgt2',
		'mailtype'  => 'html', 
		'newline' => "\r\n",
		'charset'   => 'iso-8859-1'
	);
	 
	return $config;
}
function check_urls($url)
{
	//$url = 'yoururl';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (200==$retcode) {
        return true;
    } else {
		return false;
    }	
	return false;
}
function bulanall()
{
	$v = array("Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Des");
	return $v ;
}
function bulan_name($i = 0)
{
	$v = array("","Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Des");
	return isset($v[$i])?$v[$i]:"";
}
function bulan_name_long($i = 0)
{
	$v = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember");
	return isset($v[$i])?$v[$i]:"";
}
function get_urls($url)
{
	//$url = 'yoururl';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $resp = curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (200==$retcode) {
        return $resp;
    } 
	return "";
}
function post_curl($url,$send)
{
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'mozilla firefox',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $send/*array(
			item1 => 'value',
			item2 => 'value2'
		)*/
	));
	// Send the request & save response to $resp
	
	$resp = curl_exec($curl);
	$retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	// Close request to clear up some resources
	curl_close($curl);	
	//print_r($retcode);
	//exit;
	if (200==$retcode) {
        return $resp;
    } else {
		return false;
    }
	 
}

function getOS($userAgent) {
    // Create list of operating systems with operating system name as array key 
    $oses = array (
        'iPhone'            => '(iPhone)',
        'Windows 3.11'      => 'Win16',
        'Windows 95'        => '(Windows 95)|(Win95)|(Windows_95)',
        'Windows 98'        => '(Windows 98)|(Win98)',
        'Windows 2000'      => '(Windows NT 5.0)|(Windows 2000)',
        'Windows XP'        => '(Windows NT 5.1)|(Windows XP)',
        'Windows 2003'      => '(Windows NT 5.2)',
        'Windows Vista'     => '(Windows NT 6.0)|(Windows Vista)',
        'Windows 7'         => '(Windows NT 6.1)|(Windows 7)',
        'Windows NT 4.0'    => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        'Windows ME'        => 'Windows ME',
        'Open BSD'          => 'OpenBSD',
        'Sun OS'            => 'SunOS',
        'Linux'             => '(Linux)|(X11)',
        'Safari'            => '(Safari)',
        'Mac OS'            => '(Mac_PowerPC)|(Macintosh)',
        'QNX'               => 'QNX',
        'BeOS'              => 'BeOS',
        'OS/2'              => 'OS/2',
        'Search Bot'        => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
    );
    
    // Loop through $oses array
    foreach($oses as $os => $preg_pattern) {
        // Use regular expressions to check operating system type
        if ( preg_match('@' . $preg_pattern . '@', $userAgent) ) {
            // Operating system was matched so return $oses key
            return $os;
        }
    }
    
    // Cannot find operating system so return Unknown
    
    return 'n/a';
}
#setting
function order_read($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order')->num_rows();
}
function order_read_presale($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order')->num_rows();
}
#payment
function varpayment()
{
	$arr = array("Waiting","successful","Failed","PENDING","PROCESS","Rejected");
	return $arr;
}
function payments($no = "")
{
	$xx = varpayment();
	return isset($xx[$no])?$xx[$no]:"";		
}
function varcolorpayment()
{
	$arr = array("black","blue","red");	
	return $arr;
}
function colorpayments($no = "")
{
	$xx = varcolorpayment();
	return isset($xx[$no])?$xx[$no]:"";		
}
#pg_type
function varpg_type()
{
	$arr = array("Manual","Auto");	
	return $arr;
}
function pg_type($no = "")
{
	$xx = varpg_type();
	return isset($xx[$no])?$xx[$no]:"";		
}
function orderpersale_read($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('reads',0)->get('order_presale')->num_rows();
} 

function orderpresale_type($no = "")
{
	$xx = array("Blockchain","Bank Transfer");
	return isset($xx[$no])?$xx[$no]:"";		
}
function get_level($id_customer,$valuy = 0)
{
	$CI =& get_instance();
	$level_earn = array();
	//check high level first
	$sql = "
SELECT COUNT(m_customer.`id_level_earn`) AS total,m_customer.`id_level_earn` FROM m_customer where m_customer.refferal='".$id_customer."'  group by m_customer.`id_level_earn`";
	$highlevel = $CI->db->query($sql)->result_array();
	if(count($highlevel)>0)
	{
		for($i=0;$i<count($highlevel);$i++)
		{
			$csl = "SELECT * FROM `m_level_earn` WHERE id='".$highlevel[$i]['id_level_earn']."'";
			$cs = $CI->db->query($csl)->row_array();
			if(isset($cs['id']))
			{
				$csl = "SELECT * FROM `m_level_earn` WHERE lower(level_from_name)='".strtolower($cs['level'])."' and level_from<='".$highlevel[$i]['total']."'";
				$pp = $CI->db->query($csl)->row_array();
				if(isset($pp['id']))
				{
					$level_earn[$pp['id']][] = $pp; 
				}
			}
		}
	}
	// end check highlevel
	
	$sql = "select sum(m_buy.total_coin) as total,m_customer.id from m_buy inner join m_customer on(m_customer.id=m_buy.id_customer) where m_customer.refferal='".$id_customer."' group by m_customer.id";
	$arr = $CI->db->query($sql)->result_array();
	
	if(count($arr)>0)
	{
		for($i=0;$i<count($arr);$i++)
		{
			
			
			
			$csl = "SELECT * FROM `m_level_earn` WHERE under_umbrealla <= ".count($arr)." AND (level_from_name IS NULL OR level_from_name='') and min_invest<='".$arr[$i]['total']."'   ORDER BY id DESC LIMIT 1";
			 
			$cs = $CI->db->query($csl)->row_array();
			 
			if(isset($cs['id']))
			{
				$cs['total'] = $arr[$i]['total'];
				$level_earn[$cs['id']][] = $cs; 	
			}
		}
	}else
	{
		$csl = "SELECT * FROM `m_level_earn` WHERE under_umbrealla=0 AND (level_from_name IS NULL OR level_from_name='') and min_invest>='".$valuy."'   ORDER BY id DESC LIMIT 1";
		$arrs = $CI->db->query($sql)->row_array();
		if(isset($arrs['id']))
		{
			$level_earn[$arrs['id']][] = $arrs; 	
		}
	}
	return $level_earn;	
}
function correction_level($level)
{
	$CI =& get_instance();
	$arr = $CI->db
			->order_by("id desc")	
			->get('level_earn')->result_array();
			
	for($i=0;$i<count($arr);$i++)
	{
		
		
		$arr[$i]['level_sum'] = -999;
		$arr[$i]['level_data'] = array();
		if(isset($level[$arr[$i]['id']]))
		{
			
			$arr[$i]['level_sum'] = count($level[$arr[$i]['id']]);
			$arr[$i]['level_data'] = $level[$arr[$i]['id']];
				
		}
		
	}
	return $arr;
}
function is_level($level)
{
	$CI =& get_instance();
	$arr =  correction_level($level);
	$level_true = 0;
	for($i=0;$i<count($arr);$i++)
	{
		$level_true = $arr[$i]['id'];
		$csl = "SELECT * FROM `m_level_earn` WHERE under_umbrealla <= ".$arr[$i]['level_sum']." AND (level_from_name IS NULL OR level_from_name='')   ORDER BY id DESC LIMIT 1";
		$cs = $CI->db->query($csl)->row_array();
		if(isset($cs['id']))
		{
			$level_true = $cs['id'];
			return $level_true;
		}
	}
	return $level_true;
}
function level_css()
{	
	return array("zero"=>0,"one"=>1,"two"=>2,"three"=>3,"four"=>4,"five"=>5,"six"=>6,"seven"=>7 ,"eight"=>8,"nine"=>9,"ten"=>10); 	
}
function get_level_css($name)
{
	$l = level_css();
	return isset($l[$name])?$l[$name]:0;	
}
function levelbot()
{
	$CI =& get_instance();
	$arr = $CI->db
			->order_by("id asc")	
			->limit(1)
			->get('level_earn')->result_array();
	$level_true = 0;
	for($i=0;$i<count($arr);$i++)
	{
		$level_true = $arr[$i]['id'];
		 
	}
	return $level_true;
}
#task_type
function vartask_type()
{
	$arr = array("Not Finisih","Finish");	
	return $arr;
}
function task_type($no = "")
{
	$xx = vartask_type();
	return isset($xx[$no])?$xx[$no]:"";		
}
function task_read($in = array())
{
	$CI =& get_instance();
	return $CI->db->where('status',0)->get('v_task')->num_rows();
} 
function var_rewardstatus()
{
	$arr = array("Waiting","Completed","Rejected","Screenshot","Waiting Approval Screenshot");	
	return $arr;
}
function rewardstatus($no=0)
{
	$xx = var_rewardstatus();
	return isset($xx[$no])?$xx[$no]:"";	
}
function task_reward($status=4)
{
	$CI =& get_instance();
	//$sql = "select count(id) as total from m_task_reward where (status=4 or status=0) and id_customer is not null";
	$sql = "select count(id) as total from m_task_reward where (status=".$status.") and id_customer is not null";
	$arr = $CI->db->query($sql)->row_array();
	return isset($arr['total'])?$arr['total']:"0";//$CI->db->where('status',4)->or_where('status',0)->get('task_reward')->num_rows();
}
function varstatus_register()
{
	$arr = array("Waiting Active","Active","Blocked");	
	return $arr;
}
function status_register($no = "")
{
	$xx = varstatus_register();
	return isset($xx[$no])?$xx[$no]:"";		
} 