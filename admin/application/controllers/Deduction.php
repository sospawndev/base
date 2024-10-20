<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Deduction extends Smart_Controller
{
	private $_users;
	public function __construct()
	{
		parent::__construct();

		 
	}
	public function index()
	{
		$in['arr'] = $this->db->get('v_customer')->result_array();
		$in['use_hedaer'] = true;
		$in['title'] = 'Deduction';
		$in['desc'] = 'you can manage your Deduction here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/deduction')] = 'Deduction';
		$in['tpl'] = 'deduction/main';
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_deduction.id';
			$columns    = array(
			array('db'=>'m_deduction.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			
			array('db'=>'m_v_customer.pid','dt'=>1,'alias'=>'pid','formatter'=>function($d,$row){
				return "A-".$d;
			}),  
			array('db'=>"concat(m_v_customer.email,'<br/>')",'dt'=>2,'alias'=>'infos','formatter'=>function($d,$row){
				return $d;
			}), 
			array('db'=>'m_deduction.balance','dt'=>3,'alias'=>'balance','formatter'=>function($d,$row){
				return number_format($d,2);
			}), 
			array('db'=>'m_deduction.total','dt'=>4,'alias'=>'total','formatter'=>function($d,$row){
				return number_format($d,2);
			}), 
			array('db'=>'m_deduction.tgl','dt'=>5,'alias'=>'tgl','formatter'=>function($d,$row){
				return date('Y-m-d H:is',strtotime($d));
			}), 
			 
			array('db'=>'m_deduction.id','dt'=>6,'alias'=>'id','formatter'=>function($d,$row){
				/*
				return ' <button class="btn btn-xs btn-sm btn-warning btn-sm btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit " data-ref="'.$d.'"><i class="fa fa-pencil"></i></button>
						  <button class="btn btn-xs btn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
				*/		 
				return '  <button class="btn btn-xs btn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			);
			$table = 'm_deduction inner join m_v_customer on(m_deduction.id_customer=m_v_customer.id)';
			$whereResult = NULL;
			$whereAll = '';
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
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
				
			$this->db->delete('deduction');
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
		 
			$data = $this->db->get('deduction');
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
			$ch = $this->db->where('id',$in['id_customer'])->get('v_customer')->row_array();
			if(!isset($ch['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			/*
			if($in['total']>$ch['balance'])
			{
				json(array('error'=>true,'message'=>"Deduction Balance Cannot be procces",'security'=>token()));
				return;
			}
			*/
			$in['tgl'] = date('Y-m-d H:i:s');
			$in['balance'] = $ch['balance'];
			$in['customer_info'] = json_encode($ch);
			$this->db->trans_begin();
			$time = time();
			 
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('deduction',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('deduction');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('deduction',$in);
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
			->update('deduction',array("displays"=>$in['displays']));
			
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