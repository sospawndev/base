<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
#=== get subref
function jtreemy_ref_arr($ids)
{
	$CI =& get_instance(); 
	$arr = $CI->db
						->where('refferal',$ids)
						->get('v_customer')->result_array();
	return $arr;
}
function catref_arr($ids)
{
	$CI =& get_instance(); 
	$yhtml = "<ul>";
	$arr = jtreemy_ref_arr($ids);
	for($i=0;$i<count($arr);$i++)
	{
		$ch = $CI->db
						->where('refferal',$arr[$i]['id'])
						->get('v_customer')->num_rows();
		 
			
			$cavatar = "assets/images/pictures/31t.jpg";
			if(!empty($arr[$i]['avatar']))
			{
				$cavatar = "uploads/".$arr[$i]['avatar'];
			}
			$uu = '<li>';
			//$uu .= '<div id="'.$_SESSION['aleo_treenum'].'" style="background-color:#'.random_color().';">';
			$uu .= '<div id="'.$_SESSION['aleo_treenum'].'" class="ctoptree" style="background-color:white;">';
			
			//$uu .= ' <span class="title">'.level_diamond_texted($arr[$i]['id']).'</span><br/>';
			$uu .= ' <img class="img" src="'.$cavatar.'" />'; 
			$uu .= ' <div><strong class="title">'.$arr[$i]['name'].'</strong></div>';
			$uu .= ' <div class="description">';
			$uu .= ' <div class="desc_cols">'.level_diamond_texted($arr[$i]['id']).'</div>';
			$uu .= '<strong>';
			$uu .= ' $'.$arr[$i]['balance'];
			$uu .= '</strong><br/>';
			$uu .= '<span>'.date('d/m/Y',$arr[$i]['created_on']).'</span><br/> ';
		
			$uu .= '</div>';			
			$uu .= '</div>';			
			$_SESSION['aleo_treenum'] +=1;
			if($ch>0)
			{
				$uu .= catref_arr($arr[$i]['id']);
			}
			$uu .= '</li>';
			
			$yhtml .= $uu;
			
		 
	}
	$yhtml .= "</ul>";
	return $yhtml;
}
function level_diamond_texted($ids)
{
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
			return $diamond." ".$ptext;
		}else
		{
			return $text_level['level'];
		}
	}
	return "";
		 
}
function jtree_templates($ids)
{
	$_SESSION['aleo_treenum'] = 2;
	$refsu = catref_arr($ids);
	return $refsu;
	
}
?>
<link href="assets/familytree/goodtree/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/familytree/goodtree/css/extra.css" rel="stylesheet" type="text/css">
<style>
ul.tree li > div
{
   min-width: 160px;
   	
}
ul.tree li .description {
   
}
ul.tree li > div
{
	color:black;
		
}
ul.tree li > div.ctoptree
{
	border:1px solid #ccc;
}
ul.tree li > div .desc_cols
{
	background-color:blue;
	color:white;
	padding: 10px;
}
ul.tree li ul li {
  margin: 20px;
   
}
</style> 

<div class="card card-style overflow-visible mt-5" style="background-color:white;">
  <div class="card-body">
         <!-- -->
         <div class="overflow">
            <div>
                <ul class="tree" rel="1">
                   <li>
                        <div id="1" class="ctoptree" style="background-color:white; ">
                            
                           <img class="img" src="<?=$avatar?>" />
                           <div><strong class="title"><?=user_balance("name")?></strong></div> 
                           <div class="description">
							    <div class="desc_cols"><?=level_diamond_texted(user_balance('id'))?></div>   	
                                <strong>$<?=number_format(user_balance("balance"),2)?></strong><br/>
                                <span><?=date('d/m/Y',user_balance("created_on"))?></span><br/> 
                               
                                
                            </div>
                        </div>
                         <?=jtree_templates(user_balance('id'))?>    
                   </li> 
                  
				   <?php
				   /*
                    <li>
                        <div id="1">
                            <img class="img" src="uploads/user2.jpg" />
                            <span class="title">Russell Ross</span>
                            <span class="description">CEO</span>
                        </div>
                        <ul>
                            <li>
                                <div id="2">
                                    <img class="img" src="uploads/user5.jpg" />
                                    <span class="title">David Sellner</span>
                                    <span class="description">Staff Director</span>
                                </div>
                                <ul>
                                    <li>
                                        <div id="3">
                                            <img class="img" src="uploads/user9.jpg" />
                                            <span class="title">Bent Grasha</span>
                                            <span class="description">Finance Specialist</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div id="4">
                                            <img class="img" src="uploads/user4.jpg" />
                                            <span class="title">Bernelle Cubley</span>
                                            <span class="description">Sr. Accountant</span>
                                        </div>
                                        <ul>
                                            <li>
                                                <div id="5">
                                                    <img class="img" src="uploads/user8.jpg" />
                                                    <span class="title">Jonis Thring</span>
                                                    <span class="description">Accountant</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div id="6">
                                    <img class="img" src="uploads/user1.jpg" />
                                    <span class="title">Erica Romaguera</span>
                                    <span class="description">Manager</span>
                                </div>
                                <ul>
                                    <li>
                                        <div id="7">
                                            <img class="img" src="uploads/user7.jpg" />
                                            <span class="title">Matteo Gobeaux</span>
                                            <span class="description">Designer</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div id="8">
                                            <img class="img" src="uploads/user3.jpg" />
                                            <span class="title">Dorena Whebell</span>
                                            <span class="description">Develooper</span>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div id="9">
                                    <img class="img" src="uploads/user6.jpg" />
                                    <span class="title">Brigida Withey</span>
                                    <span class="description">IT Head</span>
                                </div>
                                <ul>
                                    <li>
                                        <div id="10">
                                            <img class="img" src="uploads/user8.jpg" />
                                            <span class="title">Mickey Neilands</span>
                                            <span class="description">Engineer</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div id="11">
                                            <img class="img" src="uploads/user3.jpg" />
                                            <span class="title">Holmes Dever</span>
                                            <span class="description">QE</span>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
					*/
					?>
                </ul>
            </div>
        </div>
         
         <!-- -->
  </div>      
</div>
 <!-- jQuery Library -->
<script src="assets/familytree/goodtree/js/jquery-3.6.0.min.js"></script>
<script src="assets/familytree/goodtree/js/jquery-migrate-3.3.2.min.js"></script>
<script src="assets/familytree/goodtree/js/jquery-ui.min.js"></script>
<!-- Tree plugin js -->
<script src="assets/familytree/goodtree/js/jquery.tree.js"></script>
<script>
    $(document).ready(function () {
        // Tree plugin call
        $('.tree').tree_structure();
    });
</script>