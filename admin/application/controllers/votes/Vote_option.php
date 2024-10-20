<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_option extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index($ids = "")
	{
		if(!empty($ids))
		{
			$rec = $this->db->where('id',$ids)->get('vote');
			if($rec->num_rows()==1)
			{
				$in['param_id'] = $ids;
				$in['vote'] = $rec->row_array();
 				$in['use_hedaer'] = true;
				
				$in['title'] = ' Vote option';
				$in['desc'] = 'you can manage your Vote option here';
				$in['bread']['#'] = 'Vote_option';
				$in['bread'][site_url('manager/vote')] = 'Vote_option';
				$in['tpl'] = 'votes/vote_option/main';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
		}
		show_404();
		return;
	}
	public function getlist($id = "")
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_vote_option.id';
			$columns    = array(
			 
			
			array('db'=>"m_vote_option.name",'dt'=>0,'alias'=>'categorys','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_vote_option.description",'dt'=>1,'alias'=>'description','formatter'=>function($d,$row){
				 return $d;
			}), 
			  
			array('db'=>"m_vote_option.image",'dt'=>2,'alias'=>'images','formatter'=>function($d,$row){
				if(!empty($d) && is_file(config_item('upload_path').$d) && file_exists(config_item('upload_path').$d))
				{
					$thumb = getThumb($d,100,90);
					return '<img class="img-thumbnail" src="cache/'.$thumb.'"  >';
				}
				return '';
			}), 
			 
			array('db'=>'m_vote_option.id','dt'=>3,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							 
							
							<a href='.site_url('votes/vote_option/edit/'.$row->id_vote.'/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
							 
						 ';
			}),
			 
			array('db'=>"m_vote_option.id_vote",'dt'=>4,'alias'=>'id_vote','formatter'=>function($d,$row){
				 return $d;
			}), 
			
			);
			$table = 'm_vote_option';
			$whereResult = NULL;
			$whereAll = "m_vote_option.id_vote='".$id."'";
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add($ids = "")
	{
		if(!empty($ids))
		{
			$rec = $this->db->where('id',$ids)->get('vote');
			if($rec->num_rows()==1)
			{
				$in = array();  
				$in['param_id'] = $ids;
				$in['vote'] = $rec->row_array();
 				$in['vote_category'] = $this->db->get("vote_category")->result_array();   
				$in['use_hedaer'] = true;
				$in['title'] = ' vote';
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/vote')] = '';
				$in['tpl'] = 'votes/vote_option/form';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
		}
		redirect("vote");
		return;
		 
		
	}
	public function edit($ids = "",$id)
	{
		if(!empty($ids))
		{
			$recs = $this->db->where('id',$ids)->get('vote');
			if($recs->num_rows()==1)
			{
				if(!empty($id))
				{
					$rec = $this->db->where('id',$id)->get('vote_option');
					if($rec->num_rows()==1)
					{
						$data = $rec->row_array();
						$in['data'] = $data;
						$in['param_id'] = $ids;
						$in['vote'] = $recs->row_array();
						$in['vote_category'] = $this->db->get("vote_category")->result_array(); 
						$in['use_hedaer'] = true;
						$in['title'] = ' vote';
						 
						$in['desc'] = 'you can manage your vote here';
						$in['bread']['#'] = 'vote_option';
						$in['bread'][site_url('manager/vote')] = 'vote_option';
						$in['tpl'] = 'votes/vote_option/form';
						 
						$this->load->view('manager/layout',$in);
						return;
					}
				}
			}
		}
		show_404();
	}
	public function delete()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			if(is_array($id))
				$this->db->where_in('id',$id);
			else
				$this->db->where('id',$id);
			$this->db->delete('vote_option');
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
	 
	public function match()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true);
			$this->db->where('id',$id);
			$data = $this->db->get('vote_option');
			if($data->num_rows()==1)
			{
				json(array('error'=>false,'message'=>'one data found','data'=>$data->row_array(),'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'data not found','security'=>token()));
			return;
		}
		show_404();
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
				if(isset($in['image_s']))
				unset($in['image_s']);
				if($_FILES['image']['error']==0)
				{
					$name = get_unique_file($_FILES['image']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['image']['tmp_name'],config_item('upload_path').$name))
					{
						$in['image'] = $name;
						 
					}
			 	} 
			if(empty($in['id']))
			{
				 
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('vote_option',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('vote_option');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('vote_option',$in);
				}
				else
				{
					json(array('error'=>true,'message'=>'Data not found','security'=>token()));
					return;
				}
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
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	public function defaults()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$in = $this->input->post(); 
			$this->db->trans_begin();
			
			 
			if($in['displays']==1)
			{
				$in['displays']=0;
			}else
			{
				 
				$in['displays'] = 1;
				
			}
			 
			$this->db->where('id',$in['id'])
			->update('vote_option',array("displays"=>$in['displays']));
			
			if($this->db->trans_status() === FALSE)
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
	public function delete_image()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$this->db->trans_begin();
			$id = $this->input->post('id');
			$this->db->where('id',$id);
			$rs = $this->db->get("vote_option");
			if($rs->num_rows()==1)
			{		
				$this->db->where('id',$id)->update("vote_option",array('image'=>''));
				$old = $rs->row_array();
				if(!empty($old['logo']) && file_exists(config_item('upload_path').$old['image']))
				{
					unlink(config_item('upload_path').$old['image']);
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