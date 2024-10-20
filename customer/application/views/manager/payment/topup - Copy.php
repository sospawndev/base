<style type="text/css">
.pay-option-label.xaddress
{
	background-color:#ccc;
}
#qrcode img
{
	text-align:center;
	padding-left: 35%;	
}
.tflex {
  display: flex;
  padding: 5px;
}
.bank-group
{
	cursor:pointer;	
}
@media only screen and (max-width: 600px) {
    #qrcode img
	{
		text-align:center;
		padding-left: 15%;	
	}
}
</style>		 

        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Watchlist')?></h3>
                </div>
                <div class="align-self-center ms-auto">
                    <a href="#" class="font-12 pt-1"><?=custom_language('View All')?></a>
                </div>
            </div>
        </div>
        <div class="card card-style">
            
            <?php
				for($i=0;$i<count($currency);$i++)
				{
					$bn = "$";
					$values = 1;
					if(!empty($currency[$i]['simbol']))
					{
						$values = $currency[$i]['price'];
						$bn = $currency[$i]['name'];
					}
					$pricex = setting('price_coin');
					$totalp = ($pricex>0 && $values>0)? $values/$pricex:0;
					$totalp = number_format($totalp,4);
			?>
                <div class="content my-2 globaltopup on-topup-<?=$currency[$i]['id']?>" >
                    <a href="javascript:void(0);" onclick="javascript:topup_c(<?=$currency[$i]['id']?>,'<?=$currency[$i]['name']?>',<?=$totalp?>,<?=$values?>)" class="d-flex" >
                        <div class="align-self-center w-25">
                            
                            <h4 class="pt-1 mb-n1 font-16 "><span class="titletoptup"><i class="bi bi-ban"></i></span> <?=$currency[$i]['name']?></h4> 
                            <p class="mb-0 opacity-50">Deposit Address: <b><?=$currency[$i]['received_address']?></b></p>
                        </div>
                        <div class="align-self-center m-auto">
                            <div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2">1 <?=$bn?> = <?=$totalp?> <?=setting('coin_name')?></h4>
                            <h5 class="mb-0 color-green-dark text-end"><small>Network <?=$currency[$i]['network']?></small></h5>
                        </div>
                    </a>
                </div>
            <?php
				}
			?>
             
            
        </div>
       <div class="card card-style"> 
            <div class="content  qrcode_o xhide">
                          <div class="row  ">
                                <div class="col-12">
                                    <!-- -->
                                    <!-- -->
                                     <div class="form-group">
                                        <h4 class="pt-1 mb-n1 font-16 text-center "> Deposit Address <b class="rec_dev"></b></h4> 
                                        <hr />
                                        <div class="input-group mb-3"> 
                                            <span class="input-group-text"><i class="bi bi-link"></i></span>
                                            <input type="text" class="form-control" aria-label="rec_addr" id="rec_addr" readonly="rec_addr" value=""> 
                                             <span class="input-group-text" onclick="javascript:CopyToClipboard('rec_addr');" style="cursor:pointer;"><i class="bi bi-file-copy"></i></span>
                                        </div>
                                       
                                        
                                        
                                      </div>
                                      <div id="qrcode" style=""></div>
                                    <!-- -->
                                </div>
                           </div>
            </div>
        </div>                    
                            
        <form action="javascript:void(0);" role="form" method="post" id="form-topup" class="form-topup">
            <div class="card card-style"> 
            		<!-- -->
                    <div class="content  ">
                        <div class="row  ">
                            <div class="col-5">
                                 
                                <div class="form-custom form-label form-border">
                                       <h4 class="pt-1 mb-n1 font-16 topup-coin"> USDT</h4>
                                        <input type="number" class="form-control exchange-value border-0 rounded-xs" id="value_total" name="value_total"  placeholder="0" />
                                     
                                </div>
                            </div>
                            
                            <div class="col-2">
                                <h5 class="exchange-arrow"><i class="bi bi-arrow-left-right"></i></h5>
                            </div>
                            <div class="col-5">
                                 
                                <div class="form-custom form-label form-border">
                                    	<h4 class="pt-1 mb-n1 font-16  "> <?=setting('coin_name')?></h4>
                                       
                                        <input type="number" class="form-control exchange-value border-0 rounded-xs" id="total" name="total" placeholder="0" readonly="readonly"/>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row  ">
                            <div class="col-12">
                            		<h4 class="pt-1 mb-n1 font-16  ">Input Your tx id after transfer</h4>
                                       
                                     <input type="text" class="form-control exchange-value border-0 rounded-xs" id="tx_hash" name="tx_hash" placeholder="0x"  />
                            </div>
                        </div>    
                        
                    </div>
                    <!-- -->
            </div>
    
            <div class="content">
                <div class="row">
                    <div class="col-12">
                    	<input type="hidden" value="" name="simbol" id="simbol" />
                    	<input type="hidden" value="" name="coin_name" id="coin_name" />
                        <input type="hidden" value="" name="network" id="network" />
                        <input type="hidden" value="" name="received_address" id="received_address" /> 
                        <input type="hidden" value="" name="id_currency" />
                        
                        <button   class="btn btn-full gradient-highlight rounded-s shadow-bg shadow-bg-s" style="width:100%;">Buy</button>
                    </div>
                    
                </div>
            </div>
        </form>



<script>
$(function()
{
	$("#form-topup").validate({
		ignore:[],
		submitHandler:function(){
			if(id_currency<=0)
			{
				smart_message("Choose Currency");
				 return;	
			}
			var formdata = new FormData($("#form-topup")[0]);
			var req = postFile('<?=site_url('payment/savetopup')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href="<?=site_url('payment/activity')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
});
</script>        