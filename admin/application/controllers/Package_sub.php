<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class package_sub extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function views($params = "")
	{
		if(!empty($params))
		{
			 
			$rec = $this->db->where('id',$params)->get("package");
			
			if($rec->num_rows()>0)
			{
				$in['arr'] = $rec->row_array();
				$in['use_hedaer'] = true;
				
				$in['title'] = ' Package sub';
				$in['desc'] = 'you can manage your Package sub here';
				$in['bread']['#'] = 'Package sub';
				$in['bread'][site_url('manager/package')] = 'Package sub';
				$in['tpl'] = 'package_sub/main';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
		}
		redirect("packages");
		return;
	}
	public function getlist($id = "")
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_package_sub.id';
			$columns    = array(
			 
			array('db'=>"m_package_sub.name",'dt'=>0,'alias'=>'name'),
			array('db'=>"m_package_sub.three_month",'dt'=>1,'alias'=>'three_month','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_package_sub.six_month",'dt'=>2,'alias'=>'six_month','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_package_sub.nine_month",'dt'=>3,'alias'=>'nine_month','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>"m_package_sub.tweleve_month",'dt'=>4,'alias'=>'tweleve_month','formatter'=>function($d,$row){
				 return $d;
			}), 
			array('db'=>'m_package_sub.displays','dt'=>5,'alias'=>'displays','formatter'=>function($d,$row){
				 $a = '<a class="btn btn-xs btn-danger  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->id.'" data-displays="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
			}), 
			array('db'=>'m_package_sub.id','dt'=>6,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							 
							<a href='.site_url('package_sub/edit/'.$row->id_package.'/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			 
			array('db'=>"m_package_sub.id_package",'dt'=>7,'alias'=>'id_package','formatter'=>function($d,$row){
				 return $d;
			}), 
			);
			$table = 'm_package_sub';
			
			$whereResult = NULL;
			$whereAll = '1=1';
			
			if(!empty($id))
			{
				$whereAll = "m_package_sub.id_package='".floatval($id)."'";	
			} 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add($params = "")
	{
		if(!empty($params))
		{
			 
			$rec = $this->db->where('id',$params)->get("package");
			
			if($rec->num_rows()>0)
			{
				$in['arr'] = $rec->row_array();
				$in['use_hedaer'] = true;
				
				$in['use_hedaer'] = true;
				$in['title'] = ' package';
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/package')] = '';
				$in['tpl'] = 'package_sub/form';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
		}
		redirect("packages");
		return;  
		 
		
	}
	public function edit($params, $id)
	{
		if(!empty($params))
		{
			 
			$recs = $this->db->where('id',$params)->get("package");
			
			if($recs->num_rows()>0)
			{
				if(!empty($id))
				{
					
					$rec = $this->db->where('id',$id)->get('package_sub');
					if($rec->num_rows()==1)
					{
						$data = $rec->row_array();
						$in['data'] = $data;
						$in['arr'] = $recs->row_array();
						$in['use_hedaer'] = true;
						$in['title'] = ' package';
						 
						$in['desc'] = 'you can manage your package here';
						$in['bread']['#'] = 'package';
						$in['bread'][site_url('manager/package')] = 'package';
						$in['tpl'] = 'package_sub/form';
						 
						$this->load->view('manager/layout',$in);
						return;
					}
				}
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
			$this->db->delete('package_sub');
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
			$data = $this->db->get('package_sub');
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
				$this->db->insert('package_sub',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('package_sub');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('package_sub',$in);
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
			->update('package_sub',array("displays"=>$in['displays']));
			
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