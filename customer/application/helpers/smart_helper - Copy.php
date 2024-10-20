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
	$ses = $CI->session->userdata('aleo_customer');
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
	$arr = array("Waiting","Approve","Failed");	
	return $arr;
}
function payments($no = "")
{
	$xx = varpayment();
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
		'mailtype'  => 'html', 		'newline' => "\r\n",
		'charset'   => 'iso-8859-1'
	);
	 
	return $config;
}
function email_config_()
{
	$config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://mail.aleominingpool.com',
		'smtp_port' => 465,
		'smtp_user' => 'noreply@aleominingpool.com',
		'smtp_pass' => '!Gatekbgt2',
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1'
	);	
	return $config;
}
function send_mail_forgot($in = array())
{
	$CI =& get_instance();
	$configs = email_config();
	/*
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . strip_tags($in['email']) . "</td></tr>";
	$message .= "<tr><td><strong>Confirmation Forgot:</strong> </td><td><a href='".strip_tags($in['urls'])."' target='_blan'>" . strip_tags($in['urls']) . "</a></td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
	*/
	$CI->load->library('email');
    $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
    $CI->email->initialize($configs);
    
	$in['base'] = base_url();
	$message = $CI->load->view('manager/users/forgot', $in, true);
	
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
function get_unique_topup()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',15);
	$rand = "T-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('topup');
	if($rs->num_rows()>0)
	{
		return get_unique_topup();
	}
	return $rand;
}
function get_unique_buy()
{
	$CI =& get_instance();
	$CI->load->helper('string');
	$rand = random_string('numeric',10);
	$rand = "B-".$rand;
	$rs = $CI->db->where('pid',$rand)->get('buy');
	if($rs->num_rows()>0)
	{
		return get_unique_topup();
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

function get_langs()
{
	$CI =& get_instance();
	$ses = $CI->session->userdata('aleo_customer_lang');
	return $ses;
	
}
function custom_language($texted = "")
{
	$CI =& get_instance();
	$langs = get_langs();
	$code = "en";
	if(isset($langs['id']))
	{
		$code  = $langs['code'];
	}
	if(!empty($texted))
	{
		 
		$check = $CI->db
					->select("m_static_text.*")
					->join("m_language","m_language.id=m_static_text.id_language","inner")
					->where('lower(description_from)',strtolower($texted))
					->where("m_language.code",$code)
					->get('static_text')
					->row_array();
		if(isset($check['id']))
		{
			return $check['description_to'];	
		}
	}
	return $texted;
}
function arr_lang()
{
	$CI =& get_instance();
	$ses = $CI->db->where('displays',1)->get('language')->result_array();
	return $ses;
	
}
function get_currency()
{
	$CI =& get_instance();
	$ses = $CI->db->where('displays',1)->get('currency')->result_array();
	return $ses;
	
}
//
function get_user_balance()
{
	$CI =& get_instance();
	$ses = $CI->db->where('id',user_info('id'))->get('v_customer')->row_array();
	return $ses;	
}
function user_balance($no)
{
	$xx = get_user_balance();
	if($no=="level_users")
	{
		/*
		$under_umbrella = under_umbrella($xx['id']);
		if($under_umbrella>0)
		{
			$xx[$no] = $under_umbrella;
		}
		$up = level_earn_from(user_info('id'));
		if($up>0)
		{
			$xx[$no] = $up;
		}
		*/
		$xx[$no] = my_level(user_info('id'));
		
	}
	return isset($xx[$no])?$xx[$no]:"";			
}
///
function level_css()
{	
	return array("zero"=>0,"one"=>1,"two"=>2,"three"=>3,"four"=>4,"five"=>5,"six"=>6,"seven"=>7 ,"eight"=>8,"nine"=>9,"ten"=>10); 	
}
function get_level_css($name)
{
	$l = level_css();
	return isset($l[$name])?$l[$name]:$name;	
}

function get_package()
{
	$CI =& get_instance();
	$total_coin = user_balance('buy_coin');
	/*
	$arr = $CI->db
			
			->where("perfomances <='".$total_coin."' ")
			->where("displays=1")
			->order_by('perfomances asc ')
			->limit(1)
			->get('package')->row_array();
    */
	$arr = array();
	$buy = $CI->db
			->where('id_customer',user_info('id'))
			->order_by('id_package desc ')
			->limit(1)
			->get('buy')->row_array();			
	///if(isset($arr['id']) && isset($buy['id']))
	if(isset($buy['id']))
	{
		$arr = $CI->db
			
			//->where("perfomances <='".$total_coin."' ")
			->where('id',$buy['id_package'])
			->where("displays=1")
			//->order_by('perfomances asc ')
			->limit(1)
			->get('package')->row_array();
		if(isset($arr['id']))
		{ 
			$arr['sub'] =  $CI->db->where("id_package",$arr['id'])->get('package_sub')->result_array();
			$datenow = date('Y-m-d H:i:s');
			
			$name_value = "three_month";
			
			$effective3 = date('Y-m-d', strtotime("+3 months", strtotime($buy['tanggal'])));
			$effective6 = date('Y-m-d', strtotime("+6 months", strtotime($buy['tanggal'])));
			$effective9 = date('Y-m-d', strtotime("+9 months", strtotime($buy['tanggal'])));
			$effective12 = date('Y-m-d', strtotime("+12 months", strtotime($buy['tanggal'])));
			if($datenow<=$effective3)
			{
				$name_value = "three_month";
			}else if($datenow<=$effective6 && $datenow>$effective3)
			{
				$name_value = "six_month";
			}
			else if($datenow<=$effective9 && $datenow>$effective6)
			{
				$name_value = "nine_month";
			}
			else if($datenow>$effective9)
			{
				$name_value = "tweleve_month";
			}
			for($i=0;$i<count($arr['sub']);$i++)
			{
				$arr['sub'][$i]['nila_tetap'] = $arr['sub'][$i][$name_value];
			}
		}
	}
	return $arr;	
}
function start_ref_num()
{
	return 60000;
}
function level_users($id_users = 0)
{
	if(!isset($_SESSION['users_aleo']))
	{
		$_SESSION['users_aleo'] = array();	
	}
	if($id_users>0)
	{
			
	}
}
function user_level($id = "")
{
	$CI =& get_instance();
	$ref = $CI->db->where('id',$id)->get('v_level_earn')->row_array();	
	return $ref;
}
function get_users_level($id = "",$stats = true)
{
	
	$CI =& get_instance();
	if(!isset($_SESSION['levelusers_aleo']))
	{
		$_SESSION['levelusers_aleo'] = array();	
	}
		$arr_ref = $CI->db
						->where('refferal',$id) 
						->get('v_customer')->result_array();
		for($i=0;$i<count($arr_ref);$i++)
		{
			$arr_ref[$i]['perfomance'] = $CI->db->where('id_customer',$arr_ref[$i]['id'])->get('buy')->num_rows();
			
			/*
			$under = $CI->db
										->select("count(m_buy.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
										->get('buy')->row_array();
			*/
			$under = $CI->db
										->select("count(m_v_customer.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										//->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
										->get('v_customer')->row_array();
			$arr_ref[$i]['perfomance_under'] = isset($under['total'])?$under['total']:0;
			
			$ref_under = $CI->db
										->select("count(m_v_customer.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										 
										->get('m_v_customer')->row_array();
										
			$arr_ref[$i]['ref_under'] = isset($ref_under['total'])?$ref_under['total']:0;							
			
			//$team += $arr_ref[$i]['ref_under'];	
			
			
			$_SESSION['levelusers_aleo'][] = $arr_ref[$i]; 
			if($arr_ref[$i]['ref_under']>0)
			{
				if($stats==true)
				get_users_level($arr_ref[$i]['id'],$stats);
			}
		}	
}
function get_users_refferal_with($id = "",$id_v_level_earn = 0,$stats = true,$number=0)
{
	
	$CI =& get_instance();
	if(!isset($_SESSION['levelusers_aleo_with']))
	{
		$_SESSION['levelusers_aleo_with'] = array();	
	}
		$arr_ref = $CI->db
						->where('id',$id) 
						->get('v_customer')->result_array();
		for($i=0;$i<count($arr_ref);$i++)
		{
			
			$arr_ref[$i]['level'] = $number;
			$arr_ref[$i]['level_reward'] = check_if_reward($id_v_level_earn,$number,$arr_ref[$i]['id']);
			$arr_ref[$i]['perfomance'] = $CI->db->where('id_customer',$arr_ref[$i]['id'])->get('buy')->num_rows();
			
			/*
			$under = $CI->db
										->select("count(m_buy.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
										->get('buy')->row_array();
			*/
			$under = $CI->db
										->select("count(m_v_customer.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										//->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
										->get('v_customer')->row_array();
			$arr_ref[$i]['perfomance_under'] = isset($under['total'])?$under['total']:0;
			
			$ref_under = $CI->db
										->select("count(m_v_customer.id) as total")
										->where('m_v_customer.refferal',$arr_ref[$i]['id'])
										 
										->get('m_v_customer')->row_array();
										
			$arr_ref[$i]['ref_under'] = isset($ref_under['total'])?$ref_under['total']:0;							
			
			//$team += $arr_ref[$i]['ref_under'];	
			
			
			$_SESSION['levelusers_aleo_with'][] = $arr_ref[$i]; 
			if($arr_ref[$i]['ref_under']>0)
			{
				if($stats==true)
				get_users_refferal_with($arr_ref[$i]['refferal'],$id_v_level_earn,$stats,($number+1));
			}
		}	
}
function get_pid_cust($id = "")
{
	$CI =& get_instance();
	$arr_ref = $CI->db
						->where('id',$id) 
						->get('v_customer')->row_array();
	return isset($arr_ref['pid'])?$arr_ref['pid']:"";					
}
function level_earn_from($userid = "")
{
	$CI =& get_instance();
	$arr = $CI->db->where('level_from',-1)->get('v_level_earn')->result_array();
	for($i=0;$i<count($arr);$i++)
	{
		$level_from_name = $arr[$i]['level_from_name'];
		if (strpos($level_from_name, "-") !== false) {
			$xx = explode("-",$level_from_name);
			$csql = "select * from m_v_level_earn where lower(level) like '%".$xx[0]."%' or lower(level) like '%".strtolower($xx[1])."%'";
			$uu = $CI->db->query($csql)->result_array();
			$ip = array();
			for($x=0;$x<count($uu);$x++)
			{
				$ip[] = $uu[$x]['id'];	
			}
			
			$check = $CI->db->query("select * from m_v_customer where refferal='".$userid."' and level_users in('".implode("','",$ip)."')")->num_rows();
			if($check>0)
			{
				return $arr[$i]['id'];
			}
		}else
		{
			$uu = $CI->db->query("select * from m_v_level_earn where level ='".$level_from_name."'")->result_array();
			$ip = array();
			for($x=0;$x<count($uu);$x++)
			{
				$ip[] = $uu[$x]['id'];	
			}
			$check = $CI->db->query("select * from m_v_customer where refferal='".$userid."' and level_users in('".implode("','",$ip)."')")->num_rows();
			if($check>0)
			{
				return $arr[$i]['id'];
			}	
		}
	}
	return 0;
}
function get_leveling($id_users)
{
	$CI =& get_instance();
	$ses = $CI->db->where('id',$id_users)->get('v_customer')->row_array();
	if(isset($ses['id']))
	{
		$up = level_earn_from($id_users);
		if($up>0)
		{
			$ses['level_users'] = $up;
		}
		
		
	}
	$ses['levels'] = user_level($ses['level_users']);
	return $ses;	
}
function under_umbrella($id_users = "")
{
	$CI =& get_instance();
	$_SESSION['levelusers_aleo'] = array();	
	get_users_level($id_users,true);
	$arr = $CI->db
				 ->where("under_umbrealla <= '".count($_SESSION['levelusers_aleo'])."'")
				  ->where("level_from>0")
				 ->order_by('under_umbrealla desc')
				 ->limit(1)
				 ->get('v_level_earn')->row_array();
	 
	return isset($arr['id'])?$arr['id']:0;	
}
function ref_arr($id_users = "")
{
	$CI =& get_instance();
	$sql = "SELECT  id,
        pid,
		email,
        refferal 
FROM    (SELECT * FROM m_v_customer
         ORDER BY refferal, id) customer_sorted,
        (SELECT @pv := '".$id_users."') initialisation
WHERE   FIND_IN_SET(refferal, @pv)
AND     LENGTH(@pv := CONCAT(@pv, ',', id))";
	$arr = $CI->db->query($sql)->result_array();
	return $arr;
}
function ref_count($id_users = "")
{
	$CI =& get_instance();
	$sql = "SELECT  count(id) as total
FROM    (SELECT * FROM m_v_customer
         ORDER BY refferal, id) customer_sorted,
        (SELECT @pv := '".$id_users."') initialisation
WHERE   FIND_IN_SET(refferal, @pv)
AND     LENGTH(@pv := CONCAT(@pv, ',', id))";
	$arr = $CI->db->query($sql)->row_array();
	return isset($arr['total'])?$arr['total']:0;
}
function ref_count_buy($id_users = "")
{
	$CI =& get_instance();
	$sql = "SELECT  COUNT(id) AS total
FROM    (SELECT * FROM m_v_customer WHERE m_v_customer.`buy`>0
         ORDER BY refferal, id) customer_sorted,
        (SELECT @pv := '".$id_users."') initialisation
WHERE   FIND_IN_SET(refferal, @pv)
AND     LENGTH(@pv := CONCAT(@pv, ',', id))";
	$arr = $CI->db->query($sql)->row_array();
	return isset($arr['total'])?$arr['total']:0;
}
function level_earn_from_umbrella($userid = "",$vals = 0)
{
	$CI =& get_instance();
	$ref_arr = ref_arr($userid);
	$v_num = array();
	if(is_array($ref_arr))
	{
		for($i=0;$i<count($ref_arr);$i++)
		{
			//$ref_arr[$i]['ref_count'] = ref_count($ref_arr[$i]['id']); 
			$ref_arr[$i]['level_users_n'] = small_level($ref_arr[$i]['id']);
			$v_num[$ref_arr[$i]['level_users_n']][] = $ref_arr[$i]['level_users_n'];
		}
	}
	
	$arr = $CI->db->where("level_from_name>0")
				   //->where("under_umbrealla <='".$vals."'")
				   ->get('v_level_earn')->result_array();
	for($i=0;$i<count($arr);$i++)
	{
		$level_from_name = $arr[$i]['level_from_name'];
		$level_from_name = strtolower($level_from_name);
		if (strpos($level_from_name, "-") !== false) {
			$xx = explode("-",$level_from_name);
			$csql = "select * from m_v_level_earn where lower(level) like '%".$xx[0]."%' or lower(level) like '%".strtolower($xx[1])."%'";
			$uu = $CI->db->query($csql)->result_array();
			$ip = array();
			$check = 0;
			
			for($x=0;$x<count($uu);$x++)
			{
				$vcheck = isset($v_num[$uu[$x]['id']])?count($v_num[$uu[$x]['id']]):0;
				if($arr[$i]['under_umbrealla'] >= $vcheck)
				{
					$check += $vcheck;
				}
				$ip[] = $uu[$x]['id'];	
			}
			
			 
			//$check = $CI->db->query("select * from m_v_customer where refferal='".$userid."' and level_users in('".implode("','",$ip)."')")->num_rows();
			 
			 
			if($check>0)
			{
				return $arr[$i]['id'];
			}
		}else
		{
			$uu = $CI->db->query("select * from m_v_level_earn where level ='".$level_from_name."'")->row_array();
			$ip = array();
			$vcheck  = 0;
			$check = 0;
			if(isset($uu['id']))
			{
				$vcheck = isset($v_num[$uu['id']])?count($v_num[$uu['id']]):0;
				if($vcheck >= $arr[$i]['under_umbrealla'])
				{
						$check += $vcheck;
				} 
			}
			 
			 
			//$check = $CI->db->query("select * from m_v_customer where refferal='".$userid."' and level_users in('".implode("','",$ip)."')")->num_rows();
			if($check>0)
			{
				return $arr[$i]['id'];
			}	
		}
	}
	return 0;
}
/* ===  */
function check_buy($id_users = "")
{
	$CI =& get_instance();
	$arr = $CI->db
				 ->where("id_customer",$id_users)
				  
				 ->limit(1)
				 ->get('buy')->row_array();
	return isset($arr['id'])?$arr['id']:0;				 	
}

function check_buy_users($id_users = "")
{
	$CI =& get_instance();
	$arr = $CI->db
				 ->select("m_v_customer.*")
				 ->where("id_customer",$id_users)
				 ->join("m_v_customer","m_v_customer.id=m_buy.id_customer","inner") 
				 ->limit(1)
				 ->get('buy')->row_array();
	return isset($arr['id'])?$arr['id']:0;				 	
}


function bottom_level()
{
	$CI =& get_instance();
	$arr = $CI->db
				 ->where("under_umbrealla=0")
				 ->where("level_from=0")
				 ->where("level_from_name=0")  
				 ->order_by('id asc')
				 ->limit(1)
				 ->get('v_level_earn')->row_array();
	return isset($arr['id'])?$arr['id']:0;				 	
}
function small_level($id_users = "")
{
	$CI =& get_instance();
	$ref_count = ref_count_buy($id_users); 
	 
	$arr = $CI->db
				 ->where("under_umbrealla <= '".$ref_count."'")
				 ->where("level_from=0")
				 ->where("level_from_name=0")  
				 ->order_by('under_umbrealla desc')
				 ->limit(1)
				 ->get('v_level_earn')->row_array();
	return isset($arr['id'])?$arr['id']:0;				 	
}
function my_level($id_users = "")
{
	$CI =& get_instance();
	$buy = check_buy($id_users);
	if($buy>0)
	{
		
		$ref_count = ref_count_buy($id_users); 
		 
		$up = level_earn_from_umbrella($id_users,$ref_count);
		if($up>0)
		{
			$arr = $CI->db->where('id',$up)->get('v_level_earn')->row_array();
		}else
		{
			$arr = $CI->db
					 ->where("under_umbrealla <= '".$ref_count."'")
					 ->where("level_from_name=0") 
					 ->where("level_from=0")
					  
					 ->order_by('under_umbrealla desc')
					 ->limit(1)
					 ->get('v_level_earn')->row_array();
		}
		return isset($arr['id'])?$arr['id']:0;	
	}	
	 
	return bottom_level(); 	
}
function check_if_reward($id_level = 0,$level = 0,$id_users = "")
{
 	$CI =& get_instance();
	$arr = user_level($id_level);
	if(isset($arr['id']))
	{
		if(!empty($arr['refferal_share']))
		{
			$cc = explode(",",$arr['refferal_share']);
			return isset($cc[$level])?$cc[$level]:0;
			
		}else
		{
			if($level==0)
			return $arr['refferal_reward'];	
		}
	}
	return 0;
}