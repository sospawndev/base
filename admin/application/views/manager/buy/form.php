<form action="javascript:void(0);" style="display:none !important;" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Order
            </div>
            <div class="card-body">
                
                                <div>
                                Presale Brief Guidance:
                                <ol>
                                	<li>Ensure that you have USDT (BEP2/TRC20). You may purchase it from Binance/Indodax/any other Exchanger
                                    </li>
                                	<li>
                                    Transfer some amounts of UST (BEP2/TRC20) to one of Meong Admin's USDT Wallets: <br/>
                                     a. <?=settings('bep20')?> (BEP2) or <br/>
                                    b. <?=settings('trc20')?> (TRC)
                                    </li>
                                   
                                    <li>
                                    Inform to Meong Admin amount of USDT that you have transferred along with the protocol (BEP2/TRC20), transaction ID, and trustwallet address of the BSC
                                    </li>
                                    <li>
                                    Meong Token will be distributed 1 month following the listing on CEX
                                    </li>
                                </ol>
                                <hr/>
                                </div>    
                                    
                                
                                <div class="form-group">
                                    <label>USDT</label>
                                    <input type="text" class="form-control required" id="usdt" name="usdt" placeholder="USDT" value="<?=isset($data['usdt'])?$data['usdt']:''?>" readonly="readonly"/>
                                </div>
                                <div class="form-group">
                                    <label>Presale Token</label>
                                    <input type="text" class="form-control required" id="presale_token" name="presale_token" placeholder="presale token" value="<?=isset($data['presale_token'])?$data['presale_token']:''?>" readonly="readonly"/>
                                </div>
                                <div class="form-group">
                                    <label>Bonus</label>
                                    <input type="text" class="form-control required" id="bonus" name="bonus" placeholder="bonus" value="<?=isset($data['bonus'])?$data['bonus']:''?>" readonly="readonly"/>
                                </div>
                               
                                
                                 <div class="form-group">
                                    <label>Wallet Address</label>
                                    <input type="text"  class="form-control required" id="wallet_address" name="wallet_address" placeholder="wallet address" value="<?=isset($data['wallet_address'])?$data['wallet_address']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Transaction Hash</label>
                                    <input type="text"  class="form-control required" id="transaction_hash" name="transaction_hash" placeholder="Transaction Hash" value="<?=isset($data['transaction_hash'])?$data['transaction_hash']:''?>" />
                                </div>
                                
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <button type="button" class="btn btn-reset"><i class="fa fa-refresh"></i> Refresh</button>
                                </div>       	
                 </div>
             
            </div>
         </div>
      </div>
                      
                         		   
                         
         
</div>
</form>                        
<script>
$(document).ready(function(){
	$("#frm-object").validate({
		ignore:[],
		onkeyup:false,
		errorClass: 'help-block text-right animated fadeInDown',
		errorElement: 'div',
		errorPlacement: function(error, e) {
			jQuery(e).parents('.form-group').append(error);
		},
		highlight: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		success: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		submitHandler:function(){
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url("order/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('order')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
			return false;
		}
	});
	$("#id_tier").change(function()
	{
		var id_tier = $(this).val();
		var req = post('<?=site_url("plg/stats/tier")?>',{"id_tier":id_tier});
			req.done(function(out){
				if(!out.error)
				{
					$("#usdt").val(out.data.fix_usdt);
					$("#presale_token").val(out.data.fix_presale_token);
					$("#bonus").val(out.data.fix_bonus);
					
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
	});  
	
});
</script>          