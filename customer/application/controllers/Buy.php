<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."libraries/CoinGeckoApi/vendor/autoload.php";
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class Buy extends Smart_Controller {

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
		
		$in['bread']['#'] = 'payment';
		$in['packs'] = $this->db->where('displays',1)->get('package')->result_array();
		$in['title'] = ""; 
		$in['tpl'] = "buy/form";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$time = time();
			$in = $this->input->post();
			/* check ref_user */
			$customer =  $this->db->where('id',user_info('id'))->get('v_customer')->row_array();
			$ref =  $this->db->where('id',user_info('refferal'))->get('v_customer')->row_array();
			$carr = array();
			if(isset($ref['id']))
			{
				
				if($ref['id']>0)
				{
					$carr = $this->reward_buyed();
					/*
					$my_level = my_level(user_info('id'));
					$_SESSION['levelusers_aleo_with'] = array();	
					$this->get_users_refferal(user_info('refferal'),$my_level,true,0);
								 
					$carr = $_SESSION['levelusers_aleo_with'];
					usort($carr, function($a, $b) {
						return $a['my_level'];
					});
					
					//
					$mylevels = my_level(user_info('id')); 
					$mylevel_earn = user_level($mylevels);
					$mylevel_rward = isset($mylevel_earn['refferal_reward'])?$mylevel_earn['refferal_reward']:0;
					//
					$_SESSION['levelusers_aleo_level'] = array();
					
					if(is_array($carr))
					{
						if(count($carr)>0)
						{
							for($i=0;$i<count($carr);$i++)
							{
								//$_SESSION['levelusers_aleo_level']
								if($carr[$i]['level']==0)
								{
									$keytotal = $carr[$i]['my_ref_reward'] - $mylevel_rward;
									$carr[$i]['my_ref_total'] = abs($keytotal);
								}else
								{
									 
									$keytotal = 0;
									$static_reward = isset($carr[$i]['my_level_arr']['static_reward'])?$carr[$i]['my_level_arr']['static_reward']:0;
									
									//if(!isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))
									if(!isset($arr['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))							
									{
										$next = isset($carr[$i+1]['my_ref_reward'])?$carr[$i+1]['my_ref_reward']:0;
										$keytotal = $carr[$i]['my_ref_reward'] - $next;
										
										$carr[$i]['my_ref_total'] = abs($keytotal);
										$arr['levelusers_aleo_level_'.$carr[$i]['my_level'] ] = $carr[$i]['my_ref_total'];
									}
									else
									{
										$carr[$i]['my_ref_total'] = abs($static_reward);
									}
									
								}
							}
						}
						
					}*/
					$mylevels = my_level(user_info('id')); 
					$mylevel_earn = user_level($mylevels);
					$in['my_level'] = json_encode($mylevel_earn);
					$in['ref_user'] = json_encode($carr);
				}
			}
			/* end check ref user */
			
			
			if(!empty($in['id_promo']))
			{  
				$ch = $this->db->where('id',$in["id_promo"])->get('promo');
				if($ch->num_rows()>0)
				{
					$in['promo_info'] = json_encode($this->db->where('id',$in['id_promo'])->get('promo')->row_array());
					
				}
				else
				{
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
				}
			}
			if($in['value_total']>user_balance('balance'))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$this->db->trans_begin();
			$time = time();
			if(isset($in['id_package']))
			{
				if(empty($in['id_package']))
				{
					unset($in['id_package']);	
				}else
				{
					$in['package_info'] = json_encode($this->db->where('id',$in['id_package'])->get('package')->row_array());	
				}
			}
			$in['tanggal'] = date('Y-m-d H:i:s');
			$in['id_customer'] = user_info("id");
			$in['customer_info'] = json_encode($this->db->where('id',user_info("id"))->get('customer')->row_array());
			
			$in['balance'] = user_balance('balance');
			 
			$in['created_on'] = $time;
			$in['created_by'] = user_info("id");
			
			$in['status'] = 1; 
			$in['pid'] = get_unique_buy(); 
			$this->db->insert('buy',$in);  
			$id = $this->db->insert_id(); 
			//
			$buy_ref_reward = array(); 
			if(isset($ref['id']))
			{
				
				if($ref['id']>0)
				{
					 
					/*
						$under_umbrella = under_umbrella($ref['id']);
						if($under_umbrella>0)
						{
							$ref['level_users'] = $under_umbrella;
						}
						$up = level_earn_from($ref['id']);
						if($up>0)
						{
							$ref['level_users'] = $up;
						}
						$cd = $this->db->where('id',$ref['level_users'])->get('level_earn')->row_array();
					 
						if(isset($cd['id']))
						{
							$total_ref = $in['total'] * ($cd['refferal_reward']/100);
							$rd = array();
							$rd['id_buy'] = $id;
							$rd['total'] = $total_ref;
							$rd['ref_reward'] = $cd['refferal_reward'];
							$rd['id_level_earn'] = $cd['id'];
							$rd['level_earn_info'] = json_encode($cd);
							$rd['id_customer'] = $customer['id'];
							$rd['customer_info'] = json_encode($customer);
							$rd['to_customer'] = $ref['id'];
							$rd['to_customer_info'] = json_encode($ref);
							$this->db->insert('buy_ref',$rd);  
							$this->db->where('id',$ref['id'])->update('customer',array("id_level_earn"=>$cd['id'],"level_earn_info"=>json_encode($cd)));
							
						}
					*/
					/*
					$my_level = my_level(user_info('id'));
					$_SESSION['levelusers_aleo_with'] = array();	
					get_users_refferal_with(user_info('refferal'),$my_level,true,0);
					 
					$carr = $_SESSION['levelusers_aleo_with'];
					$mylevels = my_level(user_info('id')); 
					
					if(is_array($carr))
					{
						if(count($carr)>0)
						{
							for($i=0;$i<count($carr);$i++)
							{
							    $customer =  $this->db->where('id',user_info('id'))->get('v_customer')->row_array();
								$refs =  $this->db->where('id',$carr[$i]['id'])->get('v_customer')->row_array();
								//$cd = $this->db->where('id',my_level($carr[$i]['id']))->get('level_earn')->row_array();
								$cd = $this->db->where('id',$mylevels)->get('level_earn')->row_array();
							 
								if(isset($cd['id']) && isset($refs['id']))
								{
									$rwd = $carr[$i]['level_reward'];
									$total_ref = $in['total'] * ($rwd/100);
									if(count($carr)==1)
									{
										$rwd = $cd['refferal_reward'];
										$total_ref = $in['total'] * ($cd['refferal_reward']/100);
									}
									 
									//if($total_ref>0 && $carr[$i]['buy_coin']>0)
									if($total_ref>0)
									{
										$rd = array();
										$rd['id_buy'] = $id;
										
										$rd['levels'] = isset($carr[$i]['level'])?$carr[$i]['level']:-1;
										$rd['total'] = $total_ref;
										$rd['ref_reward'] = $rwd;
										$rd['id_level_earn'] = $cd['id'];
										$rd['level_earn_info'] = json_encode($cd);
										$rd['id_customer'] = $customer['id'];
										$rd['customer_info'] = json_encode($customer);
										$rd['to_customer'] = $carr[$i]['id'];
										$rd['to_customer_info'] = json_encode($carr[$i]);
										$this->db->insert('buy_ref',$rd);  
										$this->db->where('id',$ref['id'])->update('customer',array("id_level_earn"=>$cd['id'],"level_earn_info"=>json_encode($cd)));
									}
									
								}
							}
						}
						 
					}*/
					#=== edit new reward
					/* */
					/*
					$my_level = my_level(user_info('id'));
					$_SESSION['levelusers_aleo_with'] = array();	
					$this->get_users_refferal(user_info('refferal'),$my_level,true,0);
								 
					$carr = $_SESSION['levelusers_aleo_with'];
					usort($carr, function($a, $b) {
						return $a['my_level'];
					});
					
					//
					$mylevels = my_level(user_info('id')); 
					$mylevel_earn = user_level($mylevels);
					$mylevel_rward = isset($mylevel_earn['refferal_reward'])?$mylevel_earn['refferal_reward']:0;
					//
					$_SESSION['levelusers_aleo_level'] = array();
					for($i=0;$i<count($carr);$i++)
					{
						//$_SESSION['levelusers_aleo_level']
						if($carr[$i]['level']==0)
						{
							$keytotal = $carr[$i]['my_ref_reward'] - $mylevel_rward;
							$carr[$i]['my_ref_total'] = abs($keytotal);
						}else
						{
							
							$keytotal = 0;
							$static_reward = isset($carr[$i]['my_level_arr']['static_reward'])?$carr[$i]['my_level_arr']['static_reward']:0;
							
							//if(!isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))
							if(!isset($arr['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))							
							{
								$next = isset($carr[$i+1]['my_ref_reward'])?$carr[$i+1]['my_ref_reward']:0;
								$keytotal = $carr[$i]['my_ref_reward'] - $next;
								
								$carr[$i]['my_ref_total'] = abs($keytotal);
								$arr['levelusers_aleo_level_'.$carr[$i]['my_level'] ] = $carr[$i]['my_ref_total'];
							}
							else
							{
								$carr[$i]['my_ref_total'] = abs($static_reward);
							}
							
						}
					}*/
					
					if(is_array($carr))
					{
						if(count($carr)>0)
						{
							for($i=0;$i<count($carr);$i++)
							{
							    $customer =  $this->db->where('id',user_info('id'))->get('v_customer')->row_array();
								$refs =  $this->db->where('id',$carr[$i]['id'])->get('v_customer')->row_array();
								//$cd = $this->db->where('id',my_level($carr[$i]['id']))->get('level_earn')->row_array();
								//$cd = $this->db->where('id',$carr[$i]['my_level'])->get('level_earn')->row_array();
							 
								//if(isset($cd['id']) && isset($refs['id']))
								if(isset($carr[$i]['my_level_arr']['id']))
								{
									$cd = $carr[$i]['my_level_arr'];
									$rwd = $carr[$i]['my_ref_total'];
									$total_ref = $in['total'] * ($rwd/100);
									if(count($carr)==1)
									{
										$rwd = $cd['refferal_reward'];
										$total_ref = $in['total'] * ($cd['refferal_reward']/100);
									} 
									 
										//if($total_ref>0 && $carr[$i]['buy_coin']>0)
										//if($total_ref>0)
										//{
											$rd = array();
											$rd['id_buy'] = $id;
											
											$rd['levels'] = isset($carr[$i]['level'])?$carr[$i]['level']:-1;
											$rd['total'] = $total_ref;
											$rd['ref_reward'] = $rwd;
											$rd['id_level_earn'] = $cd['id'];
											$rd['level_earn_info'] = json_encode($cd);
											$rd['id_customer'] = $customer['id'];
											$rd['customer_info'] = json_encode($customer);
											$rd['to_customer'] = $carr[$i]['id'];
											$rd['to_customer_info'] = json_encode($carr[$i]);
											$this->db->insert('buy_ref',$rd);  
											//$this->db->where('id',$carr[$i]['id'])->update('customer',array("id_level_earn"=>$cd['id'],"level_earn_info"=>json_encode($cd)));
									//	}
									 
									
								}
							}
						}
						 
					}
					/* */ 
					#=== end edit new reward
				}
			}	
			//
			
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
	public function promorcode()
	{
		if($this->input->is_ajax_request() && $this->input->get())
		{
			$tgl = date('Y-m-d H:i');
			$value = $this->input->get("value_total");
			$id_package = $this->input->get("id_package");
			$sql = "select m_promo.*,(select sum(id) as total_promo from m_buy where m_buy.id_promo=m_promo.id limit 1) as total_promo from m_promo where pid='".$this->input->get("promo_code")."' and (m_promo.start_date<='".$tgl ."' and m_promo.end_date >='".$tgl."')";
			if(!empty($id_package))
			{
				json(array('error'=>true,'message'=>'Package Proccess Failed','security'=>token()));
				return;
			}
			$ch = $this->db->query($sql);//$this->db->where('pid',$this->input->post("promo_code"))->get('promo');
			if($ch->num_rows()>0)
			{
				$arr = $ch->row_array();
				if($arr['total_promo']<=$arr['total_used'])
				{ 
					$usdt = $arr['jumlah'];
					$message = "$".$usdt;
					if($arr['type']==1)
					{
						$usdt = ($value/100) * $arr['jumlah'];
						$message = $arr['jumlah']."% with value $".$usdt;
					}
					json(array('error'=>false,'message'=>$message,"data"=>$usdt,"arr"=>$arr,'security'=>token()));
					return;
				}
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
	}
	private function get_users_refferal($id = "",$id_v_level_earn = 0,$stats =true,$number=0)
	{
		
		$CI =& get_instance();
		if(!isset($_SESSION['levelusers_aleo_with']))
		{
			$_SESSION['levelusers_aleo_with'] = array();	
		}
			$arr_ref = $CI->db
							
							->where('id',$id) 
							->get('v_customer')->result_array();
			for($i=0;$i<count($arr_ref);$i++)
			{
				$my_levels = my_level($arr_ref[$i]['id']); 
				$level_earn = user_level($my_levels);
				$arr_ref[$i]['my_level'] = $my_levels;
				$arr_ref[$i]['my_level_arr'] = $level_earn;
				$arr_ref[$i]['my_ref_reward'] = isset($level_earn['refferal_reward'])?$level_earn['refferal_reward']:0;
				$arr_ref[$i]['my_ref_name'] = isset($level_earn['level'])?$level_earn['level']:0;
				$arr_ref[$i]['level'] = $number;
				$arr_ref[$i]['level_reward'] = check_if_reward($id_v_level_earn,$number,$arr_ref[$i]['id']);
				$arr_ref[$i]['perfomance'] = $CI->db->where('id_customer',$arr_ref[$i]['id'])->get('buy')->num_rows();
				
				/*
				$under = $CI->db
											->select("count(m_buy.id) as total")
											->where('m_v_customer.refferal',$arr_ref[$i]['id'])
											->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
											->get('buy')->row_array();
				*/
				$under = $CI->db
											->select("count(m_v_customer.id) as total")
											->where('m_v_customer.refferal',$arr_ref[$i]['id'])
											//->join("m_v_customer","m_v_customer.id=m_buy.id_customer",'inner')
											->get('v_customer')->row_array();
				$arr_ref[$i]['perfomance_under'] = isset($under['total'])?$under['total']:0;
				
				$ref_under = $CI->db
											->select("count(m_v_customer.id) as total")
											->where('m_v_customer.refferal',$arr_ref[$i]['id'])
											 
											->get('m_v_customer')->row_array();
											
				$arr_ref[$i]['ref_under'] = isset($ref_under['total'])?$ref_under['total']:0;							
				
				//$team += $arr_ref[$i]['ref_under'];	
				
				
				$_SESSION['levelusers_aleo_with'][] = $arr_ref[$i]; 
				if($arr_ref[$i]['ref_under']>0)
				{
					if($stats==true)
					{
						//get_users_refferal_with($arr_ref[$i]['refferal'],$id_v_level_earn,$stats,($number+1));
						$this->get_users_refferal($arr_ref[$i]['refferal'],$id_v_level_earn,$stats,($number+1));
					}
				}
			}	
	}
	public function reward_buy()
	{
		print_r($this->reward_buyed());
	}
	private function reward_buyed()
	{
		/* */
		$my_level = my_level(user_info('id'));
		$_SESSION['levelusers_aleo_with'] = array();	
		$this->get_users_refferal(user_info('refferal'),$my_level,true,0);
					 
		$carr = $_SESSION['levelusers_aleo_with'];
		/*
		usort($carr, function($a, $b) {
			return $a['my_level'];
		});
		*/
		//
		$mylevels = my_level(user_info('id')); 
		$mylevel_earn = user_level($mylevels);
		$mylevel_rward = isset($mylevel_earn['refferal_reward'])?$mylevel_earn['refferal_reward']:0;
		 
		//
		$_SESSION['levelusers_aleo_level'] = array();
		$arr = array();
		$cno = 0;
		/*
		for($i=0;$i<count($carr);$i++)
		{
			//$_SESSION['levelusers_aleo_level']
			if($carr[$i]['level']==0)
			{
				 
				$keytotal = $carr[$i]['my_ref_reward'];
				
				$carr[$i]['my_ref_total'] = abs($keytotal);
				$arr['levelusers_aleo_level_'.$carr[$i]['my_level']] = $carr[$i]['my_level'];
				$arr['levelusers_aleo_key_'.$cno] = $carr[$i]['my_ref_reward'];
				$arr['levelusers_aleo_duplicate_'.$cno] = 0;
				$cno += 1; 
			}else
			{
				
				 
				$keytotal = 0;
				$static_reward = isset($carr[$i]['my_level_arr']['static_reward'])?$carr[$i]['my_level_arr']['static_reward']:0;
				//if(!isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))
				if(!isset($arr['levelusers_aleo_level_'.$carr[$i]['my_level']]))
				{
					//$next = isset($carr[$i+1]['my_ref_reward'])?$carr[$i+1]['my_ref_reward']:0;
					$next = isset($arr['levelusers_aleo_key_'.($cno-1)])?$arr['levelusers_aleo_key_'.($cno-1)]:0;
					$keytotal = ($next>0)?$carr[$i]['my_ref_reward'] - $next:0;
					
					$carr[$i]['my_ref_total'] = abs($keytotal);
					$arr['levelusers_aleo_key_'.$cno] = $carr[$i]['my_ref_reward'];
					
					$arr['levelusers_aleo_duplicate_'.$cno] = 0;
					
					$cno += 1;  
				}
				else
				{
					$carr[$i]['my_ref_total'] = 0;
					if(isset($arr['levelusers_aleo_duplicate_'.$cno]))
					{
						$arr['levelusers_aleo_duplicate_'.$cno] += 1;
						$carr[$i]['my_ref_duplicate'] = $arr['levelusers_aleo_duplicate_'.$cno];
					}
					
					 
					
					
					
				}
				$arr['levelusers_aleo_level_'.$carr[$i]['my_level']] = $carr[$i]['my_level'];
				
				
			}
		}*/
		$carr = $this->f_fix($carr);
		$carr = $this->count_fix($carr);
		return $carr;
		/* */ 
	}
	private function count_fix($carr)
	{
		if(is_array($carr))
		{
			for($i=0;$i<count($carr);$i++)
			{
				if(isset($carr[$i]['my_ref_duplicate']))
				{
					if($carr[$i]['my_ref_duplicate']>0)
					$_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']] = $carr[$i]['my_ref_duplicate'];
				}
			}
			for($i=0;$i<count($carr);$i++)
			{
				$static_reward = isset($carr[$i]['my_level_arr']['static_reward'])?$carr[$i]['my_level_arr']['static_reward']:0;
				if(isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']]) && isset($carr[$i]['my_ref_duplicate']))
				{
					
					if($carr[$i]['my_ref_duplicate']>0)
					{
						$rumus = ($static_reward/100)/$_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']];
						$carr[$i]['my_ref_total'] = ($rumus*100);
						/*
						$carr[$i]['my_ref_rumus'] = "".$static_reward."/".(100)."/".$_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']];
						*/
					}else
					{
						$carr[$i]['my_ref_total']= $static_reward; 	
					}
					 
					
				}
				$carr[$i]['my_ref_static_reward'] = $static_reward;
			}
		}
		return $carr;
	}
	private function f_fix($carr)
	{
		if(is_array($carr))
		{
			$arr = array();
			$cno = 0;
			for($i=0;$i<count($carr);$i++)
			{
				//$_SESSION['levelusers_aleo_level']
				if(isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']]))
				{
					unset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level']]);
				}
				if($carr[$i]['level']==0)
				{
					 
					$keytotal = $carr[$i]['my_ref_reward'];
					
					$carr[$i]['my_ref_total'] = abs($keytotal);
					$arr['levelusers_aleo_level_'.$carr[$i]['my_level']] = $carr[$i]['my_level'];
					$arr['levelusers_aleo_key_'.$cno] = $carr[$i]['my_ref_reward'];
					$arr['levelusers_aleo_duplicate_'.$carr[$i]['my_level']] = 0;
					$cno += 1; 
				}else
				{
					/*
					if(!isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))
					{
						$_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ] = 0;
					}*/
					 
					$keytotal = 0;
					$static_reward = isset($carr[$i]['my_level_arr']['static_reward'])?$carr[$i]['my_level_arr']['static_reward']:0;
					//if(!isset($_SESSION['levelusers_aleo_level_'.$carr[$i]['my_level'] ]))
					if(!isset($arr['levelusers_aleo_level_'.$carr[$i]['my_level']]))
					{
						//$next = isset($carr[$i+1]['my_ref_reward'])?$carr[$i+1]['my_ref_reward']:0;
						$next = isset($arr['levelusers_aleo_key_'.($cno-1)])?$arr['levelusers_aleo_key_'.($cno-1)]:0;
						$keytotal = ($next>0)?$carr[$i]['my_ref_reward'] - $next:0;
						
						$carr[$i]['my_ref_total'] = abs($keytotal);
						$arr['levelusers_aleo_key_'.$cno] = $carr[$i]['my_ref_reward'];
						
						$arr['levelusers_aleo_duplicate_'.$carr[$i]['my_level']] = 0;
						
						$cno += 1;  
					}
					else
					{
						$carr[$i]['my_ref_total'] = $static_reward;
						if(isset($arr['levelusers_aleo_duplicate_'.$carr[$i]['my_level']]))
						{
						 	$arr['levelusers_aleo_duplicate_'.$carr[$i]['my_level']] += 1;
							$carr[$i]['my_ref_duplicate'] = $arr['levelusers_aleo_duplicate_'.$carr[$i]['my_level']];
							
						}
						
						 
						
						
						
					}
					$arr['levelusers_aleo_level_'.$carr[$i]['my_level']] = $carr[$i]['my_level'];
					
					
				}
			}
		}
		return $carr;
	}
}

