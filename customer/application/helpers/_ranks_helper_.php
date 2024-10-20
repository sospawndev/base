<?php
 
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
function getuser_level($id = "",$name = "")
{
	$CI =& get_instance();
	$l = user_level($id);
	return isset($l[$name])?$l[$name]:$name;	
}
function user_cust($id = "")
{
	$CI =& get_instance();
	$ref = $CI->db->where('id',$id)->get('v_customer')->row_array();	
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
	
		//manual
		$user_cust = user_cust($id_users);
		if(isset($user_cust['id_level_earn']))
		{
			if(!empty($user_cust['id_level_earn']))
			{
				return getuser_level($user_cust['id_level_earn'],"id");
			}
			
		}
		//manual
	
	
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
	//if($buy>0)
	//{
		//manual
		$user_cust = user_cust($id_users);
		if(isset($user_cust['id_level_earn']))
		{
			if(!empty($user_cust['id_level_earn']))
			{
				return getuser_level($user_cust['id_level_earn'],"id");
			}
			
		}
		//manual
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
	//}	
	 
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