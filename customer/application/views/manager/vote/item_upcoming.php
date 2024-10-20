<?php
if(count($arr)>0)
{
	for($i=0;$i<count($arr);$i++)
	{
		 
		if($arr[$i]['reward']>0)
		{
			$names = "Click To Start";
			$warna = array("black","blue","red","green","orange");
			$bgcolor = "#0dcaf0";
			if(isset($arr[$i]['user_reward']['id']))
			{
				 
			}
?>
				<div class="col-md-6">
                                    <!--  -->
                                     <div class="card card-style">
                                        <div class="content padding-0 margin-0" >
                                                <div class="row padding-0 margin-0">
                                                    <div class="col-md-12 padding-0 margin-0" >
                                                        <div class="card  card-style  padding-0 margin-0" style="min-height:150px;">
                                                         
                                                           <div class="card-body padding-0 margin-0 card-task">
                                                              
                                                               <h1 class="text-center h-task">
                                                                    Dapatkan Reward Sebesar <?=number_format($arr[$i]['reward'],0)?> <?=setting("coin_name")?>
                                                                    
                                                               </h1>
                                                                 
                                                               <?php
																$imk = "assets/images/empty.png";
																if(!empty($arr[$i]['image']) && is_file(config_item('upload_path').$arr[$i]['image']) && file_exists(config_item('upload_path').$arr[$i]['image']))
																{
																	$imk = config_item('main_site')."uploads/".$arr[$i]['image'];
																}
																?>   
                                                                 <img src="<?=$imk?>" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark"><?=$arr[$i]['cats']?></span> 
                                                                          
                                                                     </div>
                                                                     
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-10"> 
                                                                         <?php
																		 if(!empty($arr[$i]['end_dates']) && date('Y',strtotime($arr[$i]['end_dates']))!=1970)
																		 {
																		 ?>
                                                                         <b><?=date('d-m-Y H:i',strtotime($arr[$i]['start_dates']))?> - <?=date('d-m-Y H:i',strtotime($arr[$i]['end_dates']))?></b>
                                                                         <?php
																		 }else
																		 {
																		 ?>
                                                                          <b><?=date('d-m-Y H:i',strtotime($arr[$i]['start_dates']))?>  </b>
                                                                         <?php
																		 }
																		 ?>
                                                                         </p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                                <div class=" d-flex">
                                                                	<div class="align-self-center ps-1 text-center">
                                                                         
                                                                          
                                                                     </div>
                                                                </div>
                                                               <h1 class="text-left">
                                                                    <?=$arr[$i]['titles']?>
                                                               </h1>
                                                               
                                                                <?php
																	for($x=0;$x<count($arr[$i]['vote_option']);$x++)
																	{
																		$ac = "";
																		if($arr[$i]['vote_option'][$x]['percen']>0)
																		{
																			$ac = "active";	
																		}
																?>
                                                                        <div class="progress <?=$ac?>">
                                                                            <div class="progress-bar bg-success " style="width: <?=$arr[$i]['vote_option'][$x]['percen']?>%">
                                                                              
                                                                            </div>
                                                                            
                                                                            	<span class="txt-left"><?=$arr[$i]['vote_option'][$x]['name']?></span>
                                                                                <span class="txt-right"><?=$arr[$i]['vote_option'][$x]['percen']?>%  </span>
                                                                             
                                                                        </div>  
                                                                <?php
																	}
																?>
                                                                 <?=$arr[$i]['days']?> Hari Lagi
                                                               <hr/>
                                                                
                                                                
                                                             </div>
                                                        </div>
                                                    </div>     
                                                </div>
                                        </div>
                                     </div>   
                                  <!-- -->
                                  </div>
<?php
		}
	}
}	
	
?>                                  