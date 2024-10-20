<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
?>
	<div class="card card-style">
            <div class="content">
                <div class="tabs tabs-pill" id="tab-group-2">
                    <div class="tab-controls rounded-m p-1 overflow-visible">
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-in tabsb" data-bs-toggle="collapse" href="#tab-in" aria-expanded="true"><?=custom_language('Transfer In')?></a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-out tabsb" data-bs-toggle="collapse" href="#tab-out" aria-expanded="false"><?=custom_language('Transfer Out')?></a>
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                    <div class="collapse show coltab" id="tab-in" data-bs-parent="#tab-group-2">
                         <?php
						for($i=0;$i<count($transfer_in);$i++)
						{
							$intos = json_decode($transfer_in[$i]['from_customer_info'],true);
							$to = json_decode($transfer_in[$i]['to_customer_info'],true);
							if(isset($to['id']) && isset($intos['id']))
							{
						?> 
                        <a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-intos-<?=$transfer_in[$i]['id']?>">
                        <!-- <div  class="d-flex py-1"  > -->
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1"><?=$intos['name']?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($transfer_in[$i]['tgl']))?></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format($transfer_in[$i]['total'],1)?> <?=setting('coin_name');?></h4>
                                <p class="mb-0 font-11 color-primary"><?=custom_language("Transfer In")?></p>
                            </div>
                       <!-- </div> -->
                       </a>
                        <?php
							}
						}
						?>
                         
                    </div>
                    <!-- Tab Group 2 -->
                    <div class="collapse coltab" id="tab-out" data-bs-parent="#tab-group-2">
                       <?php
						for($i=0;$i<count($transfer);$i++)
						{
							$intos = json_decode($transfer[$i]['from_customer_info'],true);
							$to = json_decode($transfer[$i]['to_customer_info'],true);
							if(isset($to['id']) && isset($intos['id']))
							{
						?> 
                        <a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-out-<?=$transfer[$i]['id']?>">
                      <!--  <div  class="d-flex py-1"  >-->
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1"><?=$to['name']?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($transfer[$i]['tgl']))?></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-red-dark">- <?=number_format($transfer[$i]['total'],1)?> <?=setting('coin_name');?></h4>
                                <p class="mb-0 font-11 color-red" ><?=custom_language("Transfer out")?></p>
                            </div>
                        <!--</div>-->
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
  for($i=0;$i<count($transfer_in);$i++)
	{
		$intos = json_decode($transfer_in[$i]['from_customer_info'],true);
		$to = json_decode($transfer_in[$i]['to_customer_info'],true);
		if(isset($to['id']) && isset($intos['id']))
		{
			$avatar = "assets/images/pictures/31t.jpg";
			if(!empty($intos['avatar']))
			{
				$avatar = "uploads/".$intos['avatar'];
			}
  ?> 
    <!-- Transaction Action Sheet -->
    <div id="menu-intos-<?=$transfer_in[$i]['id']?>" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        <!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
        <div class="menu-size" style="height:385px;">
            <div class="content">
                <a href="#" class="d-flex py-1 pb-4">
                    <div class="align-self-center">
                        <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                            <img src="<?=$avatar?>" width="45" class="rounded-s" alt="img"></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=$intos['name']?></h5>
                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',$intos['created_on'])?></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 font-14 mb-n1 color-green-dark"><?=payments($transfer_in[$i]['status'])?></h4>
                        <p class="mb-0 font-11">  </p>
                    </div>
                </a>
                <div class="row">
                     
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($transfer_in[$i]['tgl']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <?php
						if(!empty($transfer_in[$i]['admin_fee']))
						{
					?>
                    <strong class="col-5 color-theme"><?=custom_language('Transfer Amount')?> </strong>
                    <strong class="col-7 text-end "><?=number_format($transfer_in[$i]['full_total'],2)?></strong>
                    <strong class="col-5 color-theme"><?=custom_language('Admin Fee')?> </strong>
                    <strong class="col-7 text-end"><?=number_format($transfer_in[$i]['admin_fee'],2)?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total')?></strong>
                    <strong class="col-7 text-end color-highlight"><?=number_format($transfer_in[$i]['total'],2)?></strong>
                    
                    
                    
                    <?php
						}else
						{
					?>
                    		 <strong class="col-5 color-theme"><?=custom_language('Transfer Amount')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($transfer_in[$i]['total'],2)?></strong>
                    <?php
						} 
					?>
                    
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
  for($i=0;$i<count($transfer);$i++)
	{
		$intos = json_decode($transfer[$i]['from_customer_info'],true);
		$to = json_decode($transfer[$i]['to_customer_info'],true);
		if(isset($to['id']) && isset($intos['id']))
		{
			$avatar = "assets/images/pictures/31t.jpg";
			if(!empty($to['avatar']))
			{
				$avatar = "uploads/".$to['avatar'];
			}
  ?> 
    <!-- Transaction Action Sheet -->
    <div id="menu-out-<?=$transfer[$i]['id']?>" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        <!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
        <div class="menu-size" style="height:385px;">
            <div class="content">
                <a href="#" class="d-flex py-1 pb-4">
                    <div class="align-self-center">
                        <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                            <img src="<?=$avatar?>" width="45" class="rounded-s" alt="img"></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=$to['name']?></h5>
                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',$to['created_on'])?></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 font-14 mb-n1 color-green-dark"><?=payments($transfer[$i]['status'])?></h4>
                        <p class="mb-0 font-11">  </p>
                    </div>
                </a>
                <div class="row">
                     
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($transfer[$i]['tgl']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <?php
						if(!empty($transfer[$i]['admin_fee']))
						{
					?>
                    <strong class="col-5 color-theme"><?=custom_language('Transfer Amount')?> </strong>
                    <strong class="col-7 text-end "><?=number_format($transfer[$i]['full_total'],2)?></strong>
                    <strong class="col-5 color-theme"><?=custom_language('Admin Fee')?> </strong>
                    <strong class="col-7 text-end"><?=number_format($transfer[$i]['admin_fee'],2)?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total')?></strong>
                    <strong class="col-7 text-end color-highlight"><?=number_format($transfer[$i]['total'],2)?></strong>
                    
                    
                    
                    <?php
						}else
						{
					?>
                    		 <strong class="col-5 color-theme"><?=custom_language('Transfer Amount')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($transfer[$i]['total'],2)?></strong>
                    <?php
						} 
					?>
                    
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
       
      