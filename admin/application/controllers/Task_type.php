<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task_type extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['level_earn'] = $this->db->get('level_earn')->result_array();
		$in['title'] = 'Task type';
		$in['desc'] = 'you can manage your Task type here';
		$in['bread']['#'] = 'Task type';
		$in['bread'][site_url('manager/task_type')] = 'Task type';
		$in['tpl'] = 'task_type/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_task_type.id';
			$columns    = array(
			 
			array('db'=>'m_task_type.name','dt'=>0,'alias'=>'names','formatter'=>function($d,$row){
				return $d;
			}),
			 
			  
			array('db'=>"m_task_type.status",'dt'=>1,'alias'=>'status','formatter'=>function($d,$row){
				  return task_type($d);
			}),
			array('db'=>"m_task_type.displays",'dt'=>2,'alias'=>'displays','formatter'=>function($d,$row){
				 if($d==1)
				 {
					return "<a href='javascript:void(0);' class='btn btn-info btn-checked'  data-ref='".$row->id."' data-check='".$d."'><i class='fa fa-check'></i></a>";	 
				 }
				 return "<a href='javascript:void(0);' class='btn btn-danger btn-checked'  data-ref='".$row->id."' data-check='".$d."'><i class='fa fa-ban'></i></a>";
			}), 
			
			array('db'=>'m_task_type.id','dt'=>3,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('task-type/edit/'.$d).' class="btn btn-xs btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							<button class="btn btn-xs btn-danger btn-sm btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}), 
			array('db'=>'m_task_type.id','dt'=>4,'alias'=>'ids','formatter'=>function($d,$row){
				return $d;
			}), 
			
			);
			$table = 'm_task_type ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
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
			->update('task_type',array("displays"=>$in['displays']));
			
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
	public function add()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Task Type';
		$in['desc'] = 'you can manage your Task Type here';
		$in['bread']['#'] = 'Task Type';
		$in['bread'][site_url('manager/task_type')] = 'Task Type';
		$in['tpl'] = 'task_type/form';
		 
		$this->load->view('manager/layout',$in);
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('task_type');
			if($rec->num_rows()==1)
			{
				$in['data'] = $rec->row_array();
				$in['use_hedaer'] = true;
				$in['title'] = 'Master Task Type';
				$in['desc'] = 'you can manage your Task Type here';
				$in['bread']['#'] = 'Task Type';
				$in['bread'][site_url('manager/task_type')] = 'Task Type';
				$in['tpl'] = 'task_type/form';
				 
				$this->load->view('manager/layout',$in);
				return;
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
			$this->db->delete('task_type');
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
			$data = $this->db->get('task_type');
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
			 
			if(empty($in['id']))
			{
				 
				$this->db->insert('task_type',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('task_type');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					$this->db->where('id',$in['id']);
					$this->db->update('task_type',$in);
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
}