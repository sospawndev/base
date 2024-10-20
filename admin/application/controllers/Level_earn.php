<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_earn extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Level earn';
		$in['desc'] = 'you can manage your Level earn here';
		$in['bread']['#'] = 'Level_earn';
		$in['bread'][site_url('manager/level_earn')] = 'Level_earn';
		$in['tpl'] = 'level_earn/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_level_earn.id';
			$columns    = array(
			 
			array('db'=>"m_level_earn.level",'dt'=>0,'alias'=>'level'),
			array('db'=>"concat(m_level_earn.min_invest,'')",'dt'=>1,'alias'=>'min_invest','formatter'=>function($d,$row){
				 return $d." ".settings('coin_name');
			}),   
			array('db'=>"if(m_level_earn.under_umbrealla=0,'',m_level_earn.under_umbrealla)",'dt'=>2,'alias'=>'under_umbrealla','formatter'=>function($d,$row){
				  
					 if(!empty($row->level_from_name))
					 {
						 /*if($row->level_from==-1)
						 {
							$row->level_from = "Direct Line(".$d.")";	 
						 }*/
						 $htmls = $row->level_from_name."(".$row->level_from.")"; 
						 $htmls.= "<br/> Under umbrella(".$d.")";
						 if($d==-1)
						 {
							$htmls = $row->level_from_name."<br/>(Direct Push <b>".$row->level_from."</b>)"; 
						 	 
						 }
						 return $htmls;
					 }
				 
				 return $d;
			}), 
			array('db'=>"concat(m_level_earn.refferal_reward,'%')",'dt'=>3,'alias'=>'refferal_reward','formatter'=>function($d,$row){
				 if($row->refferal_reward=="0.00%")
				 {
					 if(!empty($row->level_from_name) && !empty($row->level_from))
					 {
						 if($row->level_from==-1)
						 {
							$row->level_from = "Direct Line";	 
						 }
						 return $row->level_from_name." (".$row->level_from.")";
					 }
				 }
				 return $d;
			}), 
			/*
			array('db'=>"concat(m_level_earn.refferal_share,'')",'dt'=>3,'alias'=>'refferal_share','formatter'=>function($d,$row){
				 $uy = $d;
				 if(!empty($d))
				 {
					 $e = explode(",",$d);
					 if(is_array($e))
					 {
						 $cu = array();
						 for($i=0;$i<count($e);$i++)
						 {
							 $cu[] = $e[$i]."% ";
						 }
						 if(is_array($cu))
					 	{
						   return implode(",",$cu);
						}
					 }
				 }
				 return $uy;
			}), 
			*/ 
			array('db'=>"concat(m_level_earn.static_reward,'')",'dt'=>4,'alias'=>'static_reward','formatter'=>function($d,$row){
				 $uy = $d;
				 if(!empty($d))
				 {
					 $e = explode(",",$d);
					 if(is_array($e))
					 {
						 $cu = array();
						 for($i=0;$i<count($e);$i++)
						 {
							 $cu[] = $e[$i]."% ";
						 }
						 if(is_array($cu))
					 	{
						   return implode(",",$cu);
						}
					 }
				 }
				 return $uy;
			}),  
			array('db'=>'m_level_earn.displays','dt'=>5,'alias'=>'displays','formatter'=>function($d,$row){
				 $a = '<a class="btn btn-xs btn-danger  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
			}), 
			array('db'=>'m_level_earn.id','dt'=>6,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							
							<a href='.site_url('level_earn/edit/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			array('db'=>"m_level_earn.level_from_name",'dt'=>7,'alias'=>'level_from_name'), 
			array('db'=>"m_level_earn.level_from",'dt'=>8,'alias'=>'level_from'), 
			
			);
			$table = 'm_level_earn';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function getlist_()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_level_earn.id';
			$columns    = array(
			 
			array('db'=>"m_level_earn.level",'dt'=>0,'alias'=>'level'),
			array('db'=>"m_level_earn.min_invest",'dt'=>1,'alias'=>'min_invest','formatter'=>function($d,$row){
				  
				 return $d." ". settings('coin_name');
			}), 
			array('db'=>"if(m_level_earn.under_umbrealla=0,'',m_level_earn.under_umbrealla)",'dt'=>2,'alias'=>'under_umbrealla','formatter'=>function($d,$row){
				 if(empty($d))
				 {
					 if(!empty($row->level_from_name) && !empty($row->level_from))
					 return $row->level_from_name." (".$row->level_from.")";
				 }
				 return $d;
			}), 
			array('db'=>"concat(m_level_earn.refferal_reward,'%')",'dt'=>3,'alias'=>'refferal_reward'),
			array('db'=>"if(m_level_earn.node_earning=0,'',concat(m_level_earn.node_earning,'%'))",'dt'=>4,'alias'=>'node_earning'),
			array('db'=>"m_level_earn.achievement_desc",'dt'=>5,'alias'=>'achievement_desc'),
			array('db'=>"m_level_earn.mine_rev_desc",'dt'=>6,'alias'=>'mine_rev_desc'),
			
			array('db'=>'m_level_earn.displays','dt'=>7,'alias'=>'displays','formatter'=>function($d,$row){
				 $a = '<a class="btn btn-xs btn-danger  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
			}), 
			array('db'=>'m_level_earn.id','dt'=>8,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							
							<a href='.site_url('level_earn/edit/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			array('db'=>"m_level_earn.level_from_name",'dt'=>9,'alias'=>'level_from_name'), 
			array('db'=>"m_level_earn.level_from",'dt'=>10,'alias'=>'level_from'), 
			
			);
			$table = 'm_level_earn';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add()
	{
		  
		 
		$in['use_hedaer'] = true;
		$in['title'] = ' level earn';
		$in['desc'] = 'you can manage your   here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/level_earn')] = '';
		$in['tpl'] = 'level_earn/form';
		 
		$this->load->view('manager/layout',$in);
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('level_earn');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$in['data'] = $data;
				$in['use_hedaer'] = true;
				$in['title'] = ' level_earn';
				 
				$in['desc'] = 'you can manage your level_earn here';
				$in['bread']['#'] = 'level_earn';
				$in['bread'][site_url('manager/level_earn')] = 'level_earn';
				$in['tpl'] = 'level_earn/form';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
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
			$this->db->delete('level_earn');
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
			$data = $this->db->get('level_earn');
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
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('level_earn',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('level_earn');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('level_earn',$in);
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
	public function defaults()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$in = $this->input->post(); 
			$this->db->trans_begin();
			
			 
			if($in['displays']==1)
			{
				$in['displays']=0;
			}else
			{
				 
				$in['displays'] = 1;
				
			}
			 
			$this->db->where('id',$in['id'])
			->update('level_earn',array("displays"=>$in['displays']));
			
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