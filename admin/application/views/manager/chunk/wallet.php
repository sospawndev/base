<script src="assets/web3/web3.js"></script>
 	<div class=" ">
         		  <div class=" ">
                        
                        <div class="card radius-10">
                          <div class="card-body ">
                            <div class="d-flex align-items-center">
                              <div class="">
                                <p class="mb-0">Wallet Address </p>
                                
                                 
                                 
                                
                              </div>
                              <div class="ms-auto fs-2 text-primary">
                                <a href="javascript:void(0);" class='text-right '  id="walletadd"><i class="bx bx-plus"></i> </a>
                              </div>
                              
                            </div>
                            <p><a href="javascript:void(o)" onclick="CopyToClipboard('copyaddr');return false;" id="copyaddr"> <?=!empty(user_info("wallet_address"))?user_info("wallet_address"):"-"?> </a></p> 
                            
                          </div>
                        </div>
                       </div>
                     
                     <div class=" ">
                        <div class="card radius-10 ">
                          <div class="card-body ">
                            <div class=" ">
                              <div class="form-group">
                                <h5 class="mb-1">Earn with Referral</h5>
                                <p>Invite your friends & family.</p>
                                <div class="input-group mb-3"> 
                                	<span class="input-group-text"><i class="bx bx-link"></i></span>
									<input type="text" class="form-control" aria-label="Reffreal" id="refinput" readonly="readonly" value="<?=site_url('register/views/'."ARTSKY-".user_info('id'))?>"> 
                                     <span class="input-group-text" onclick="javascript:copytext('refinput');" style="cursor:pointer;"><i class="bx bx-copy"></i></span>
								</div>
                               
                                
                                
                              </div>
                              
                              
                            </div>
                            
                          </div>
                        </div>
                        <div class="">
                        	<!-- -->
                            <?php
								$vtiers = tiers();
								if(isset($vtiers['id']))
								{
									if($vtiers['ends']==0)
									{
										$percen = ($vtiers['phase_token']/$vtiers['total_supply'])*100;
							?>
                                       <div class="card">
                                            <div class="card-body">
                                                    <div class="card-title">
                                                        <h5 class="mb-0"><?=$vtiers['name']?></h5>
                                                    </div>
                                                    <hr>
                                                    <div class="row"> 
                                                        <div class="col-md-6 text-left">
                                                          Token sold<br/>
                                                          <?=number_format($vtiers['phase_token'],0)?> 
                                                        </div> 
                                                        <div class="col-md-6 text-right">
                                                            Total Token<br/>
                                                            <?=number_format($vtiers['total_supply'],0)?>
                                                        </div>
                                                    </div>	
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: <?=round($percen,2)?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=round($percen,2)?>%</div>
                                                    </div>
                                                     <div class="row"> 
                                                        <div class="col-md-12 text-left">
                                                         <strong style="font-size:26px;"> <?=number_format($vtiers['phase'],0)?></strong> Raised Amount Phase <?=strtoupper(romawi(tier_fase($vtiers['id'])))?><br/>
                                                          <strong style="font-size:26px;"> <?=number_format($vtiers['total_usdt'],0)?></strong> Total Amount All Phase<br/>  
                                                           <strong style="font-size:26px;"> <?=number_format($vtiers['customer'],0)?></strong> Investors<br/>  
                                                        </div> 
                                                        
                                                    </div>
                                            </div>
                                      </div>  
                            <?php
									}else
									{
							?>
                            		<div> 
                                    	<div class='alert alert-danger' style='width:100%; color:linear-gradient(135deg, #49138C, #341477); text-align:center; font-weight:bold;'>Private Sale Is closed </div>
                                    </div>
                            <?php			
									}
								}else
								{
							?>
                            		<div> 
                                    	<div class='alert alert-danger' style='width:100%; color:linear-gradient(135deg, #49138C, #341477); text-align:center; font-weight:bold;'>Private Sale Is closed </div>
                                    </div>
                            <?php
								}
							?>
          
                            <!-- -->
                        </div>
                </div>  
         </div>
<!-- modal wallet -->
<div id="walletmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" method="post" id="frm-wallet">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn btn-outline-danger" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Wallet</h4>
      </div>
      <div class="modal-body">
        <p>
        Connect your Wallet via Metamask. Don't forget to add network BNB Chain, follow this instruction here to set up. If Binance is blocked by the goverment on your country, please use secured VPN. 

You can also put directly your wallet address. Make sure your wallet address are WBNB - BSC20. It always start with "0x". This wallet is used for us to distributed the $XOME direct to your wallet. The distribution of the wallet have term and condition. Please read carefull about vesting time on tokenomics in whitepaper. Or, you can direct to this link.
        </p>
        <div class="form-group ">
        	<button type="button" class="btn btn-outline-primary  " style="width:100%;" id="cmeta">Metamask / Trust Wallet</button>
        </div>
        <br/>
        
        
        <div class="form-group wallet_address">
        	<label>Address</label>
            <input type="text" name="wallet_address" id="wallet_address" class="form-control required" />
        </div>
      </div>
      <div class="modal-footer">
      	 
        
      	<button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>

<script>
let web3 = new web3js.myweb3(window.ethereum);

let addr;
const loadweb3 = async () => {
			  try {
					web3 = new web3js.myweb3(window.ethereum);
					 
				let a = await ethereum.enable();
				console.log(a);
				addr = web3.utils.toChecksumAddress(a[0]);
				console.log(addr);
				$("#wallet_address").val(addr);
				setTimeout(function()
				{
					 $("#frm-wallet").trigger("submit");
				},500);
				return(addr);
			  } catch (error) {
				if (error.code === 4001) {
				  alert('Please connect to MetaMask / Trust Wallet');
				} else {
				  console.error(error);	
				  alert('Please connect to MetaMask / Trust Wallet');
				  //console.error(error);
				}
			  }
		
};
$(function()
{
	$("#walletadd").on("click",function()
	{
		$("#walletmodal").modal("show");
	});
	$("#cmanual").on("click",function()
	{
		if($(".wallet_address").hasClass("hide"))
		$(".wallet_address").removeClass("hide");
		else
		$(".wallet_address").addClass("hide");
		
	});
	$("#cmeta").on("click",function()
	{
		loadweb3();		
		
	});
	$("#frm-wallet").validate({
		ignore:[],
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
		rules:{
			sites_logo_s:{
				extension:"jpg|png"
			}
		},
		submitHandler:function(){
			var obj = new FormData($("#frm-wallet")[0]);
			var req = postFile('<?=site_url('customer/save_wallet')?>',obj);
			req.done(function(out){
				if(!out.error)
				{
					document.location.reload();
					
				}
				else
				{
					smart_error_box(out.message,'#frm-wallet');
				}
			});
			return false;
		}
	});
	
});
</script>            