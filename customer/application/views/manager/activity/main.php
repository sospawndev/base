<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = config_item('main_site')."uploads/".user_info('avatar');
}
?>
	<div class="card card-style">
            <div class="content">
                <div class="tabs tabs-pill" id="tab-group-2">
                    <div class="tab-controls rounded-m p-1 overflow-visible">
                        <?php
						/*
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-topup tabsb" data-bs-toggle="collapse" href="#tab-topup" aria-expanded="true"><?=custom_language('Top Up')?></a>
                        */
						?>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-wd tabsb" data-bs-toggle="collapse" href="#tab-wd" aria-expanded="false"><?=custom_language('Task')?></a>
                        
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                    <?php
					/*
                    <div class="collapse show coltab" id="tab-topup" data-bs-parent="#tab-group-2">
                        <?php
						for($i=0;$i<count($topup);$i++)
						{
						?>
                        <a href="javascript:void(0);" class="d-flex py-1"  data-bs-toggle="offcanvas" data-bs-target="#menu-topup-<?=$topup[$i]['id']?>">
                            <div class="align-self-center">
                                <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                                    <img src="assets/images/preload-logo.png" width="45" class="rounded-s" alt="img">
                                </span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">$<?=number_format($topup[$i]['value_total'],2)?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($topup[$i]['tanggal']))?></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-green-dark">+ $<?=number_format($topup[$i]['total'],2)?></h4>
                                <p class="mb-0 font-11"> <?=custom_language(payments($topup[$i]['status']))?></p>
                            </div>
                            <textarea name="id_top" id="id_top" class="xhide id_top_"<?=$topup[$i]['id']?> ><?=json_encode($topup[$i])?></textarea>
                        </a>
                        <?php
						}
						?>
                         
                    </div>
					*/
					?>
                    <!-- Tab Group 2 -->
                     
                    <!-- Tab Group 3 -->
                    
                    <div class="collapse coltab" id="tab-wd" data-bs-parent="#tab-group-2">
                        <?php
						for($i=0;$i<count($task);$i++)
						{
							$to = json_decode($task[$i]['customer_info'],true);
							if(isset($to['id']))
							{
								 
								 
						?> 
                        		<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-wd-<?=$task[$i]['id']?>">
                                    <div class="align-self-center">
                                        <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                                    </div>
                                    <div class="align-self-center ps-1">
                                        <h5 class="pt-1 mb-n1"><?=$task[$i]['tasks']?></h5>
                                        
                                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($task[$i]['tgl']))?></p>
                                    </div>
                                    <div class="align-self-center ms-auto text-end">
                                        <h4 class="pt-1 mb-n1 color-red-dark">+ <?=number_format($task[$i]['rewards'],0)?></h4>
                                        <p class="mb-0 font-11"><?=setting('coin_name');?></p>
                                    </div>
                                </a>
                        <?php
							}
						}
						?>
						 
                    </div>
                     
                      
                    <!-- -->
                </div>
            </div>
        </div>
        
        


    </div>
   <?php
   for($i=0;$i<count($topup);$i++)
   {
	   $currency = json_decode($topup[$i]['currency_info'],true);
	   if(isset($currency['name']))
	   {
   ?>	
    <!-- Transaction Action Sheet -->
    <div id="menu-topup-<?=$topup[$i]['id']?>" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        <!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
        <div class="menu-size" style="height:385px;">
            <div class="content">
                <a href="#" class="d-flex py-1 pb-4">
                    <div class="align-self-center">
                        <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                            <img src="<?=$avatar?>" width="45" class="rounded-s" alt="img"></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=user_info('name')?></h5>
                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',user_info('created_on'))?></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 font-14 mb-n1 color-green-dark"><?=payments($topup[$i]['status'])?></h4>
                        <p class="mb-0 font-11"> <?=$topup[$i]['pid']?></p>
                    </div>
                </a>
                <div class="row">
                    <strong class="col-5 color-theme"><?=custom_language('Coin Name')?></strong>
                    <strong class="col-7 text-end"><?=$currency['name']?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($topup[$i]['tanggal']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <?php
						/*if(!empty($topup[$i]['id_promo']))
						{
					?>
                    <strong class="col-5 color-theme"><?=custom_language('Use Promo')?> </strong>
                    <strong class="col-7 text-end"><?=$topup[$i]['promo_code']?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total')?></strong>
                    <strong class="col-7 text-end "><?=number_format($topup[$i]['value_total'],2)?></strong>
                    
                    <strong class="col-5 color-theme"><?=custom_language('Promo')?> <?=custom_language('Amount')?> </strong>
                    <strong class="col-7 text-end"><?=number_format($topup[$i]['promo_value'],2)?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Send')?> </strong>
                    <strong class="col-7 text-end color-highlight"><?=number_format($topup[$i]['total'],2)?></strong>
                    <?php
						}else
						{
					?>
                    		 <strong class="col-5 color-theme"><?=custom_language('Send Amount')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($topup[$i]['total'],2)?></strong>
                    <?php
						}*/
					?>
                     <strong class="col-5 color-theme"><?=custom_language('Send Amount')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($topup[$i]['total'],2)?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    <strong class="col-5 color-theme"><?=custom_language('Network')?></strong>
                    <strong class="col-7 text-end"><?=$currency['network']?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                </div>
            </div>
            <a href="#" data-bs-dismiss="offcanvas" class="mx-3 btn btn-full gradient-highlight shadow-bg shadow-bg-s">Back to Activity</a>
        </div>
    </div>
    <!-- --> 
  <?php
	   }
   }
  ?>
  <?php
  // wd
  ?>  
   <?php
   for($i=0;$i<count($task);$i++)
   {
	  $to = json_decode($task[$i]['customer_info'],true);
	  if(isset($to['id']))
	  {
		 
   ?>	
    <!-- Transaction Action Sheet -->
    <div id="menu-wd-<?=$task[$i]['id']?>" class="offcanvas offcanvas-top offcanvas-detached rounded-m">
        <!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
        <div class="menu-size" style="height:385px;">
            <div class="content">
                <a href="#" class="d-flex py-1 pb-4">
                    <div class="align-self-center">
                        <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                            <img src="<?=$avatar?>" width="45" class="rounded-s" alt="img"></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=user_info('name')?></h5>
                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',user_info('created_on'))?></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                         
                        
                        <p class="mb-0 font-11"> W-<?=$task[$i]['id']?></p>
                        
                    </div>
                </a>
                <div class="row">
                    
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($task[$i]['tgl']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    <strong class="col-5 color-theme"><?=custom_language('Task')?> </strong>
                    <strong class="col-7 text-end "><?=$task[$i]['tasks']?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                     
                    
                    
                    <strong class="col-5 color-theme"><?=custom_language('Amount')?> </strong>
                    <strong class="col-7 text-end "><?=number_format($task[$i]['rewards'],0)?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                     
                    
                    <strong class="col-5 color-theme"><?=custom_language('Tx Hask')?> </strong>
                    <strong class="col-7 text-end color-highlight"><a href='<?=$task[$i]['network_url']?>tx/<?=$task[$i]['txhash']?>' target="_blank"><?=$task[$i]['txhash']?></a></strong>
                     
                    
                    
                       
                </div>
            </div>
            <a href="#" data-bs-dismiss="offcanvas" class="mx-3 btn btn-full gradient-highlight shadow-bg shadow-bg-s">Back to Activity</a>
        </div>
    </div>
    <!-- --> 
  <?php
	   }
   }
  ?>
  <?php
  //buy
  ?>
    
<script>
function topup_activity(idv)
{
	var tops = $(".id_top_"+ idv).val();
}
$(function()
{
	<?php
	if(isset($_GET['active']))
	{
	?>
			$.each($(".tabsb"),function()
			{
				$(this).attr("aria-expanded",false);
			});
			$.each($(".coltab"),function()
			{
				$(this).removeClass("show");
			});
			$(".tab-<?=$_GET['active']?>").attr("aria-expanded",true);
			$("#tab-<?=$_GET['active']?>").addClass("show");
	<?php
	}
	?>
});
</script>       
       
      