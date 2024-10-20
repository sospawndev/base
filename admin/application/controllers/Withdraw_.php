<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Withdraw';
		$in['desc'] = 'you can manage your Withdraw here';
		$in['bread']['#'] = 'Withdraw';
		$in['bread'][site_url('manager/package')] = 'Withdraw';
		$in['tpl'] = 'withdraw/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_withdraw.id';
			$columns    = array(
			 
			array('db'=>"concat('W-',m_withdraw.id)",'dt'=>0,'alias'=>'pid'),
			array('db'=>"CONCAT(m_customer.name,'<br/>(',m_customer.email,')')",'dt'=>1,'alias'=>'custs'),
			 
			array('db'=>"m_withdraw.tgl",'dt'=>2,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_withdraw.value_total",'dt'=>3,'alias'=>'value_total','formatter'=>function($d,$row){
				$cx = number_format($d,2);
				$fd = $cx;
				if($row->wd_additionalfee>0)
				{
					$fd = number_format($row->total,2); 
					 
					
					$fd .= "<br/><small><b>Additional Fee ".number_format($row->wd_additionalfee,2)." </b><small>";
					$fd .= "<br/> <b>Total : ".number_format($d,2)." </b>";
					
				}
				return $fd ;
			}), 
			 
			array('db'=>"m_withdraw.atas_nama",'dt'=>4,'alias'=>'atas_nama'),
			array('db'=>"m_withdraw.no_rekening",'dt'=>5,'alias'=>'no_rekening'),
			array('db'=>"m_withdraw.namaBank",'dt'=>6,'alias'=>'namaBank'),
			array('db'=>"m_withdraw.partner_reff",'dt'=>7,'alias'=>'partner_reff'),
			array('db'=>"m_withdraw.status",'dt'=>8,'alias'=>'status','formatter'=>function($d,$row){
				  
				 $bg = array("orange","green","red");
				 $bg_color = isset($bg[$d])?"background:".$bg[$d]."; color:white;":"";
				 if($d==1)
				 {
					 return "<span   style='padding:7.5px;".$bg_color."'>".payments($d)."</span>";
				 }
				 if($d==2)
				 {
					 $yy =  "<b>".payments($d)."</b>";
					 $yy .= "<br/><p><b>Reason</b>: ".$row->respond_txt."</p>";
					 return $yy;
				 }
				 return "<button   style='padding:7.5px; ".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
			}), 
			 array('db'=>'m_withdraw.id','dt'=>9,'alias'=>'id','formatter'=>function($d,$row){
				if($row->status!=1)
				{
					return ' 
							<span>	 
							 
								<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
							</span>	
							 ';
				} 
				if($row->status==1)
				{
					return ' 
							<span>	 
								<button class="btn btn-xs btn-sm btn-warning btn-resend-notif" type="button" data-toggle="tooltip" title="" data-original-title="Resend Notif" data-ref="'.$row->ids.'"><i class="fa fa-send"></i></button>
								 
							</span>	
							 ';
				}
			 }),
			 array('db'=>"m_withdraw.id",'dt'=>10,'alias'=>'ids'),
			 array('db'=>"m_withdraw.admin_fee",'dt'=>11,'alias'=>'admin_fee'), 
			 array('db'=>"m_withdraw.total",'dt'=>12,'alias'=>'total'), 
			 array('db'=>"m_withdraw.wd_additionalfee",'dt'=>13,'alias'=>'wd_additionalfee'),  
			  array('db'=>"m_withdraw.respond_txt",'dt'=>14,'alias'=>'respond_txt'),
			  
			);
			$table = 'm_withdraw inner join m_customer on (m_customer.id = m_withdraw.id_customer)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			if(isset($_GET['status']))
			{
				if($_GET['status']!=-1)
				{
					$whereAll = "m_withdraw.status='".$_GET['status']."'";
				}
			} 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function status()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$check = $this->db->where('id',$in['id'])->get('withdraw')->row_array();
			if(!isset($check['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			//
			//$price_coin = settings("price_coin"); 
			
			//
			$customer =  $this->db->where('id',$check['id_customer'])->get('customer')->row_array();
			if(!isset($customer['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			 
			 
			$this->db->trans_begin();
			// update order
			$this->db->where('id',$in['id'])->update('withdraw',array("status"=>$in['status'],"tx_hash"=>$in['tx_hash'],"reads"=>1));
			
			 
			
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				if($in['status']==1)
				{
					$ins = $this->db->where('id',$in['id'])->get('withdraw')->row_array();	
					$customer =  $this->db->where('id',$ins['id_customer'])->get('customer')->row_array();
					$in['value_total'] = isset($ins['value_total'])?$ins['value_total']:0;
					$in['email'] = $customer['email'];
					$in['tx_hash'] = $ins['tx_hash'];
					$this->send_mail_customer_notif($in);
				}
				 
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	public function resend_notif()
	{
		if($this->input->is_ajax_request() )
		{
			$in = $this->input->post();
			$ins = $this->db->where('id',$in['id'])->get('withdraw')->row_array();	
			if($ins['status']==1)
			{
				
				$customer =  $this->db->where('id',$ins['id_customer'])->get('customer')->row_array();
				$in['value_total'] = isset($ins['value_total'])?$ins['value_total']:0;
				$in['email'] = $customer['email'];
				$in['tx_hash'] = $ins['tx_hash'];
				$this->send_mail_customer_notif($in);
			}
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,'security'=>token()));
			return;
		}
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
			$this->db->delete('withdraw');
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
	#==========
	private function send_mail_customer_notif($in = array())
	{
		 
		$config = Array(
			'protocol' => 'smtp',
			'_smtp_auth' => true,
			 'wordwrap' => true,
			 'priority' =>3,
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => 'noreply@aleominingpool.com',//'info@aleominingpool.com',
			'smtp_pass' => 'WWe45$$#Ghhh',
			'mailtype'  => 'html', 
			'newline' => "\r\n",
			'charset'   => 'iso-8859-1'
		);
		$config['newline'] = "\r\n"; 
		$in['base'] = base_url();
		 
		
		$message = $this->load->view('manager/emails/withdraw_notif', $in, true);
		 
		 
		
		$this->load->library('email');
		 
		$this->email->initialize($config);
		$this->email->from("noreply@aleominingpool.com", "Aleo Mining Pool");
		//$this->email->from(config_item('email'), config_item('site_name'));
		$this->email->to($in['email']);
		$this->email->subject("Aleo Mining Pool - Withdraw Notification");
		$this->email->message($message);
		$this->email->send();

		/*
		print_r($this->email->print_debugger());
		exit;
		*/
		/*
		if($this->email->send())
		{
			print_r($this->email->print_debugger());
			exit;
			return true;
		}
		return false;
		*/ 
	}
}