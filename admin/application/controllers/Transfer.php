<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Transfer';
		$in['desc'] = 'you can manage your Topup here';
		$in['bread']['#'] = 'Transfer';
		$in['bread'][site_url('manager/package')] = 'Topup';
		$in['tpl'] = 'transfer/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_transfer.id';
			$columns    = array(
			 
			array('db'=>"CONCAT(a.name,'<br/>(',a.email,')')",'dt'=>0,'alias'=>'tos'),
			array('db'=>"CONCAT(b.name,'<br/>(',b.email,')')",'dt'=>1,'alias'=>'froms'),
			 
			array('db'=>"m_transfer.tgl",'dt'=>2,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			 
			array('db'=>"m_transfer.total",'dt'=>3,'alias'=>'value_total','formatter'=>function($d,$row){
				//return number_format($d,2) ;
				$cx = number_format($d,2);
				$fd = $cx;
				if($row->admin_fee>0)
				{
					$fd = number_format($row->full_total,2); 
					 
					
					$fd .= "<br/><small><b>Admin Fee ".number_format($row->admin_fee,2)." </b><small>";
					$fd .= "<br/> <b>Total : ".number_format($d,2)." </b>";
					
				}
				return $fd ;
			}), 
			 array('db'=>"m_transfer.admin_fee",'dt'=>4,'alias'=>'admin_fee'), 
			 array('db'=>"m_transfer.full_total",'dt'=>4,'alias'=>'full_total'),    
			);
			$table = 'm_transfer inner join m_customer a on (a.id = m_transfer.from_customer) inner join m_customer b on (b.id = m_transfer.to_customer)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	 
}