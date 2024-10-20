<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in = array();
		$in['data'] = $this->db->get('setting')->row_array();
		$in['use_hedaer'] = true;
		$in['title'] = 'Master ';
		$in['desc'] = 'you can manage your  here';
		$in['tpl'] = 'setting/form';
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
				unset($in['avatar_s']);
				if($_FILES['avatar']['error']==0)
				{
					$name = get_unique_file($_FILES['avatar']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
					{
						$in['logo'] = $name;
						 
					}
			 	}
				if(isset($in['favicon_s']))
				unset($in['favicon_s']);
				if($_FILES['favicon']['error']==0)
				{
					$name = get_unique_file($_FILES['favicon']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['favicon']['tmp_name'],config_item('upload_path').$name))
					{
						$in['favicon'] = $name;
						 
					}
			 	}
				$this->db->where('id',$in['id']);
				$old = $this->db->get('setting');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					$this->db->where('id',$in['id']);
					$this->db->update('setting',$in);
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
				$arr = $this->db->where('id',user_front('id'))->get('customer')->row_array();
				$this->session->set_userdata('customermeong_login',$arr);
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
			$rs = $this->db->get("setting");
			if($rs->num_rows()==1)
			{		
				$this->db->where('id',$id)->update("setting",array('logo'=>''));
				$old = $rs->row_array();
				if(!empty($old['logo']) && file_exists(config_item('upload_path').$old['logo']))
				{
					unlink(config_item('upload_path').$old['logo']);
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
	public function delete_favicon()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$this->db->trans_begin();
			$id = $this->input->post('id');
			$this->db->where('id',$id);
			$rs = $this->db->get("setting");
			if($rs->num_rows()==1)
			{		
				$this->db->where('id',$id)->update("setting",array('favicon'=>''));
				$old = $rs->row_array();
				if(!empty($old['logo']) && file_exists(config_item('upload_path').$old['favicon']))
				{
					unlink(config_item('upload_path').$old['favicon']);
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