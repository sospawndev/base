<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Language extends Smart_Controller
{
	private $_users;
	public function __construct()
	{
		parent::__construct();

		 
	}
	public function index()
	{
		//$v = ((18/100)/365)*10000000;
		//echo $v;
		//exit;
		$in['use_hedaer'] = true;
		$in['title'] = 'Language';
		$in['desc'] = 'you can manage your Language here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/language')] = 'Language';
		$in['tpl'] = 'language/main';
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_language.id';
			$columns    = array(
			array('db'=>'m_language.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			
			 
			array('db'=>'m_language.name','dt'=>1,'alias'=>'language','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>'m_language.code','dt'=>2,'alias'=>'code','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>"m_language.image",'dt'=>3,'alias'=>'image','formatter'=>function($d,$row){
				if(!empty($d))
				{
					$name = getThumb($d,200,100);
					if(file_exists($this->config->item('cache_path').$name))
					{
						return '<img src="cache/'.$name.'" class="img-thumbnail">';
					}
				}
				return '';
			}),
			array('db'=>"m_language.displays",'dt'=>4,'alias'=>'displays','formatter'=>function($d,$row){
				 if($d==1)
				 {
					return "<a href='javascript:void(0);' class='btn btn-checked'  data-ref='".$row->id."' data-check='".$d."'><i class='fa fa-check'></i></a>";	 
				 }
				 return "<a href='javascript:void(0);' class='btn btn-checked'  data-ref='".$row->id."' data-check='".$d."'><i class='fa fa-ban'></i></a>";
			}),
			array('db'=>'m_language.id','dt'=>5,'alias'=>'id','formatter'=>function($d,$row){
				return ' <button class="btn btn-xs btn-sm btn-warning btn-sm btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit " data-ref="'.$d.'"><i class="fa fa-pencil"></i></button>
						  <button class="btn btn-xs btn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			);
			$table = 'm_language';
			$whereResult = NULL;
			$whereAll = '';
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function delete_logo()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			
			$this->db->where('id',$id);
			$rs = $this->db->get('language');
			if($rs->nus_rows()!=1)
			{
				json(array('error'=>true,'message'=>'Data not found','security'=>token()));
				return;
			}
			 
			$this->db->update('language',array('image'=>''));
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
				
			 
			
			if(is_array($id))
				$this->db->where_in('id',$id);
			else
				$this->db->where('id',$id);
				
			$this->db->delete('language');
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
		 
			$data = $this->db->get('language');
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
			unset($in['img-container']);
			if($_FILES['image']['error']==0)
			{
				$name = get_unique_file($_FILES['image']['name']);
				if(move_uploaded_file($_FILES['image']['tmp_name'],$this->config->item('upload_path').$name))
				{
					$in['image'] = $name;
				}
			} 
			$this->db->trans_begin();
			$time = time();
			 
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('language',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('language');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('language',$in);
				}
				else
				{
					echo json_encode(array('error'=>true,'message'=>'Data not found','security'=>token()));
					exit;
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
	public function displays()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$in = $this->input->post(); 
			if($in['displays']==1)
			{
				$in['displays']=0;
			}
			else
			{
				$in['displays'] = 1;
				 
			}
			$this->db->trans_begin();	
			$this->db->where('id',$in['id'])
			->update('language',array("displays"=>$in['displays']));
			
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
}