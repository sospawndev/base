<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jtree extends Smart_Controller {

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
		 
		 
		$in['bread']['#'] = 'reward';
		
		$in['title'] = ""; 
		$in['tpl'] = "jtree/main";
		$this->load->view('manager/layout',$in);
		return; 
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
	public function datatree()
	{
		if($this->input->is_ajax_request())
		{
			$arr = $this->db
							->where('id',user_info('id'))
							->get('v_customer')->result_array();
			for($i=0;$i<count($arr);$i++)
			{
				$cavatar = "assets/images/pictures/31t.jpg";
				if(!empty($arr[$i]['avatar']))
				{
					$cavatar = "uploads/".$arr[$i]['avatar'];
				}
				$leveli = $this->level_diamond_texted($arr[$i]['id']);
				$arr[$i]['head'] = "A-".$arr[$i]['pid'];
				$uu ='';
				//$uu .= ' <img class="img" src="'.$cavatar.'" />'; 
				$uu .= ' <div><strong class="title">'.$arr[$i]['name'].'</strong></div>';
				$uu .= ' <div class="description">';
				$uu .= ' <div class="desc_cols" style="background-color:'.$leveli['color'].';">'.$leveli['level'].'</div>';
				//$uu .= '<strong>';
				//$uu .= ' $'.number_format($arr[$i]['balance'],2);
				//$uu .= '</strong><br/>';
				$uu .= '<span>'.date('d/m/Y',$arr[$i]['created_on']).'</span><br/> ';
			
				$uu .= '</div>';			
				$uu .= '</div>';	
				$arr[$i]['contents'] = $uu;
				$arr[$i]['children'] = $this->catref_arr($arr[$i]['id']);				
			
			}
			json($arr);
			return;
		}
	}
	private function jtreemy_ref_arr($ids)
	{
		 
		$arr = $this->db
							->where('refferal',$ids)
							->get('v_customer')->result_array();
		return $arr;
	}
	private function catref_arr($ids)
	{
		$CI =& get_instance(); 
		 
		$arr = $this->jtreemy_ref_arr($ids);
		for($i=0;$i<count($arr);$i++)
		{
			$ch = $this->db
						->where('refferal',$arr[$i]['id'])
						->get('v_customer')->num_rows();
		 
			
			$cavatar = "assets/images/pictures/31t.jpg";
			if(!empty($arr[$i]['avatar']))
			{
				$cavatar = "uploads/".$arr[$i]['avatar'];
			}
			$leveli = $this->level_diamond_texted($arr[$i]['id']);
			$arr[$i]['head'] = "A-".$arr[$i]['pid'];
			$uu ='';
			//$uu .= ' <img class="img" src="'.$cavatar.'" />'; 
			$uu .= ' <div><strong class="title">'.$arr[$i]['name'].'</strong></div>';
			$uu .= ' <div class="description">';
			$uu .= ' <div class="desc_cols" style="background-color:'.$leveli['color'].';">'.$leveli['level'].'</div>';
			//$uu .= '<strong>';
			//$uu .= ' $'.number_format($arr[$i]['balance'],2);
			//$uu .= '</strong><br/>';
			$uu .= '<span>'.date('d/m/Y',$arr[$i]['created_on']).'</span><br/> ';
		
			$uu .= '</div>';			
			$uu .= '</div>';	
			$arr[$i]['contents'] = $uu;
			if($ch>0)
			{
				$arr[$i]['children'] = $this->catref_arr($arr[$i]['id']);
			}
		}
		return $arr;
	}
	private function level_diamond_texted($ids)
	{
		$color = array("green","violet","blue","pink","cyan","orange");
		$text_level = user_level(my_level($ids));
		if(isset($text_level['id']))
		{
			$split = explode(" ",$text_level['level']);
			$angka_info = preg_replace("/[^0-9.]/", "", $text_level['level']);
			if($angka_info>0)
			{
				$diamond = "";
				for($i=1;$i<=$angka_info;$i++)
				{
					$diamond .= "<i class='fa fa-diamond '></i> ";
				}
				$ptext = (isset($split[1]) )? $split[1]:"";
				return array("level"=>$diamond." ".$ptext,"color"=>$color[$angka_info]);
			}else
			{
				return array("level"=>$text_level['level'],"color"=>$color[0]);
				//return $text_level['level'];
			}
		}
		return "";
			 
	}
}

