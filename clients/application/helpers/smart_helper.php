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
	$ses = $CI->session->userdata('sospawn_task_login');
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
function sendmail($in = array())
{
	$CI =& get_instance();
	$message = '<html><body>';
	$message .= '<img src="//'.$_SERVER['SERVER_NAME'].'/uploads/'.get_setting('logo').'" alt="'.get_setting('site_name').' Activation User" />';
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
function bulan_name($i = 0)
{
	$v = array("","Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Agus","Sep","Okt","Nov","Des");
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
function settings()
{
	$CI =& get_instance();
	return $CI->db->get("setting")->row_array();
}
function setting($name)
{
	$CI =& get_instance();
	$arr = $CI->db->get("setting")->row_array();
	return isset($arr[$name])?$arr[$name]:"";
}
 
function get_unique_seller_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',6);
	$rs = $CI->db->where('verification_code',$rand)->get('seller');
	if($rs->num_rows()>0)
	{
		return get_unique_seller_code();
	}
	return $rand;
}
#roles
function roles_exception($ex = array())
{
	$CI =& get_instance();
	if(count($ex)>0)
	$xx = implode("','",$ex);
	$sql = "select * from s_roles where names not in('".$xx."')";
	return $CI->db
	->query($sql)->result_array();
} 
function roles_with($ex="")
{
	$CI =& get_instance();
	$sql = "select * from s_roles where lower(names) ='".strtolower($ex)."'";
	return $CI->db
	->query($sql)->row_array();
} 
function roles_with_id($ex="")
{
	$CI =& get_instance();
	$sql = "select * from s_roles where id ='".$ex."'";
	return $CI->db
	->query($sql)->row_array();
} 
#roles 
#order_status
function varstatus_order()
{
	$arr = array("Order Received","Waiting Payment","Payment Accept","Preparing","Delivery","Success","Complaint","Failed");	
	return $arr;
}
function status_order($no = "")
{
	 
	$xx = varstatus_order();
	return isset($xx[$no])?$xx[$no]:"";			
}
#url alias
function get_unique_url_ontable($table,$site_url,$field,$conditions='',$inc=0)
{	
	$CI =& get_instance();
	if(!empty($conditions))
		$CI->db->where($conditions);
	$str_url = strtolower($site_url.($inc>0?'-'.$inc:''));
	$rs = $CI->db->select('id')->where($field,url_title($str_url))->get($table);
	if($rs->num_rows()>0)
		return get_unique_url_ontable($table,$site_url,$field,$conditions,$inc+1);
	return url_title($str_url);
}
#active
function varactives()
{
	$arr = array("Non Active","Active","Blocked");	
	return $arr;
}
function actives($no = "")
{
	$xx = varactives();
	return isset($xx[$no])?$xx[$no]:"";		
}
#payment
function varpayment()
{
	$arr = array("Waiting Approval","Approved","Rejected");	
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
//
function send_mail_link($in = array())
{
	$CI =& get_instance();
	$configs = email_config();
	/*$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Email:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	*/
	$in['base'] = base_url();
	$message = $CI->load->view('manager/users/email', $in, true);
	 
	//$CI->load->library('mailer');
	//$CI->mailer->sendEmail($in['email']),);
	
	$CI->load->library('email');
    /*$config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    */
	 
	$CI->email->initialize($configs);
    $CI->email->from(config_item('email'), setting('website_title'));
    $CI->email->to($in['email']);
    $CI->email->subject(setting('website_title').' Link Confirmation');
    $CI->email->message($message);
	// $CI->email->send();


 //echo $CI->email->print_debugger(); 
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
		'smtp_host' => 'ssl://mail.sospawn.xyz',
		'smtp_port' => 465,
		'smtp_user' => 'noreplay@sospawn.xyz',
		'smtp_pass' => '!Gatekbgt2',
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1'
	);
	*/
	$config = Array(
		'protocol' => 'smtp',		'_smtp_auth' => true,		'wordwrap' => true,		'priority' =>3,
		//'smtp_host' => 'ssl://smtp.zoho.com',
		'smtp_host' => 'ssl://smtppro.zoho.com',
		'smtp_port' => 465,
		'smtp_user' => 'hai@sospawn.com',//'hai@sospawn.xyz', 
		'smtp_pass' => '72hMcy4.8y+8HtL', 
		'mailtype'  => 'html', 
		'newline' => "\r\n",
		'charset'   => 'iso-8859-1'
	);
	$config['newline'] = "\r\n"; 	
	return $config;
}
function send_mail_forgot($in = array())
{
	$CI =& get_instance();
	$configs = email_config();
	/*$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Forgot:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	*/
	$message = $CI->load->view('manager/users/forgot', $in, true);
	
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($configs);
    $CI->email->from(config_item('email'), setting('website_title'));
    $CI->email->to($in['email']);
    $CI->email->subject(setting('website_title').' Link Forgot');
    $CI->email->message($message);
    if($CI->email->send())
	{
		return true;
	}
	return false;
 
}
function get_unique_customer_code()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',8);
	$rs = $CI->db->where('activation_code',$rand)->get('customer');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}  
function get_unique_order_presale()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',15);
	$rand = "X-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('order_presale');
	if($rs->num_rows()>0)
	{
		return get_unique_users_code();
	}
	return $rand;
}
function get_unique_tasks()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',5);
	$rand = "V-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('tasks');
	if($rs->num_rows()>0)
	{
		return get_unique_tasks();
	}
	return $rand;
}
function romawi($angka)
{
    $hsl = "";
    if ($angka < 1 || $angka > 5000) { 
        // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
        $hsl = "Batas Angka 1 s/d 5000";
    } else {
        while ($angka >= 1000) {
            // While itu termasuk kedalam statement perulangan
            // Jadi misal variable angka lebih dari sama dengan 1000
            // Kondisi ini akan di jalankan
            $hsl .= "M"; 
            // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
            // Varible hsl
            $angka -= 1000;
            // Lalu setelah itu varible angka di kurangi 1000 ,
            // Kenapa di kurangi
            // Karena statment ini mengambil 1000 untuk di konversi menjadi M
        }
    }


    if ($angka >= 500) {
        // statement di atas akan bernilai true / benar
        // Jika var angka lebih dari sama dengan 500
        if ($angka > 500) {
            if ($angka >= 900) {
                $hsl .= "CM";
                $angka -= 900;
            } else {
                $hsl .= "D";
                $angka-=500;
            }
        }
    }
    while ($angka>=100) {
        if ($angka>=400) {
            $hsl .= "CD";
            $angka -= 400;
        } else {
            $angka -= 100;
        }
    }
    if ($angka>=50) {
        if ($angka>=90) {
            $hsl .= "XC";
            $angka -= 90;
        } else {
            $hsl .= "L";
            $angka-=50;
        }
    }
    while ($angka >= 10) {
        if ($angka >= 40) {
            $hsl .= "XL";
            $angka -= 40;
        } else {
            $hsl .= "X";
            $angka -= 10;
        }
    }
    if ($angka >= 5) {
        if ($angka == 9) {
            $hsl .= "IX";
            $angka-=9;
        } else {
            $hsl .= "V";
            $angka -= 5;
        }
    }
    while ($angka >= 1) {
        if ($angka == 4) {
            $hsl .= "IV"; 
            $angka -= 4;
        } else {
            $hsl .= "I";
            $angka -= 1;
        }
    }

    return ($hsl);
}
function tiers()
{
	$CI =& get_instance();
	$rs = $CI->db->where('displays',1)->get('tier')->row_array();
	$out = array();
	$out = $rs;
	$max = $CI->db
				->select('sum(usdt) as total_usdt')
				->where('status',1)
				->get('order_presale')->row_array();
	$out['total_usdt'] = $max['total_usdt'];
	$out['phase'] = 0;	
	$out['customer'] =  $CI->db
				->where('status',1)
				->get('order_presale')->num_rows();
	$out['phase_token'] = 0;			
	if(isset($rs['id']))
	{
		$max_tier = $CI->db
				->select('sum(usdt) as total_usdt,sum(total) as total')
				->where('id_tier',$rs['id'])
				->where('status',1)
				->get('order_presale')->row_array();
		if(isset($max_tier['total_usdt']))
		{
			$out['phase'] = $max_tier['total_usdt'];
			$out['phase_token'] =  $max_tier['total'];
		}
		
				/*
				$CI->db
				->select('sum(usdt) as total_usdt,sum(total) as total')
				->where('id_tier',$rs['id'])
				->where('status',1)
				->group_by("id_customer")
				->get('order_presale')->num_rows();
			    */	
		  
				
	}
	return $out;	
}
function tier_fase($ids)
{
	$CI =& get_instance();
	$rs = $CI->db->get('tier')->result_array();
	$fase = 1;
	for($i=0;$i<count($rs);$i++)
	{
		if($rs[$i]['id']==$ids)
		{
			return $fase;	
		}
		$fase ++;
	}
	return $fase;
}
function template_closed_phase()
{
	return " <div class='row xmessage'>  
				<div class='col-12 promo__content aos-init aos-animate'>	
					<div class='section-header section-header--animated section-header--tire section-header--small-margin'> 
                                    	<div class='alert alert-danger' style=' color:linear-gradient(135deg, #49138C, #341477); text-align:center; font-weight:bold;'>Private Sale Is closed </div>
                                    </div>
				</div>
			</div>				
							";
}
function orderpresale_type($no = "")
{
	$xx = array("Crypto","Bank Transfer");
	return isset($xx[$no])?$xx[$no]:"";		
}
#status
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
 