<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
	public function profile()
	{
		 
		$in = array();
		$in['country'] = $this->db->get('country')->result_array();
		$in['province'] = $this->db->get('province')->result_array();
		$in['city'] = $this->db
					  ->select("m_city.*")
					  ->where('m_province.name',user_info('province'))		
					  ->join('m_province','m_province.id=m_city.id_province','inner')
					  ->get('city')->result_array();
		$in['district'] = $this->db
					  ->select("m_district.*")
					  ->where('m_city.name',user_info('city'))		
					  ->join('m_city','m_city.id=m_district.id_city','inner')
					  ->get('district')->result_array();
		$in['bisnis_type'] = $this->db->where('displays',1)->get('bisnis_type')->result_array();			  
		$in['bank'] = $this->db->get('bank')->result_array();
		
		$in['data'] = $this->db->where('id',user_info('id'))->get('customer')->row_array();
		$in['bread']['#'] = 'Profile';
		
		$in['title'] = ""; 
		$in['tpl'] = "users/form";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			if(isset($in['avatar_s']))
			{
				unset($in['avatar_s']);
				if($_FILES['avatar']['error']==0)
				{
					$name = get_unique_file($_FILES['avatar']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
					{
						$in['avatar'] = $name;
					}
				}
			}
			/*if($in['country']=="INDONESIA")
			{
				$province = $this->db->where('id',$in['province'])->get("province")->row_array();
				$in['province'] = isset($province['name'])?$province['name']:"";
				$city = $this->db->where('id',$in['city'])->get("city")->row_array();
				$in['city'] = isset($city['name'])?$city['name']:"";
				$district = $this->db->where('id',$in['district'])->get("district")->row_array();
				$in['district'] = isset($district['name'])?$district['name']:"";
				
			}else
			{
				if(isset($in['province']))
				{
					unset($in['province']);	
				}
				if(isset($in['city']))
				{
					unset($in['city']);	
				}
				if(isset($in['district']))
				{
					unset($in['district']);	
				}
				
			}*/
			//$in['passwords'] =  $this->encryption->encrypt($in['passwords']);
			 
				$this->db->where('id',$in['id']);
				$old = $this->db->get('customer');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
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
				$this->session->set_userdata('sospawn_task_login',$arr);
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	public function delete_avatar()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$this->db->trans_begin();
			$id = $this->input->post('id');
			$this->db->where('id',$id);
			$rs = $this->db->get("customer");
			if($rs->num_rows()==1)
			{		
				$this->db->where('id',$id)->update("customer",array('avatar'=>''));
				$old = $rs->row_array();
				if(!empty($old['avatar']) && file_exists(config_item('upload_path').$old['avatar']))
				{
					unlink(config_item('upload_path').$old['avatar']);
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

