<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Smart_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		 parent::__construct();
		 
	}
	public function index()
	{
		 
		
		$in = array(); 
		 			
		$in['bread']['#'] = 'profile';
		$in['bank'] = $this->db->get('banks_data')->result_array();
		 
		$in['title'] = ""; 
		$in['tpl'] = "profile/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$telp = user_balance('telp');
			$in = $this->input->post();
			$new_password = "";
			if(isset($in['new_password']))
			{
				$new_password = $in['new_password'];	
				unset($in['new_password']);	
			}
			
			#=== telp
			$check_telp = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('telp',$in['telp'])
					 ->get('v_customer');
					 
			if($check_telp->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Telp Sudah digunakan Akun Lain','security'=>token()));
				return;
			}
			if($telp!=$in['telp'])
			{
				$in['phone_verification'] = 0;	
			}
			#=== end telp
			
			/*$check_atas_nama = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('atas_nama',$in['atas_nama'])
					 ->get('v_customer');
					 
			if($check_atas_nama->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Atas Nama Sudah digunakan Akun Lain','security'=>token()));
				return;
			}
			
			
			
			$check_rekening = $this->db
					 ->where("id<>".user_info('id')."") 
					 ->where('no_rekening',$in['no_rekening'])
					 ->get('v_customer');
					 
			if($check_rekening->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Rekening Sudah digunakan','security'=>token()));
				return;
			}
			
			/*$check = $this->db
					  
					 ->where('id',user_info('id'))->get('v_customer');
			if($check->num_rows()>0)
			{
				$r = $check->row_array();
				//$passwords =  $this->encryption->decrypt($in['passwords']);
				if($this->encryption->decrypt($r['passwords'])!=$in['passwords'])
				{
					json(array('error'=>true,'message'=>'Current Password Wrong','security'=>token()));
					return;	
				}
			}
			
			$bankdata = $this->db->where('kodeBank',$in['kodeBank'])->get('banks_data')->row_array();
			$in['namaBank'] = isset($bankdata['namaBank'])?$bankdata['namaBank']:"";
			*/
			$province = $this->db->where('id',$in['province'])->get("province")->row_array();
			$in['province'] = isset($province['name'])?$province['name']:"";
			$city = $this->db->where('id',$in['city'])->get("city")->row_array();
			$in['city'] = isset($city['name'])?$city['name']:"";
			$district = $this->db->where('id',$in['district'])->get("district")->row_array();
			$in['district'] = isset($district['name'])?$district['name']:"";
			
			if(isset($in['new_password']))
			{
				$in['passwords'] =  $this->encryption->encrypt($new_password);
			}
			$this->db->trans_begin();
			$time = time();
			 
			 	
				$this->db->where('id',user_info('id'));
				$old = $this->db->get('customer');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',user_info('id'));
					$this->db->update('customer',$in);
				}
				else
				{
					json(array('error'=>true,'message'=>'Data not found','security'=>token()));
					return;
				}
			 
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				$arr = $this->db->where('id',user_info('id'))->get('customer')->row_array();
				$this->session->set_userdata('sospawn_customer',$arr);
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	public function saveavatar()
	{
		if($this->input->is_ajax_request())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			if($_FILES['image']['error']==0)
			{
					$name = get_unique_file($_FILES['image']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['image']['tmp_name'],config_item('upload_path').$name))
					{
						$in['avatar'] = $name;
					}
			}
			if(isset($in['avatar']))
			{ 
					$this->db->where('id',user_info('id'));
					$old = $this->db->get('customer');
					if($old->num_rows()==1)
					{
						$arr = $old->row_array();
						$in['updated_by'] = user_info('id');
						$in['updated_on'] = $time;
						$this->db->where('id',user_info('id'));
						$this->db->update('customer',$in);
					}
					else
					{
						json(array('error'=>true,'message'=>'Data not found','security'=>token()));
						return;
					}
				 
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
				else
				{
					$this->db->trans_commit();
					$arr = $this->db->where('id',user_info('id'))->get('v_customer')->row_array();
					$this->session->set_userdata('sospawn_customer',$arr);
					json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
					return;
				}
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}  
	 
}

