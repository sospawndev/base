  <!-- Main Card Slider-->
       <!-- -->
       <?php
            include __DIR__."/../chunk/wallet.php";
             
        ?>    
       <!-- -->  
      
                
        <!-- Quick Actions -->
        <div class="content py-2">
            <div class="d-flex text-center">
                <?php
				/*
                <div class="me-auto">
                    <a   class="icon icon-xxl rounded-m bg-theme shadow-m"><i class="font-28 color-blue-dark bi bi-arrow-up-circle"></i></a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2"><?=custom_language('Top Up')?></h6>
                </div>
                
				<div class="m-auto">
                    <a  href="<?=site_url("withdraws")?>" class="icon icon-xxl rounded-m bg-theme shadow-m"><i class="font-28 color-blue-dark bi bi-arrow-down-circle"></i></a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2"><?=custom_language('Withdrawal')?></h6>
                </div>*/
				?>
                <div   class="m-auto">
                    <a href="<?=site_url("tasks")?>?task=ongoing" class="icon icon-xxl rounded-m bg-theme shadow-m"><i class="font-28 color-blue-dark bi bi-book"></i></a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2"><?=custom_language('Task')?></h6>
                </div>
				 <div   class="m-auto">
                    <a href="<?=site_url("vote")?>?task=ongoing" class="icon icon-xxl rounded-m bg-theme shadow-m"><i class="font-28 color-blue-dark bi bi-vector-pen"></i></a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2"><?=custom_language('Vote')?></h6>
                </div>
				
                 <?php
				 /*
                 <div   class="m-auto">
                    <a href="<?=site_url("transfer")?>" class="icon icon-xxl rounded-m bg-theme shadow-m"><i class="font-28 color-blue-dark bi bi-arrow-repeat"></i></a>
                    <h6 class="font-13 opacity-80 font-500 mb-0 pt-2"><?=custom_language('Transfer')?></h6>
                </div>
                */
				?>
            </div>
        </div>
         <?php
		   if($tp_pending>0)
		   {
			   /*
		   ?>
	
			<div class="content py-2">
			  
              	<div class="content row">
					<div class="col-12 alert alert-danger">
						 <a href="<?=site_url('activity')?>?active=topup"   ><?=custom_language('You Have Pending')?> (<?=$tp_pending?>) <?=custom_language('Top Up')?></a>
					</div>
				</div>
			</div>
			<?php
				*/
			}
			?>

         
          <!-- Recent Activity Title-->
        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Task')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                    
                </div>
            </div>
        </div>
        <!-- Recent Activity Cards-->
        <div class="card card-style">
            <div class="content">
            	 
                    <a href="<?=site_url("tasks")?>?task=ongoing" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-red shadow-bg shadow-bg-s" style="background-color:green; background-image: none;"><i class="bi bi bi-book color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('New Task')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format($tasks,0)?> </h4>
                        	<p class="mb-0 font-11"> </p>
                        </div>
                    </a>
                     <div class="divider my-2 opacity-50"></div>
                    <a href="<?=site_url("tasks")?>?task=completed" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-s" style="background-color:orange; background-image: none;"><i class="bi bi bi-book color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('Task Completed ')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                             <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format($tasks_completed,0)?> </h4>
                        	<p class="mb-0 font-11"> </p>
                        </div>
                    </a>	
            </div>
        </div>  
		
		<div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Vote')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                    
                </div>
            </div>
        </div>
        <!-- Recent Activity Cards-->
        <div class="card card-style">
            <div class="content">
            	 	
                    <a href="<?=site_url("vote")?>?task=ongoing" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-red shadow-bg shadow-bg-s" style="background-color:green; background-image: none;"><i class="bi bi bi-vector-pen color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('New Vote')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format($vote,0)?> </h4>
                        	<p class="mb-0 font-11"> </p>
                        </div>
                    </a>
                     <div class="divider my-2 opacity-50"></div>
                    <a href="<?=site_url("vote")?>?task=completed" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-s" style="background-color:orange; background-image: none;"><i class="bi bi bi-vector-pen color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('Vote Completed ')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                             <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format($vote_completed,0)?> </h4>
                        	<p class="mb-0 font-11"> </p>
                        </div>
                    </a>	
            </div>
        </div>  
		
       <?php
		/* <!-- Recent Activity Title-->
        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Recent')?> <?=custom_language('Activity')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                    <a href="activity.html" class="font-12 pt-1"><?=custom_language('View All')?></a>
                </div>
            </div>
        </div>

       
        <!-- Recent Activity Cards-->
        <div class="card card-style">
            <div class="content">
                
                 <a href="<?=site_url("refferal")?>" class="d-flex py-1">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-yellow  shadow-bg shadow-bg-s" style="background-color:cyan; background-image: none;"><i class="bi bi-people color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=custom_language("Referral Reward")?></h5>
                        <p class="mb-0 font-11 opacity-50"></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format(floatval(user_balance('refferal_reward')),0)?> <?=setting('coin_name');?></h4>
                        <p class="mb-0 font-11"> </p>
                    </div>
                </a>
                <div class="divider my-2 opacity-50"></div>
                <a href="<?=site_url("activity")?>?active=wd" class="d-flex py-1">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-orange shadow-bg shadow-bg-s" style="background-color:violet; background-image: none;"><i class="bi bi-arrow-down-circle color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=custom_language("Withdraw")?></h5>
                        <p class="mb-0 font-11 opacity-50"></p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-red-dark">- <?=number_format(floatval(user_balance('withdraw')),0)?> <?=setting('coin_name');?></h4>
                        <p class="mb-0 font-11"> </p>
                    </div>
                </a>
				*/
				?>
               <?php
			   /*
                <div class="divider my-2 opacity-50"></div>
                <a href="<?=site_url("activity")?>?active=topup" class="d-flex py-1">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-s" style="background-color:orange; background-image: none;"><i class="bi bi-caret-up-fill color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1"><?=custom_language('Top Up')?></h5>
                        <?php
							if(isset($top_up['id']))
							{
						?>
                        <p class="mb-0 font-11 opacity-50"><?=date('d M Y',strtotime($topup['tanggal']))?> </p>
                        <?php
							}
						?>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                         
                        <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format(floatval(user_balance('topup')),0)?> <?=setting('coin_name');?></h4>
                        <p class="mb-0 font-11"></p>
                    </div>
                </a>
				
               
              
               
            </div>
        </div>
        */
				?>
        <!-- -->
       
        <?php
		/*
		<!-- Recent Activity Title-->
        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Transfer')?> <?=custom_language('Activity')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                    <a href="activity/transfer.html" class="font-12 pt-1"><?=custom_language('View All')?></a>
                </div>
            </div>
        </div>
        <!-- Recent Activity Cards-->
        <div class="card card-style">
            <div class="content">
            	 
                    <a href="<?=site_url("activity/transfer")?>?active=out" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-red shadow-bg shadow-bg-s" style="background-color:#154bf9; background-image: none;"><i class="bi bi bi-arrow-repeat color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('Transfer')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-red-dark">- <?=number_format(user_balance('transfer'),0)?>  <?=setting('coin_name');?></h4>
                            <p class="mb-0 font-11"><?=custom_language('Out')?></p>
                        </div>
                    </a>
                     <div class="divider my-2 opacity-50"></div>
                    <a href="<?=site_url("activity/transfer")?>?active=in" class="d-flex py-1">
                        <div class="align-self-center">
                            <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-s" style="background-color:#154bf9; background-image: none;"><i class="bi bi bi-arrow-repeat color-white"></i></span>
                        </div>
                        <div class="align-self-center ps-1">
                            <h5 class="pt-1 mb-n1"><?=custom_language('Transfer ')?> </h5>
                            <p class="mb-0 font-11 opacity-50"> </p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h4 class="pt-1 mb-n1 color-green-dark">+ <?=number_format(user_balance('transfer_plus'),0)?>  <?=setting('coin_name');?></h4>
                            <p class="mb-0 font-11"><?=custom_language('In')?></p>
                        </div>
                    </a>	
            </div>
        </div>      
       */
	   ?>
             
        <!-- Recent Activity Cards-->
       