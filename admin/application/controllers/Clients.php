<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['level_earn'] = $this->db->get('level_earn')->result_array();
		$in['title'] = 'Clients';
		$in['desc'] = 'you can manage your Clients here';
		$in['bread']['#'] = 'clients';
		$in['bread'][site_url('manager/Clients')] = 'Clients';
		$in['tpl'] = 'clients/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_customer.id';
			$columns    = array(
			 
			 
			array('db'=>"m_customer.company_name",'dt'=>0,'alias'=>'company_name'),
			array('db'=>"m_customer.company_pic",'dt'=>1,'alias'=>'company_pic'),
			array('db'=>"m_customer.telp",'dt'=>2,'alias'=>'telp'),
			array('db'=>"m_customer.company_type_bis",'dt'=>3,'alias'=>'company_type_bis'), 
			array('db'=>"m_customer.email",'dt'=>4,'alias'=>'email'), 
			array('db'=>"m_customer.company_address",'dt'=>5,'alias'=>'company_address'), 
			 
			array('db'=>"m_customer.id",'dt'=>6,'alias'=>'bank_info','formatter'=>function($d,$row){
				 $rec = $this->db->where('id',$row->id_bank)->get('bank');
				 if($rec->num_rows()==1)
				 {
					$bank = $rec->row_array();
					$vhtml = "Bank :".$bank['name'];
					$vhtml .= "<br/> No Rek :".$row->no_rekening;
					$vhtml .= "<br/> Atas Nama :".$row->atas_nama;
					return $vhtml;
						 
				 }
			}), 
			array('db'=>"m_customer.status",'dt'=>7,'alias'=>'status','formatter'=>function($d,$row){
				 if($d==1)
				 {
					 return "active";
				 }
				 return "Non active";
			}),
			 
			
			array('db'=>"DATE_FORMAT(FROM_UNIXTIME(m_customer.created_on),'%d-%m-%Y')",'dt'=>8,'alias'=>'created_on'),
			array('db'=>'m_customer.id','dt'=>9,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<span class="input-group-btn">
							<button class="btn btn-xs btn-sm btn-default btn-reset-users" type="button" data-toggle="tooltip" title="" data-original-title="Reset password user" data-ref="'.$d.'"><i class="fa fa-asterisk"></i></button>
							 
							<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove User" data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						</span>	
						 ';
			}),
			array('db'=>"m_customer.id_bank",'dt'=>11,'alias'=>'id_bank'), 
			array('db'=>"m_customer.no_rekening",'dt'=>12,'alias'=>'no_rekening'), 
			array('db'=>"m_customer.atas_nama",'dt'=>13,'alias'=>'atas_nama'), 
			
			);
			$table = 'm_customer ';
			$whereResult = NULL;
			$whereAll = 'm_customer.type=1';
			
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
			$this->db->delete('customer');
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
			$in = $this->input->post();
			$this->db->trans_begin();
			$this->db->where('id',$in['id']);
			$this->db->update('customer',array('passwords'=>$this->encryption->encrypt($in['pass'])));
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
	public function ranks()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$in = $this->input->post();
			$nc = json_encode(user_level($in['id_level_earn']));
			$this->db->trans_begin();
			 
			
			$this->db->where('id',$in['id'])->update('customer',array('id_level_earn'=>$in['id_level_earn'],'level_earn_info'=>$nc));
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