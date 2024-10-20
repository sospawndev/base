<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index($id='')
	{
		 
			$id = (int) $id;
		 
			$in['use_hedaer'] = true;
			$in['title'] = 'User Management';
			$in['desc'] = 'you can manage users here';
			$in['titles'] = '';
			$in['bread'][''] = 'Configuration';
			$in['bread'][site_url('users')] = 'Admin';
			$in['tpl'] = 'users/main';
			$in['level_users'] = $id;
			$this->load->view('manager/layout',$in);
			return;
		 
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_users.id';
			$columns    = array(
			array('db'=>'m_users.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_users.avatar",'dt'=>1,'alias'=>'logo','formatter'=>function($d,$row){
				if(!empty($d) && is_file(config_item('upload_path').$d) && file_exists(config_item('upload_path').$d))
				{
					$thumb = getThumb($d,100,90);
					return '<img class="img-thumbnail" src="cache/'.$thumb.'" alt="'.$row->description.'">';
				}
				return '';
			}),
			array('db'=>"CONCAT(m_users.username,'(',m_users.email,')<br>',m_users.name)",'dt'=>2,'alias'=>'description'),
			 
			array('db'=>"m_users.active",'dt'=>3,'alias'=>'status','formatter'=>function($d,$row){
				 if($d==1)
				 {
					 return "active";
				 }
				 return "Non active";
			}),
			 
			
			array('db'=>"DATE_FORMAT(FROM_UNIXTIME(m_users.created_on),'%d-%m-%Y')",'dt'=>4,'alias'=>'created_on'),
			array('db'=>'m_users.id','dt'=>5,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
						<span class="input-group-btn">
							<button class="btn btn-xs btn-sm btn-default btn-reset-users" type="button" data-toggle="tooltip" title="" data-original-title="Reset password user" data-ref="'.$row->ids.'"><i class="fa fa-asterisk"></i></button>
							<a class="btn btn-xs btn-sm btn-warning btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit User" href="'.site_url('users/edit/'.$row->ids).'"><i class="fa fa-pen"></i></a>
							<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove User" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
						</span>	
						 ';
			}),
			 
			);
			$table = 'm_users';
			$whereResult = NULL;
			$params = $this->input->get('level');
			$whereAll = "level=1";
			$order = '';
			 
			
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll ,$order);
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$in_db = $_POST; //$this->input->post();
			$time = time();
			$in_db['created_by'] = user_info('id');
			$in_db['updated_by'] = user_info('id');
			$in_db['created_on'] = $time;
			$in_db['updated_on'] = $time;
			$in_db['telp'] = ltrim($in_db['telp'],'0');
			$in_db['telp'] = ltrim($in_db['telp'],'62');
			$in_db['telp'] = ltrim($in_db['telp'],'+62');
			$in_db['password'] = $this->encryption->encrypt($in_db['password']);
			unset($in_db['avatar_s']);
			if($_FILES['avatar']['error']==0)
			{
				$name = get_unique_file($_FILES['avatar']['name']);
				if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
				{
					$in_db['avatar'] = $name;
				}
			}
			$this->db->trans_begin();
			$this->db->insert("users",$in_db);
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
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		$in = array();
		 
		$id = 1; 
		$in['tpl'] = 'users/form';
		$in['titles'] = "Admin";
		$in['level_users'] = $id;
		$in['url_submit'] = site_url('users/add/');
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('users')] = 'Admin'; 
		$in['bread'][site_url('users/add')] = 'add'; 
		
		$this->load->view('manager/layout',$in);
	}
	public function check_username_exist()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->get('id',true);
			$username = $this->input->get('username',true);
			if(!empty($id))
				$this->db->where('id!=',$id);
			$this->db->where('username',$username);
			$rs = $this->db->get("users");
			if($rs->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'user already exist'));
				return;
			}
			json(array('error'=>false,'message'=>'user already exist'));
			return;
		}
		show_404();
	}
	public function check_email_exist()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->input->get('id',true);
			$username = $this->input->get('username',true);
			if(!empty($id))
			{
				 
				$this->db->where('id!=',$id);
			}
			 
			$rs = $this->db->where('email',$username)->get("users");
			if($rs->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'user already exist'));
				return;
			}
			json(array('error'=>false,'message'=>'user already exist'));
			return;
		}
		show_404();
	}
	public function edit($ids='')
	{
		$level = 1; 
		$su = $level;
		$this->db->where('level',$level);
		$this->db->where('id',$ids);
		$rs = $this->db->get("users");
		if($rs->num_rows()==1)
		{
			if($this->input->post() && $this->input->is_ajax_request())
			{
				$old = $rs->row_array();
				$in_db = $_POST; //$this->input->post();
				$time = time();
				$in_db['updated_by'] = user_info('id');
				$in_db['updated_on'] = $time;
				 
				unset($in_db['avatar_s']);
				if($_FILES['avatar']['error']==0)
				{
					$name = get_unique_file($_FILES['avatar']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
					{
						$in_db['avatar'] = $name;
						if(!empty($old['avatar']) && file_exists(config_item('upload_path').$old['avatar']))
						{
							unlink(config_item('upload_path').$old['avatar']);
						}
					}
				}
				$in_db['telp'] = ltrim($in_db['telp'],'0');
				$in_db['telp'] = ltrim($in_db['telp'],'62');
				$in_db['telp'] = ltrim($in_db['telp'],'+62');
				$this->db->trans_begin();
				$id_items_supply = '';
				 
				$arr_old = $this->db->where('id',$ids)->get('users')->row_array();
				$this->db->where('id',$in_db['id']);
				$this->db->update("users",$in_db);
				 
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
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$level = '';
			switch($su)
			{
				case 1:
					$level = 'Admin';
				break;
				case 0:
					$level = 'Customer';
				break;
				case 2:
					$level = 'Seller';
				break;
				 
				break;
			}
			$in['use_hedaer'] = true;
			$in['title'] = 'User Management';
			$in['desc'] = 'you can manage users here';
			$in['bread']['#'] = 'Configuration';
			$in['bread']['#'] = 'Users';
			$in['tpl'] = 'users/form';
			$in['level_users'] = $su;
			$in['url_submit'] = site_url('users/edit/'.$ids);
			$in['titles'] = "Admin"; 
			$in['bread'][''] = 'Configuration';
			$in['bread'][site_url('users')] = 'Admin'; 
			$in['bread'][site_url('users/edit/'.$ids)] = 'edit'; 
			$in['mode'] = 'edit';
			$in['data'] = $rs->row_array();
			 
			$this->load->view('manager/layout',$in);
			return;
		}
		show_404();
	}
	public function profile()
	{
		$ids = user_info("id");
		 
		$level = 1; 
		$su = $level;
		//$this->db->where('level',$level);
		$this->db->where('id',$ids);
		$rs = $this->db->get("users");
		if($rs->num_rows()==1)
		{
			if($this->input->post() && $this->input->is_ajax_request())
			{
				$old = $rs->row_array();
				$in_db = $_POST; //$this->input->post();
				$time = time();
				$in_db['updated_by'] = user_info('id');
				$in_db['updated_on'] = $time;
				 
				 
				unset($in_db['avatar_s']);
				if($_FILES['avatar']['error']==0)
				{
					$name = get_unique_file($_FILES['avatar']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['avatar']['tmp_name'],config_item('upload_path').$name))
					{
						$in_db['avatar'] = $name;
						if(!empty($old['avatar']) && file_exists(config_item('upload_path').$old['avatar']))
						{
							unlink(config_item('upload_path').$old['avatar']);
						}
					}
				}
				$in_db['telp'] = ltrim($in_db['telp'],'0');
				$in_db['telp'] = ltrim($in_db['telp'],'62');
				$in_db['telp'] = ltrim($in_db['telp'],'+62');
				$this->db->trans_begin();
				$id_items_supply = '';
				 
				
				$this->db->where('id',$in_db['id']);
				$this->db->update("users",$in_db);
				
				 
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
				else
				{
					$this->db->trans_commit();
					$arr_old = $this->db->where('id',$ids)->get('users')->row_array();
					if($ids==user_info("id"))
					{
						$this->session->set_userdata('adminsospawn_login',$arr_old);	
					} 			
					json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
					return;
				}
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$level = '';
			switch($su)
			{
				case 1:
					$level = 'Admin';
				break;
				case 0:
					$level = 'Customer';
				break;
				case 2:
					$level = 'Seller';
				break;
				 
				break;
			}
			$in['use_hedaer'] = true;
			$in['title'] = 'User Management';
			$in['desc'] = 'you can manage users here';
			  
			$in['tpl'] = 'users/profile';
			$in['level_users'] = $su;
			$in['url_submit'] = site_url('users/profile');
			$in['titles'] = "Profile"; 
			$in['bread'][''] = 'Dashboard';
			$in['bread'][site_url('profile')] = 'Profile'; 
			$in['mode'] = 'edit';
			$in['data'] = $rs->row_array();
			 
			$this->load->view('manager/layout',$in);
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
			$rs = $this->db->get("users");
			if($rs->num_rows()==1)
			{		
				$this->db->where('id',$id)->update("users",array('avatar'=>''));
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
	public function delete()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$this->db->trans_begin();
			$id = $this->input->post('id');
			if(is_array($id))
				$rs = $this->db->where_in('id',$id)->delete("users");
			else
				$rs = $this->db->where('id',$id)->delete("users");
			 
			
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
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	public function reset_password()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$in = $_POST;//$this->input->post();
			$this->db->trans_begin();
			$this->db->where('id',$in['id']);
			$this->db->update('users',array('password'=>$this->encryption->encrypt($in['pass'])));
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
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	
	 
}