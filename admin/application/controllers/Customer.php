<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['level_earn'] = $this->db->get('level_earn')->result_array();
		$in['occupation'] = $this->db->get('occupation')->result_array();
		$in['education_level'] = $this->db->get('education_level')->result_array();
		$in['title'] = 'Customer';
		$in['desc'] = 'you can manage your Customer here';
		$in['bread']['#'] = 'Customer';
		$in['bread'][site_url('manager/Customer')] = 'Customer';
		$in['tpl'] = 'customer/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_v_customer.id';
			$columns    = array(
			array('db'=>'m_v_customer.id','dt'=>0,'alias'=>'id_o','formatter'=>function($d,$row){
					return ' 
							<span class="input-group-btn">
							<button class="btn btn-xs btn-sm btn-success btn-view-ref" type="button" data-toggle="tooltip" title="" data-original-title="View Refferal" data-ref="'.$d.'"><i class="fa fa-tree"></i></button>
							 
							 
						</span>	
						 ';
			}),
			array('db'=>'m_v_customer.pid','dt'=>1,'alias'=>'ids','formatter'=>function($d,$row){
				$label = "";
				if($row->phone_verification==1)
				{
					$label = "<span><i class='fa fa-star'></i><span>";
				}
				return "A-".$d." ".$label;
			}),
			 
			
			array('db'=>"m_v_customer.refferal",'dt'=>2,'alias'=>'refferal','formatter'=>function($d,$row){
				 $rec = $this->db->where('id',$d)->get('v_customer');
				 if($rec->num_rows()>0)
				 {
					 $arr = $rec->row_array();
					 $chtml = $arr['email'];
					 $chtml .= "<br/> A-".$arr['pid'];
					 
					 return $chtml;
				 }
				 return "";
			}),
			array('db'=>"m_v_customer.name",'dt'=>3,'alias'=>'infos'),
			array('db'=>"m_v_customer.balance",'dt'=>4,'alias'=>'balances','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_v_customer.id_level_earn",'dt'=>5,'alias'=>'id_level_earn','formatter'=>function($d,$row){
				  $buy = check_buy($row->id);
				 // if($buy>0)
				  //{
					  $levels = my_level($row->id);
					  $names = getuser_level($levels,"level");
					  $name_rank = "";
					  if(empty($d))
					  {
						  $name_rank = "<br/> <small  class='text-center' style='color:red; text-align:center;'><i>Rank System</u></small>";
					  }
					  return ' <span class="row col-12">
									 
									<button class="btn btn-xs btn-sm btn-default btn-ranks" type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-level="'.$levels.'" data-id_level_earn="'.$d.'" data-ref="'.$row->id.'">'.$names.' <i class="fa fa-pencil"></i></button>
									'.$name_rank.'
								</span>	
								 ';
				 // }
				  return "<i class='color-red' style='color:red;'>Not Buy</i>";
			}),
			array('db'=>"m_v_customer.email",'dt'=>6,'alias'=>'email'),
			array('db'=>"m_v_customer.id",'dt'=>7,'alias'=>'bank_info','formatter'=>function($d,$row){
				 /*$rec = $this->db->where('id',$row->id_bank)->get('bank');
				 if($rec->num_rows()==1)
				 {
					$bank = $rec->row_array();
					$vhtml = "Bank :<b>".$bank['name']."</b>";
					$vhtml .= "<br/> No Rek :<b>".$row->no_rekening."</b>";
					$vhtml .= "<br/> Atas Nama :<b>".$row->atas_nama."</b>";
					return $vhtml;
						 
				 }*/
				 if(!empty($row->namaBank) && !empty($row->no_rekening) && !empty($row->atas_nama))
				 {
					$vhtml = "Bank :<b>".$row->namaBank."</b>";
					$vhtml .= "<br/> No Rek :<b>".$row->no_rekening."</b>";
					$vhtml .= "<br/> Atas Nama :<b>".$row->atas_nama."</b>";
					return $vhtml;
				 }
			}),
			array('db'=>"m_v_customer.telp",'dt'=>8,'alias'=>'telp','formatter'=>function($d,$row){
				if($row->phone_verification==1)
				{
					return "+62".$d;
				}
				return $d;
			}),
			array('db'=>"m_v_customer.sex",'dt'=>9,'alias'=>'sex'), 
			array('db'=>"m_v_customer.occupation",'dt'=>10,'alias'=>'occupation'), 
			array('db'=>"m_v_customer.education_level",'dt'=>11,'alias'=>'education_level'), 
			array('db'=>"m_v_customer.religion",'dt'=>12,'alias'=>'religion'), 
			array('db'=>"m_v_customer.age",'dt'=>13,'alias'=>'age'),
			array('db'=>"m_v_customer.tribes",'dt'=>14,'alias'=>'tribes'),
			array('db'=>"m_v_customer.province",'dt'=>15,'alias'=>'province'),
			array('db'=>"m_v_customer.city",'dt'=>16,'alias'=>'city'), 
			array('db'=>"m_v_customer.district",'dt'=>17,'alias'=>'district'), 
			array('db'=>"concat(m_v_customer.ip_address,'<br/> Signature: <b>',m_v_customer.device_id,'</b><br/> Os:<b>',m_v_customer.os_info,'</b><br/> Device: <b>', m_v_customer.platform,'</b>','</b><br/> Last Login: <b>', (select date from m_customer_log where m_customer_log.id_customer=m_v_customer.id order by id desc limit 1),'</b>')",'dt'=>18,'alias'=>'ip_address'), 
			array('db'=>"m_v_customer.status",'dt'=>19,'alias'=>'status','formatter'=>function($d,$row){
				 /*
				 if($d==1)
				 {
					 return status_register($d);//"Active";
				 }
				 */
				 //return status_register($d);
				 if($d==2)
				 {
					 $chtml = "<button class='btn btn-sm btn-status btn-danger'   data-ref='".$row->id_o."'>".status_register($d)."</button>";
					 $chtml .= "<p>Reason :".$row->reason."</p>";
					 return $chtml;//"Active";
				 }
				 return "<button class='btn btn-sm btn-status btn-info'   data-ref='".$row->id_o."'>".status_register($d)."</button>";
			}),
			 
			
			array('db'=>"DATE_FORMAT(FROM_UNIXTIME(m_v_customer.created_on),'%d-%m-%Y')",'dt'=>20,'alias'=>'created_on'),
			array('db'=>'m_v_customer.id','dt'=>21,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<span class="input-group-btn">
							<button class="btn btn-xs btn-sm btn-default btn-reset-users" type="button" data-toggle="tooltip" title="" data-original-title="Reset password user" data-ref="'.$d.'"><i class="fa fa-asterisk"></i></button>
							 
							<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove User" data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						</span>	
						 ';
			}),
			array('db'=>"m_v_customer.id_bank",'dt'=>22,'alias'=>'id_bank'), 
			array('db'=>"m_v_customer.no_rekening",'dt'=>23,'alias'=>'no_rekening'), 
			array('db'=>"m_v_customer.atas_nama",'dt'=>24,'alias'=>'atas_nama'), 
			array('db'=>"m_v_customer.kodeBank",'dt'=>25,'alias'=>'kodeBank'), 
			array('db'=>"m_v_customer.namaBank",'dt'=>26,'alias'=>'namaBank'), 
			array('db'=>"m_v_customer.reason",'dt'=>27,'alias'=>'reason'), 
			array('db'=>"m_v_customer.phone_verification",'dt'=>28,'alias'=>'phone_verification'), 
			array('db'=>"concat('ph-',m_v_customer.phone_verification)",'dt'=>29,'alias'=>'ph_phone_verification'), 
			
			
			);
			$table = 'm_v_customer ';
			$whereResult = NULL;
			$whereAll = 'm_v_customer.type=0';
			if(isset($_GET['occupation']))
			{
				if($_GET['occupation']!=-1)
				{
					$whereAll .= " and lower(m_v_customer.occupation)='".strtolower($_GET['occupation'])."'";
				}
			} 
			if(isset($_GET['education_level']))
			{
				if($_GET['education_level']!=-1)
				{
					$whereAll .= " and lower(m_v_customer.education_level)='".strtolower($_GET['education_level'])."'";
				}
			} 
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
	public function status()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			 
			 
			//
			 
			#== get ref  
			 
			$this->db->trans_begin();
			if($in['status']!=2)
			{
				$in['reason'] = "";	
			}
			$this->db->where('id',$in['id'])->update('customer',array("status"=>$in['status'],"reason"=>$in['reason']));
			
			 
			
			
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