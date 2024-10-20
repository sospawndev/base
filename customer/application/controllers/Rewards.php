<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends Smart_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		 parent::__construct();
		 
	}
	public function index()
	{
		
		$in = array(); 
		 
		$in['ref'] = $this->db
						->where('refferal',user_info('id'))
						->get('v_customer')->num_rows();
		
		$team = $in['ref'];
		$_SESSION['levelusers_aleo'] = array();	
		//get_users_level(user_info('id'),true);
		get_users_level(user_info('id'),false);
		$arr_ref = $_SESSION['levelusers_aleo'];
		$cinfo =0;
		for($i=0;$i<count($arr_ref);$i++)
		{
			
			$cinfo +=  ref_count($arr_ref[$i]['id']); //$arr_ref[$i]['perfomance_under'];	
		}
		$in['arr_ref'] = $arr_ref;	
		$in['cinfo'] = $cinfo;
		
		/*
		$_SESSION['levelusers_aleo'] = array();	
		get_users_level(user_info('id'),false);
		$earn_ref = $_SESSION['levelusers_aleo'];
		$in['earn_ref'] = $earn_ref;	
		*/
		$user_id = array();
		for($i=0;$i<count($arr_ref);$i++)
		{
			$user_id[] = $arr_ref[$i]['id'];
		}
		/*
		$sql = "select m_buy_ref.*, m_buy.pid, m_buy.id_customer from m_buy_ref inner join m_buy on(m_buy.id=m_buy_ref.id_buy) inner join m_v_customer on(m_buy.id_customer=m_v_customer.id) where m_buy.id_customer in('".implode("','",$user_id)."') and m_buy_ref.to_customer='".user_info('id')."' ";
		*/
		$sql = "select m_buy_ref.*,m_buy.tanggal, m_buy.pid, m_buy.id_customer from m_buy_ref inner join m_buy on(m_buy.id=m_buy_ref.id_buy) inner join m_v_customer on(m_buy.id_customer=m_v_customer.id) where   m_buy_ref.to_customer='".user_info('id')."' order by m_buy_ref.id desc";
		$dd = $this->db->query($sql)->result_array();	
		$in['earnsv'] = $dd;										
		$in['team_info'] = $team;	
		/*
		//testing
		*/
		/*
		$_SESSION['levelusers_aleo_with'] = array();	
		get_users_refferal_with(user_info('refferal'),my_level(user_info('id')),true,0);
		print_r($_SESSION['levelusers_aleo_with']);
		exit;
		*/
		$in['bread']['#'] = 'reward';
		
		$in['title'] = ""; 
		$in['tpl'] = "rewards/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function viewc($params = "")
	{
		if(!empty($params))
		{
			$rec = $this->db
					->select("m_buy.*,m_buy_ref.total as ref_total")
					->where('m_buy_ref.id_customer',$params)
					->join("m_buy","m_buy.id=m_buy_ref.id_buy")
					->get("buy_ref");
			if($rec->num_rows()>0)
			{
				$arr = $rec->result_array();
				$in['arr'] = $arr;
				$in['id'] = $params;	
				$in['bread']['#'] = 'reward';
				
				$in['title'] = ""; 
				$in['tpl'] = "rewards/list";
				$this->load->view('manager/layout',$in);
				return;
			}
		}
		redirect("rewards");
		return;
	}
	
	public function getview()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$in = $this->input->get();
			$in['arr'] = $this->db
					->select("m_buy.*,m_buy_ref.total as ref_total")
					->where('m_buy_ref.id_customer',$in['id_customer'])
					->join("m_buy","m_buy.id=m_buy_ref.id_buy")
					->get("buy_ref")->result_array();
			$temps = $this->load->view('manager/rewards/list', $in, true);
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,"temp"=>$temps,'security'=>token()));
			return;
		}
	}
	public function gettree()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$in = $this->input->get();
			 
			$temps = $this->load->view('manager/jtree/main_tree', $in, true);
			json(array('error'=>false,'message'=>'Proccess',"arr"=>$in,"temp"=>$temps,'security'=>token()));
			return;
		}
	}
	 
}

