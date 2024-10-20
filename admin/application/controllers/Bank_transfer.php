<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank_transfer extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Bank transfer';
		$in['desc'] = 'you can manage your province here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/bank_transfer')] = 'Bank_transfer';
		$in['tpl'] = 'bank_transfer/main';
		$in['list_bank'] = $this->db->order_by('name','ASC')->get('bank')->result_array();
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_bank_transfer.id';
			$columns    = array(
			array('db'=>'m_bank_transfer.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_bank_transfer.qrcodes",'dt'=>1,'alias'=>'qrcodes','formatter'=>function($d,$row){
				if(!empty($d) && is_file(config_item('upload_path').$d) && file_exists(config_item('upload_path').$d))
				{
					$thumb = getThumb($d,100,90);
					return '<img class="img-thumbnail" src="cache/'.$thumb.'"  >';
				}
				return '';
			}),
			array('db'=>"m_bank.name",'dt'=>2,'alias'=>'province'),
			array('db'=>"m_bank_transfer.no_rekening",'dt'=>3,'alias'=>'no_rekening'),
			array('db'=>"m_bank_transfer.atas_nama",'dt'=>4,'alias'=>'atas_nama'),
			array('db'=>"m_bank_transfer.address",'dt'=>5,'alias'=>'address'),
			array('db'=>"m_bank_transfer.displays",'dt'=>6,'alias'=>'displays','formatter'=>function($d,$row){
				  $a = '<a class="btn btn-xs btn-danger btn-sm  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->id.'" data-check="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->id.'" data-check="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
				 
				 
			}),
			array('db'=>'m_bank_transfer.id','dt'=>7,'alias'=>'id','formatter'=>function($d,$row){
				return '
							<button class="btn btn-xs btn-warning btn-sm btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></button>
							<button class="btn btn-xs btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			);
			$table = 'm_bank_transfer INNER JOIN m_bank ON m_bank_transfer.id_bank=m_bank.id';
			$whereResult = NULL;
			$whereAll = '1=1';
			
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
			$this->db->delete('bank_transfer');
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
			$data = $this->db->get('bank_transfer');
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
			if(isset($in['img-container']))
			unset($in['img-container']);
			
			if($_FILES['image']['error']==0)
			{
				$name = get_unique_file($_FILES['image']['name']);
				if(move_uploaded_file($_FILES['image']['tmp_name'],$this->config->item('upload_path').$name))
				{
					$in['qrcodes'] = $name;
				}
			}
			$in['bank_info'] = json_encode($this->db->where('id',$in['id_bank'])->get("bank")->row_array());
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('bank_transfer',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('bank_transfer');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('bank_transfer',$in);
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
			->update('bank_transfer',array("displays"=>$in['displays']));
			
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