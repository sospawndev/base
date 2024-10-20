<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Task_payment extends Smart_Controller
{
	private $_users;
	public function __construct()
	{
		parent::__construct();

		 
	}
	public function index()
	{
		 
		$in['use_hedaer'] = true;
		$in['arr'] = $this->db->get('task_type')->result_array();
		$in['title'] = 'Task Payment';
		$in['desc'] = 'you can manage your Task Payment here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/task_payment')] = 'Task Payment';
		$in['tpl'] = 'task_payment/main';
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_task_payment.id';
			$columns    = array(
			 
			
			 
			array('db'=>'m_task_type.name','dt'=>0,'alias'=>'names','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>'m_task_payment.jumlah','dt'=>1,'alias'=>'jumlah','formatter'=>function($d,$row){
				return number_format($d,0);
			}), 
			array('db'=>'m_task_payment.prices','dt'=>2,'alias'=>'prices','formatter'=>function($d,$row){
				return number_format($d,0);
			}), 
			 
			array('db'=>'m_task_payment.id','dt'=>3,'alias'=>'id','formatter'=>function($d,$row){
				return ' <button class="btn btn-xs btn-sm btn-warning btn-sm btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit " data-ref="'.$d.'"><i class="fa fa-pencil"></i></button>
						  <button class="btn btn-xs btn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			);
			$table = 'm_task_payment inner join m_task_type on (m_task_payment.id_task_type = m_task_type.id)';
			$whereResult = NULL;
			$whereAll = '';
			if(isset($_GET['id_task_type']))
			{
				if(!empty($_GET['id_task_type']))
				{
					$whereAll = "m_task_payment.id_task_type='".$_GET['id_task_type']."'";
				}
			} 
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
			$rs = $this->db->get('task_payment');
			if($rs->nus_rows()!=1)
			{
				json(array('error'=>true,'message'=>'Data not found','security'=>token()));
				return;
			}
			 
			$this->db->update('task_payment',array('image'=>''));
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
				
			$this->db->delete('task_payment');
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
		 
			$data = $this->db->get('task_payment');
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
				 
				$this->db->insert('task_payment',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('task_payment');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					 
					$this->db->where('id',$in['id']);
					$this->db->update('task_payment',$in);
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
			->update('task_payment',array("displays"=>$in['displays']));
			
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