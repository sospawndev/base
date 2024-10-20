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
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-topup tabsb" data-bs-toggle="collapse" href="#tab-topup" aria-expanded="true">Top Up</a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-tf tabsb" data-bs-toggle="collapse" href="#tab-tf" aria-expanded="false">Transfer</a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-wd tabsb" data-bs-toggle="collapse" href="#tab-wd" aria-expanded="false">Withdrawal</a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-buy tabsb" data-bs-toggle="collapse" href="#tab-buy" aria-expanded="false">Buy</a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tabsb" data-bs-toggle="collapse" href="#tab-8" aria-expanded="false">Ref Reward</a>
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
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
                                <h4 class="pt-1 mb-n1 color-green-dark">$<?=number_format($topup[$i]['total'],2)?></h4>
                                <p class="mb-0 font-11"> <?=payments($topup[$i]['status'])?></p>
                            </div>
                            <textarea name="id_top" id="id_top" class="xhide id_top_"<?=$topup[$i]['id']?> ><?=json_encode($topup[$i])?></textarea>
                        </a>
                        <?php
						}
						?>
                         
                    </div>
                    <!-- Tab Group 2 -->
                    <div class="collapse coltab" id="tab-tf" data-bs-parent="#tab-group-2">
                       <?php
						for($i=0;$i<count($transfer);$i++)
						{
							$to = json_decode($transfer[$i]['to_customer_info'],true);
							if(isset($to['id']))
							{
						?> 
                        <div  class="d-flex py-1"  >
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1"><?=$to['name']?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($transfer[$i]['tgl']))?></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$<?=number_format($transfer[$i]['total'],1)?></h4>
                                <p class="mb-0 font-11">Transfer</p>
                            </div>
                        </div>
                        <?php
							}
						}
						?>
                        <?php
						/*
                        <a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Danesh</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Wing Jang</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Xi Xian</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Grupal</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Michael</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Santi</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">Erika</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$10</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
                        */
						?>
                    </div>
                    <!-- Tab Group 3 -->
                    <div class="collapse coltab" id="tab-wd" data-bs-parent="#tab-group-2">
                        <?php
						for($i=0;$i<count($withdraw);$i++)
						{
							$to = json_decode($withdraw[$i]['customer_info'],true);
							if(isset($to['id']))
							{
						?> 
                        		<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-wd-<?=$withdraw[$i]['id']?>">
                                    <div class="align-self-center">
                                        <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                                    </div>
                                    <div class="align-self-center ps-1">
                                        <h5 class="pt-1 mb-n1"><?=$withdraw[$i]['tx_hash']?></h5>
                                        <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($withdraw[$i]['tgl']))?></p>
                                    </div>
                                    <div class="align-self-center ms-auto text-end">
                                        <h4 class="pt-1 mb-n1 color-blue-dark">$<?=number_format($withdraw[$i]['total'],1)?></h4>
                                        <p class="mb-0 font-11"><?=payments($withdraw[$i]['status'])?></p>
                                    </div>
                                </a>
                        <?php
							}
						}
						?>
						<?php
						/*
                        <a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-brown shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">0xCc8E6d00C17eB431350C6c50d8b8F05176b90b11</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$300</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">0xCc8E6d00C17eB431350C6c50d8b8F05176b90b11</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$800</h4>
                                <p class="mb-0 font-11">Transferred</p>
                            </div>
                        </a>
						
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-orange shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">0xCc8E6d00C17eB431350C6c50d8b8F05176b90b11</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$400</h4>
                                <p class="mb-0 font-11">Pending</p>
                            </div>
                        </a>
						
						<a href="#" class="d-flex py-1" data-bs-toggle="offcanvas" data-bs-target="#menu-activity-2">
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-red shadow-bg shadow-bg-xs"><i class="bi bi-wallet color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">0xCc8E6d00C17eB431350C6c50d8b8F05176b90b11</h5>
                                <p class="mb-0 font-11 opacity-70">3rd November <span class="copyright-year"></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$600</h4>
                                <p class="mb-0 font-11">Rejected</p>
                            </div>
                        </a>
                        */
						?>
                    </div>
                    <!-- -->
                    <div class="collapse  coltab" id="tab-buy" data-bs-parent="#tab-group-2">
                        <?php
						for($i=0;$i<count($buy);$i++)
						{
						?>
                        <a href="javascript:void(0);" class="d-flex py-1"  data-bs-toggle="offcanvas" data-bs-target="#menu-buy-<?=$buy[$i]['id']?>">
                            <div class="align-self-center">
                                <span class="icon gradient-red me-2 shadow-bg shadow-bg-s rounded-s">
                                    <img src="assets/images/preload-logo.png" width="45" class="rounded-s" alt="img">
                                </span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1">$<?=number_format($buy[$i]['value_total'],2)?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($buy[$i]['tanggal']))?></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-green-dark">$<?=number_format($buy[$i]['total'],2)?></h4>
                                <p class="mb-0 font-11"> <?=payments($buy[$i]['status'])?></p>
                            </div>
                             
                        </a>
                        <?php
						}
						?>
                         
                    </div>
                     <div class="collapse coltab" id="tab-8" data-bs-parent="#tab-group-2">
                       <?php
						for($i=0;$i<count($ref);$i++)
						{
							$to = json_decode($ref[$i]['to_customer_info'],true);
							if(isset($to['id']))
							{
						?> 
                        <div  class="d-flex py-1"  >
                            <div class="align-self-center">
                                <span class="icon rounded-s me-2 gradient-blue shadow-bg shadow-bg-xs"><i class="bi bi-people color-white"></i></span>
                            </div>
                            <div class="align-self-center ps-1">
                                <h5 class="pt-1 mb-n1"><?=$to['name']?></h5>
                                <p class="mb-0 font-11 opacity-70"><?=date('d M Y',strtotime($ref[$i]['tanggal']))?></span></p>
                            </div>
                            <div class="align-self-center ms-auto text-end">
                                <h4 class="pt-1 mb-n1 color-blue-dark">$<?=number_format($ref[$i]['total'],2)?></h4>
                                <p class="mb-0 font-11">Reward</p>
                            </div>
                        </div>
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
   for($i=0;$i<count($withdraw);$i++)
   {
	  $to = json_decode($withdraw[$i]['customer_info'],true);
	  if(isset($to['id']))
	  {
   ?>	
    <!-- Transaction Action Sheet -->
    <div id="menu-wd-<?=$withdraw[$i]['id']?>" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
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
                        <h4 class="pt-1 font-14 mb-n1 color-green-dark"><?=payments($withdraw[$i]['status'])?></h4>
                        <p class="mb-0 font-11"> W-<?=$withdraw[$i]['id']?></p>
                    </div>
                </a>
                <div class="row">
                    <strong class="col-5 color-theme">Tx Hash</strong>
                    <strong class="col-7 text-end"><?=$withdraw[$i]['tx_hash']?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($withdraw[$i]['tgl']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <?php
						if(!empty($withdraw[$i]['admin_fee']))
						{
					?>
                    <strong class="col-5 color-theme"><?=custom_language('Withdraw Amount')?> </strong>
                    <strong class="col-7 text-end "><?=number_format($withdraw[$i]['total'],2)?></strong>
                    <strong class="col-5 color-theme"><?=custom_language('Admin Fee')?> </strong>
                    <strong class="col-7 text-end"><?=number_format($withdraw[$i]['admin_fee'],2)?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total Received')?></strong>
                    <strong class="col-7 text-end color-highlight"><?=number_format($withdraw[$i]['value_total'],2)?></strong>
                    
                    
                    
                    <?php
						}else
						{
					?>
                    		 <strong class="col-5 color-theme"><?=custom_language('Withdraw Amount')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($withdraw[$i]['total'],2)?></strong>
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
  //buy
  ?>
   <?php
   for($i=0;$i<count($buy);$i++)
   {
	   
   ?>	
    <!-- Transaction Action Sheet -->
    <div id="menu-buy-<?=$buy[$i]['id']?>" class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
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
                        <h4 class="pt-1 font-14 mb-n1 color-green-dark"><?=payments($buy[$i]['status'])?></h4>
                        <p class="mb-0 font-11"> <?=$buy[$i]['pid']?></p>
                    </div>
                </a>
                <div class="row">
                   
                    <strong class="col-5 color-theme"><?=custom_language('Date')?></strong>
                    <strong class="col-7 text-end"><?=date('d M Y',strtotime($buy[$i]['tanggal']))?></strong>
                    <div class="col-12 mt-2 mb-2"><div class="divider my-0"></div></div>
                    
                    <?php
						 if(!empty($buy[$i]['id_promo']))
						{
					?>
                    <strong class="col-5 color-theme"><?=custom_language('Use Promo')?> </strong>
                    <strong class="col-7 text-end"><?=$buy[$i]['promo_code']?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total')?></strong>
                    <strong class="col-7 text-end "><?=number_format($buy[$i]['value_total'],2)?></strong>
                    
                    <strong class="col-5 color-theme"><?=custom_language('Promo')?> <?=custom_language('Amount')?> </strong>
                    <strong class="col-7 text-end"><?=number_format($buy[$i]['promo_value'],2)?> </strong>
                    <strong class="col-5 color-theme"><?=custom_language('Total')?> </strong>
                    <strong class="col-7 text-end color-highlight"><?=number_format($buy[$i]['total'],2)?></strong>
                    <?php
						}else
						{
					?>
                    		 <strong class="col-5 color-theme"><?=custom_language('Total')?> </strong>
                    		 <strong class="col-7 text-end color-highlight"><?=number_format($buy[$i]['total'],2)?></strong>
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
       
      