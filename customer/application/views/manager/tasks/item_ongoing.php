<?php
if(count($arr)>0)
{
	for($i=0;$i<count($arr);$i++)
	{
		$task_type = $arr[$i]['task_type'];
		$task_payment_arr = $arr[$i]['task_payment_arr'];
		if($arr[$i]['reward']>0 && isset($task_type['id']) && isset($task_payment_arr['id']))
		{
			$names = "Click To Start";
			$warna = array("black","blue","red","green","orange");
			$bgcolor = "#0dcaf0";
			if(isset($arr[$i]['user_reward']['id']))
			{
				$names = rewardstatus($arr[$i]['user_reward']['status']);
				$bgcolor = $warna[$arr[$i]['user_reward']['status']];
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
                                                                <img src="<?=config_item('main_site')?>uploads/<?=$arr[$i]['images']?>" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark"><?=$task_type['name']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- <?=$arr[$i]['task_complete']?>/<?=$task_payment_arr['jumlah']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-10"> 
                                                                         <?php
																		 if(!empty($arr[$i]['end_date']) && date('Y',strtotime($arr[$i]['end_date']))!=1970)
																		 {
																		 ?>
                                                                         <b><?=date('d-m-Y H:i',strtotime($arr[$i]['start_date']))?> - <?=date('d-m-Y H:i',strtotime($arr[$i]['end_date']))?></b>
                                                                         <?php
																		 }else
																		 {
																		 ?>
                                                                          <b><?=date('d-m-Y H:i',strtotime($arr[$i]['start_date']))?>  </b>
                                                                         <?php
																		 }
																		 ?>
                                                                         </p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                                <h1 class="text-left">
                                                                    <?=$arr[$i]['name']?>
                                                               </h1>
                                                               <hr/>
                                                                
                                                               <a href="<?=site_url("tasks/details/".$arr[$i]['id'])?>?type=ongoing" class="btn btn-sm btn-xs btn-lg btn-full" style="background:<?=$bgcolor?>;"><?=$names?></a>
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