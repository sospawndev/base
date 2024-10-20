<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
?>
	<div class="card card-style">
            <div class="content">
                 
            <!-- -->
           <div class="card card-style">
			<?php
				for($i=0;$i<count($topup);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Top Up')?> </h4> 
                            <p class="mb-0 opacity-50"> <?=date('Y-m-d',strtotime($topup[$i]['tanggal']))?> </p>
                            <p class="mb-0 opacity-50"> <?=$topup[$i]['pid']?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-green-dark">+ <?=number_format($topup[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
            <!-- -->
             <?php
				for($i=0;$i<count($transfer_in);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Transfer')?> </h4> 
                            <p class="mb-0 opacity-50"><?=date('Y-m-d',strtotime($transfer_in[$i]['tgl']))?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-green-dark">+ <?=number_format($transfer_in[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small><?=custom_language('in')?> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
            <?php
				for($i=0;$i<count($transfer);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Transfer')?> </h4> 
                            <p class="mb-0 opacity-50"><?=date('Y-m-d',strtotime($transfer[$i]['tgl']))?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-red-dark">- <?=number_format($transfer[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small><?=custom_language('out')?> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
             <?php
				for($i=0;$i<count($withdraw);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Withdrawal')?> </h4> 
                            <p class="mb-0 opacity-50"><?=date('Y-m-d',strtotime($withdraw[$i]['tgl']))?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-red-dark">- <?=number_format($withdraw[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
            <?php
				for($i=0;$i<count($buy);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Buy')?> </h4> 
                            <p class="mb-0 opacity-50"><?=date('Y-m-d',strtotime($buy[$i]['tanggal']))?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-red-dark">- <?=number_format($buy[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
             <?php
				for($i=0;$i<count($ref);$i++)
				{
					 
			?>
                <div class="content my-2  "   >
                   <div class="d-flex">
                        <div class="align-self-center w-50">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=custom_language('Refferal Reward')?> </h4> 
                            <p class="mb-0 opacity-50"><?=date('Y-m-d',strtotime($ref[$i]['tanggal']))?></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2 color-green-dark">+ <?=number_format($ref[$i]['total'],2)?>  </h4>
                            <h5 class="mb-0 color-yellow-dark text-end"><small> </small></h5>
                        </div>
                   </div>     
                   
                </div>
            <?php
				}
			?>
            <!-- -->
            
          </div>         
                       
                         
          </div>
      </div>                   
                       
       
      