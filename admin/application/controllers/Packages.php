<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Packages';
		$in['desc'] = 'you can manage your Packages here';
		$in['bread']['#'] = 'Packages';
		$in['bread'][site_url('manager/package')] = 'Packages';
		$in['tpl'] = 'packages/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_package.id';
			$columns    = array(
			 
			array('db'=>"m_package.name",'dt'=>0,'alias'=>'name'),
			array('db'=>"m_package.perfomances",'dt'=>1,'alias'=>'simbol','formatter'=>function($d,$row){
				 if(empty($d))
				 return "usd";
				 return $d." ". settings('coin_name');
			}), 
			array('db'=>'m_package.displays','dt'=>2,'alias'=>'displays','formatter'=>function($d,$row){
				 $a = '<a class="btn btn-xs btn-danger  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
			}), 
			array('db'=>'m_package.id','dt'=>3,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('package-sub/views/'.$d).' class="btn btn-xs btn-sm btn-info btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-arrow-right"></i></a>
							
							<a href='.site_url('packages/edit/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			 
			
			);
			$table = 'm_package';
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
		$in['title'] = ' package';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/package')] = '';
		$in['tpl'] = 'packages/form';
		 
		$this->load->view('manager/layout',$in);
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('package');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$in['data'] = $data;
				$in['use_hedaer'] = true;
				$in['title'] = ' package';
				 
				$in['desc'] = 'you can manage your package here';
				$in['bread']['#'] = 'package';
				$in['bread'][site_url('manager/package')] = 'package';
				$in['tpl'] = 'packages/form';
				 
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
			$this->db->delete('package');
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
			$data = $this->db->get('package');
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
				$this->db->insert('package',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('package');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('package',$in);
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
			->update('package',array("displays"=>$in['displays']));
			
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
	public function getcoint()
	{
		  
	 	$simbol = file_get_contents(FCPATH."/coinlist.json");	
		$simbol = json_decode($simbol,true);
		
		for($i=0;$i<count($simbol);$i++)
		{
			$simbol[$i]['text'] = $simbol[$i]['name'];
		}
		$arr = $simbol;
		$r = array();
		$r['results'] = $arr;
		$r['pagination']['more'] = false;
		
		json($r);
		return;
	} 
}