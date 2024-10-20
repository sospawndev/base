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
				 if($d==5 || $d==3)
				 {
					 $yy =  "<b>".payments($d)."</b>";
					 
					 return $yy;
				 }
				 
				 return "<button class='btn-status'  style='padding:7.5px; ".$bg_color."' data-ref='".$row->ids."'>".payments($d)."</button>";
			}), 
			 array('db'=>'m_withdraw.id','dt'=>9,'alias'=>'id','formatter'=>function($d,$row){
				//if($row->status!=1 && $row->status!=2)
				if($row->status==0 )
				{
					return ' 
							<span>	 
							 
								<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
							</span>	
							 ';
				} 
				
				if($row->status!=0 && $row->status!=5)
				{
					return ' 
							<span>	 
							 
								<button class="btn btn-xs btn-sm btn-info btn-infos" type="button" data-toggle="tooltip" title="" data-original-title="Info" data-partner_reff="'.$row->partner_reff.'" data-ref="'.$row->ids.'"><i class="fa fa-info"></i></button>
							</span>	
							 ';
				}
				if($row->status==1)
				{
					/*
					return ' 
							<span>	 
								<button class="btn btn-xs btn-sm btn-warning btn-resend-notif" type="button" data-toggle="tooltip" title="" data-original-title="Resend Notif" data-ref="'.$row->ids.'"><i class="fa fa-send"></i></button>
								 
							</span>	
							 ';
					*/		 
				}
			 }),
			 array('db'=>"m_withdraw.id",'dt'=>10,'alias'=>'ids'),
			 array('db'=>"m_withdraw.admin_fee",'dt'=>11,'alias'=>'admin_fee'), 
			 array('db'=>"m_withdraw.total",'dt'=>12,'alias'=>'total'), 
			 array('db'=>"m_withdraw.wd_additionalfee",'dt'=>13,'alias'=>'wd_additionalfee'),  
			 array('db'=>"m_withdraw.respond_txt",'dt'=>14,'alias'=>'respond_txt'),
			 array('db'=>"m_withdraw.statuses",'dt'=>15,'alias'=>'statuses'),
			  
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
			$wd_additionalfee = floatval(settings("wd_additionalfee"));
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
			 
			if($in['status']==4)
			{
				$check['customer_id'] = "sospawn-".$customer['id'];
				// Signature 
				/*
				$regex = '/[^0-9a-zA-Z]/';
				$path = "/transaction/withdraw/payment";
				$method = "POST";
				$clientID = $check['customer_id'];
				$amount = $check['total'];
				$accountnumber = $check['no_rekening'];
				$partnerreff = $check['partner_reff'];
				$serverKey = "LinkQu@2020";
				$bankcode = $check['kodeBank'];
				$secondvalue = strtolower(preg_replace($regex, "", $amount.$accountnumber.$bankcode.$partnerreff.$clientID));
				$signToString = $path.$method.$secondvalue;
				$signature = hash_hmac('sha256', $signToString , $serverKey);
				*/
				//echo "INPUT: " , $signToString ." \n";
				//echo "SIGNATURE: " , $signature;
			  
				//end signature
				$this->load->library('linkque');	
				$linkqu = $this->linkque->init();
				$trx = $linkqu->transfer();
				if(!isset($check['inquiry_reff']))
				{
					json(array('error'=>true,'message'=>'Respond Proccess Failed','security'=>token()));
					return;
				}
				if(empty($check['inquiry_reff']))
				{
					json(array('error'=>true,'message'=>'Respond Proccess Failed','security'=>token()));
					return;
				}
				
				$trx->wd = $check;
				$trx->customer = $customer;
				
				/*
				$li = $trx->send(function($trx) {
						 
						 $vals = $trx->wd;
						 $customs = $trx->customer;
						 
					     $trx->setAmount($vals['total'])
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_reff'])
					         ->setCustomerName($vals['atas_nama'])
					         ->setCustomerPhone($customs['telp'])
					         ->setCustomerEmail($customs['email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['no_rekening'])
							 ->setInquiryRef($vals['inquiry_reff']); 
					 });
				*/
				$li = $trx->send(function($trx) {
						 
						 $vals = $trx->wd;
						 $customs = $trx->customer;
						 
					     $trx->setAmount($vals['total'])
					         ->setExpired(300)
					         ->setCustomerId($vals['customer_id'])
					         ->setPartnerRef($vals['partner_reff'])
					         ->setCustomerName($vals['atas_nama'])
					         ->setCustomerPhone($customs['telp'])
					         ->setCustomerEmail($customs['email'])
							 ->setBankCode($vals['kodeBank'])
							 ->setaccountNumber($vals['no_rekening'])
							 ->setInquiryRef($vals['inquiry_reff']); 
					 });
				 
				if(!isset($li->status))
				{
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
				if(!isset($li->inquiry_reff))
				{
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
				 
				 
				if($li->status=="SUCCESS")
				{
					$in['status'] = 1;
				}
				if($li->status=="PENDING")
				{
					$in['status'] = 3;
				}
				if($li->status=="FAILED")
				{
					$in['status'] = 2;
				}
				$vv = array();
				$vv['status']  = $in['status'];
				$vv['reads']  = 1;
				$vv['wd_info'] = json_encode($li);
				$vv['respond_txt'] = $li->response_desc;
				$vv['statuses'] = $li->status;
				$vv['wd_additionalfee'] = $wd_additionalfee;
				
				$this->db->where('id',$in['id'])->update('withdraw',$vv);
				
			}else
			{
				$this->db->trans_begin();
				// update order
				$this->db->where('id',$in['id'])->update('withdraw',array("status"=>$in['status'],"tx_hash"=>$in['tx_hash'],"reads"=>1));
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
				if($in['status']==1)
				{
					/*$ins = $this->db->where('id',$in['id'])->get('withdraw')->row_array();	
					$customer =  $this->db->where('id',$ins['id_customer'])->get('customer')->row_array();
					$in['value_total'] = isset($ins['value_total'])?$ins['value_total']:0;
					$in['email'] = $customer['email'];
					$in['tx_hash'] = $ins['tx_hash'];
					$this->send_mail_customer_notif($in);
					*/
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
	private function send_mail_customer_notif_($in = array())
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
	public function balance_get()
	{
		$this->load->library('linkque');
		$linkqu = $this->linkque->init();			
		$resumeAccount = $linkqu->administration()->resumeAccount();	
		if(isset($resumeAccount->balance))
		{
			$resumeAccount->balance = number_format($resumeAccount->balance,0);	
		}
		json(array('error'=>false,'data'=>$resumeAccount,'security'=>token()));
		return;
	}
	public function report_get()
	{
		if($this->input->get())
		{
			$in = $this->input->get();
			if(isset($in['partner_reff']))
			{
				$check = $this->db->where('id',$in['id'])->get('withdraw')->row_array();
				if(isset($check['id']))
				{
					$this->load->library('linkque');
					
					$linkqu = $this->linkque->init();			
					$report = $linkqu->report()->status($in['partner_reff']);	
					if(isset($report->data->inquiry_reff))
					{
						$data = $report->data;
						$data->status = $check['status']; 	
						if(isset($data->status_paid))
						{
							if($data->status_paid=="paid")
							$data->status = 1;	
						} 
						$in['data'] = $data;
						$in['check'] = $check;
						$in['temps'] = $this->load->view('manager/withdraw/report', $in, true); 
						json(array('error'=>false,'data'=>$in,"check"=>$check,'security'=>token()));
						return;
					}
				}
			}
		}
		json(array('error'=>true,'data'=>array(),'security'=>token()));
		return;

	}
	public function status_check()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$vv = array();
			$vv['status']  = $in['status'];
			$vv['reads']  = 1;
			$vv['wd_info'] = json_encode($in);
			$vv['respond_txt'] = $in['status_desc'];
			$vv['statuses'] = $in['status_trx'];
			
			$vv['wd_additionalfee'] = $in['amountfee'];
				
			$this->db->where('id',$in['id'])->update('withdraw',$vv);
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
	}
}