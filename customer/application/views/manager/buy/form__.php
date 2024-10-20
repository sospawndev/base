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
                 
            </div>
        </div>
        <div class="card card-style">
            
           <?php
				 
					$bn = "$";
					$values = 1;
					 
					$pricex = setting('price_coin');
					$totalp = ($pricex>0 && $values>0)? $values/$pricex:0;
					$totalp = number_format($totalp,4);
			?>
                 <div class="content my-2">
                    <a href="#" class="d-flex">
                        <div class="align-self-center w-25">
                            <h4 class="pt-1 mb-n1 font-16"><?=$bn?>1 </h4>
                            
                        </div>
                        <div class="align-self-center m-auto">
                             
                        </div>
                        <div class="ms-auto">
                            <h4 class="mb-n1 pt-2"><?=$totalp?> <?=setting('coin_name')?></h4>
                            
                        </div>
                    </a>
                </div>
                 
            
             
            
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