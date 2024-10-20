<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Refferal_reward extends Smart_Controller
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
		$in['title'] = 'Refferal reward';
		$in['desc'] = 'you can manage your Refferal reward here';
		$in['bread'][''] = 'Configuration';
		$in['bread'][site_url('manager/refferal_reward')] = 'Refferal reward';
		$in['tpl'] = 'refferal_reward/main';
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_refferal_reward.id';
			$columns    = array(
			array('db'=>'m_refferal_reward.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"concat(a.email)",'dt'=>1,'alias'=>'from_name'),
			array('db'=>"concat(b.email)",'dt'=>2,'alias'=>'types','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_refferal_reward.rewards",'dt'=>3,'alias'=>'rewards','formatter'=>function($d,$row){
				 return number_format($d,0);
			}), 
			  
			 
			 
			
			);
			$table = 'm_refferal_reward inner join m_customer a on(m_refferal_reward.from_users=a.id) inner join m_customer  b on(m_refferal_reward.to_users=b.id)';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
	}
	 
}