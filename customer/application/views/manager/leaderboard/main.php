<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
?>
     <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Leaderboard')?> Task</h3>
                </div>
                <div class="align-self-center ms-auto">
                </div>
            </div>
        </div>
	<div class="card card-style">
            <div class="content">
                 <!-- -->
                  <?php
				  for($i=0;$i<count($arr);$i++)
				  {
					  $imgs = "assets/images/pictures/31t.jpg";
						if(!empty($arr[$i]['avatar']))
						{
							$imgs  = config_item('main_site')."uploads/".$arr[$i]['avatar'];
						}
				  ?>  
                    <div class="d-flex py-1"  >
                            <div class="align-self-center">
                                <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                                    <img src="<?=$imgs?>" width="45" height="45" class="rounded-s" alt="img">
                                </span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1"><?=$arr[$i]['name']?></h5>
                                
                                
                                <p class="mb-0 font-11 opacity-70"><b><?=$arr[$i]['total_task']?></b> Task Completed</p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-green-dark"><?=number_format($arr[$i]['rewards'],0)?> <?=setting('coin_name');?></h4>
                                <p class="mb-0 font-11">Reward</p>
                            </div>
                    </div>
                  <?php
				  }
				  ?>  
            </div>
        </div>
        
        

 
    
 
       
      