<?php
function key_apps()
{
	return "";
}

if (!function_exists('sendPushNotification')) {
		function sendPushNotification($types = "apps",$registration_ids, $data){
		// Set POST variables
		$CI =& get_instance();
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			'registration_ids' => $registration_ids,
			'data' => $data
		);
		$api_key = key_apps();
		$headers = array( 'Authorization: key='.$api_key, 'Content-Type: application/json' );
		// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, sjsons($fields));
		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) { die('Curl failed: ' . curl_error($ch)); }
		// Close connection
		curl_close($ch);
		$result_data = json_decode($result);
		
		$result_data->regid = $registration_ids;
		$result_arr = array();
		$result_arr['success'] = $result_data->success; 
		$result_arr['failure'] = $result_data->failure;
		
		return $result_data;
	}
}
if (!function_exists('notif_fcm_apps')) {
	function notif_fcm_apps($arr)
	{
			$CI =& get_instance();
			$c = $CI->db->get("fcm")->result_array();
			$out = array();
			for($i=0;$i<count($c);$i++)
			{
				 
				$ps = array();
				$ps[] = $c[$i]['regid']; 
				$p = sendPushNotification("apps",$ps,$arr);	
				$out[] = $p; 
			}
			
			return $out;
			 
	}
}
if (!function_exists('notif_fcm_apps_id')) {
	function notif_fcm_apps_id($arr,$ids = "")
	{
			$CI =& get_instance();
			$c = $CI->db->get("fcm")->result_array();
			if(!empty($ids))
			{
				$c = $CI->db->where('id_user',$ids)->get("fcm")->result_array();
			}
			$out = array();
			for($i=0;$i<count($c);$i++)
			{
				 
				$ps = array();
				$ps[] = $c[$i]['regid']; 
				$p = sendPushNotification("apps",$ps,$arr);	
				$out[] = $p; 
			}
			return $out;
			 
	}
}
 
if (!function_exists('insert_fcm')) {
	function insert_fcm()
	{
			$CI =& get_instance();
			$awal = $CI->input->get();
			if(isset($_GET['regid']) && isset($_GET['serial']))
			{
				$CI->session->set_userdata('device_apps',$_GET);
			}
			$device = $CI->session->userdata('device_apps');
			
			$session = $CI->session->userdata('lapakcermat_user');
			$fcm = isset($awal['device'])?$awal:$device; 
			if(isset($fcm['device']) && isset($fcm['serial']))
			{
				if(!empty($fcm['regid']))
				{
					
					$in = array();
					$in['device'] 		= $fcm['device'];
					$in['os_version'] 	= $fcm['os_version'];
					$in['app_version'] 	= $fcm['app_version'];
					$in['serial']  		= $fcm['serial'];
					$in['regid']		= $fcm['regid'];
					$in['imei']		= isset($fcm['imei'])?$fcm['imei']:"";
					$in['id_user'] 		= isset($session['id'])?$session['id']:NULL; 
					$bahasa = $CI->session->userdata('language');
					 
					$c = $CI->db->where('serial',$fcm['serial'])->where('device',$fcm['device'])->get('fcm')->row_array();
					if(isset($c['id']))
					{ 
						$CI->db->trans_begin();
						$CI->db->where('id',$c['id']);
						$CI->db->update('fcm',$in);
						$CI->db->trans_commit();
					}else
					{
						$CI->db->trans_begin();
						$CI->db->insert('fcm',$in);	
						$CI->db->trans_commit();
					}
					
				}
			}	
	}
}
#=============== edit notification mobile ============#
