
<script src="assets/skodash/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
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
		padding-left: 5%;	
	}
}
</style>
<script>
var simbol = "";
var coinsimbol = "";
var prices = 0;
var id_currency = 0;
var awalbuys = 0;
function paycheck(names,coin,pricesv,id_c,coinsys)
{
	simbol = coin;
	prices = pricesv;
	id_currency = id_c;
	coinsimbol = coinsys;
	<?php
	for($i=0;$i<count($currency);$i++)
	{
	?>
			if(id_c==<?=$currency[$i]['id']?>)
			{
				$("#address_wallet").val("<?=$currency[$i]['received_address']?>");
				$("#simbol").val("<?=$currency[$i]['name']?>");
				$("#id_currency").val("<?=$currency[$i]['id']?>");
				$("#coin_payment").html("<?=$currency[$i]['name']?>");
				$("#qrcode").html("");
				new QRCode(document.getElementById("qrcode"), "<?=$currency[$i]['received_address']?>");
				$("#received_address").val("<?=$currency[$i]['received_address']?>");
				
				
			}
	<?php
	}
	?>
	$(".namecoin").html(coin.toUpperCase());
	$.each($(".payu"),function()
	{
		$(this).find(".checks").html('<i class="fa fa-ban"></i>');
	});
	$("."+ names).find(".checks").html('<i class="fa fa-check"></i>');
	$("#usdts").trigger("input"); 
	if(awalbuys==1)
	$("#buying").trigger("click"); 
}
function bank_group(id_bank_transfer)
{
	$.each($(".bank-item"),function()
	{
		$(this).find(".fu").html('<i class="fa fa-ban"></i>');
	});
	$(".bank-p-"+ id_bank_transfer).find(".fu").html('<i class="fa fa-check"></i>');
	$("#id_bank_transfer").val(id_bank_transfer);
	$("#type").val(1);
}
</script>
<div class="row">
  <div class="col-md-8">
         <div class="card radius-10 w-100">
         	  <div class="card-header bg-transparent">
                 <h6 class="mb-0">Choose currency and calculate xomm token price </h6>
                 <p>
                 You can buy our Xomm token using the below currency choices to become part of our project.
                 </p>
              </div>
               <div class="card-body">
               		<div class="row">
                    	<div class="col-md-12">
                        	<?php
							/*
                            <label class="pay-option-label pay-option-label1" onclick="javascript:paycheck('pay-option-label1','usdt');">
                                <span class="pay-title">
                                    <em class="pay-icon pay-icon-usdt ikon ikon-sign-usdt"></em>
                                    <span class="pay-cur">USDT TRC20</span>
                                </span>
                                <span class="pay-amount checks"><i class="fa fa-ban"></i></span>
                             </label>
                             <label class="pay-option-label pay-option-label2" onclick="javascript:paycheck('pay-option-label2','usdt');">
                                <span class="pay-title">
                                    <em class="pay-icon pay-icon-usdt ikon ikon-sign-usdt"></em>
                                    <span class="pay-cur">USDT BEP20</span>
                                </span>
                                <span class="pay-amount checks"><i class="fa fa-ban"></i></span>
                             </label>
                             <label class="pay-option-label pay-option-label3" onclick="javascript:paycheck('pay-option-label3','bnb');">
                                <span class="pay-title">
                                    <em class="pay-icon pay-icon-usdt ikon ikon-sign-bnb"></em>
                                    <span class="pay-cur">BNB</span>
                                </span>
                                <span class="pay-amount checks"><i class="fa fa-ban"></i></span>
                             </label>
							 */
							 ?>
                             <?php
							 for($i=0;$i<count($currency);$i++)
							 {
							 ?>
                             	 <div class="pay-option-label pay-option-label<?=$currency[$i]['id']?> payu" onclick="javascript:paycheck('pay-option-label<?=$currency[$i]['id']?>','<?=$currency[$i]['name']?>',<?=str_replace(",",".",$currency[$i]['price'])?>,<?=$currency[$i]['id']?>,'<?=$currency[$i]['simbol']?>');">
                                    <span class="pay-title">
                                        <?php
										if(!empty($currency[$i]['icon']))
										{
										?>
                                        <img src="<?=config_item('main_site')?>uploads/<?=$currency[$i]['icon']?>" width="16" height="16" class="pay-icon  ikon  " />
                                        <?php
										}
										?>
                                        
                                        <span class="pay-cur"><?=$currency[$i]['name']?>
                                        <?php
											if($currency[$i]['price']>0)
											{
										?>
                                        <small style="color:blue;">($<?=rtrim(number_format($currency[$i]['price'], 15), 0)?>) </small>
										<?php
											}
										?>
										 <small style="color:green;">Network <?=$currency[$i]['network']?> </small></span>
                                        
                                    </span>
                                    <span class="pay-amount checks"><i class="fa fa-ban"></i></span>
                                    
                                 </div>
                                 <?php
								 /*
								 
                                 <div class="pay-option-label xaddress">
                                       <?php
											if(!empty($currency[$i]['received_address']))
											{
										?>
                                        <br/> <p style="color:blue;">(Address For Payment : <strong><?=$currency[$i]['received_address']?>) </strong> </p>
										<?php
											}
										?>
                                 </div>
                                 */
								 ?>
                                    
                             <?php
							 	if(strtolower($currency[$i]['name'])=="usdt bep20" && strtolower($currency[$i]['network'])=="bep20")
								//else if($i==0 )
								{
							?>
                            		<script>
											$(function()
											{
												paycheck('pay-option-label<?=$currency[$i]['id']?>','<?=$currency[$i]['name']?>',<?=str_replace(",",".",$currency[$i]['price'])?>,<?=$currency[$i]['id']?>,'<?=$currency[$i]['simbol']?>');
											});
									</script>
                            <?php	
								}
							 }
							 ?>
                        </div>
                    </div>	
               </div>
         
         </div>
 
 
         <?php
		 		$max_usdtv = 0;
				$min_usdtv = 0;
				$bonus = 0;
				if(!isset($tier['id']))
				{
					$tier['min_usdt'] = 0;
					$tier['max_usdt'] = 0;
					$tier['usdt'] = 0;
					$tier['bonus'] = 0;
					
						
				}
				if(isset($tier['id']))
				{
			 	  if($tier['ends']==0)
				  {	
					$set_max = $tier['total_supply'] - $tier['order']; 
					$bonus = ($tier['bonus']/100) * $set_max;
					$totalmax = ($set_max>0 && $bonus>0)?($set_max-$bonus):0;
					$setm =  $totalmax*$tier['usdt'];
					
					$max_usdtv = ($setm < $tier['max_usdt'])? $setm:$tier['max_usdt']; 
					
					$min_usdtv = ($setm < $tier['min_usdt'])? $setm:($tier['min_usdt']+1); 
					//$tier['usdt'] 
					//total_supply
			?>
                 <div class="card radius-10 w-100 buyv">
                    
                      <div class="card-header bg-transparent">
                         <h6 class="mb-0"><?=$tier['name']?></h6>
                         <p>
                            <i>Price 1 token <strong> <?=$tier['usdt']?> </strong> usdt</i><br/>
                            <i>Price Range For Buying Token 
                            <?php
                             if($min_usdtv>$tier['min_usdt'])
                             {
                            ?>
                            <strong> <?=$tier['min_usdt']?> </strong> - <strong> <?=$tier['max_usdt']?> </strong> usdt   </i>
                            <?php
                             }else
                             {
                            ?>
                            
                             <strong> <?=$min_usdtv?> </strong> usdt   </i>
                            <?php
                             }
                            ?>
                            
                            
                         </p>
                      </div>
                       <div class="card-body">
                            <div class="row awalbuy">
                               
                                <div class="col-md-4">
                                     <!-- -->
                                     
                                     <!-- -->
                                     <div class="form-group">
                                        <label >USDT</label>
                                        <input type="text" class="form-control required"   name="usdt" id="usdts" placeholder="Usdt" min="<?=$min_usdtv?>" max="<?=$max_usdtv?>"/>
                                        <small class="infocoin"></small>
                                     </div>
                                </div>
                                <div class="col-md-8">
                                     <div class="form-group">
                                        <label>Token</label>
                                        <div class="form-control tokens" style="border-top:none; border-left:none; border-right:none; border-bottom:1px solid #ccc;">0</div>
                                        
                                     </div>
                                     
                                     <!-- -->
                                     
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><span class="namecoin"></span></td>
                                                    <td class="text-success namecoin_value ">0</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="text-right">Bonus (<?=$tier['bonus']?>%)</td>
                                                    <td class="text-success bonuses ">0</td>
                                                    
                                                </tr>
                                                <?php
                                                /*
                                                <tr>
                                                    <td class="text-right">Bonus Token</td>
                                                    <td class="text-success "><?=$tier['bonus_token']?></td>
                                                    
                                                </tr>
                                                */
                                                ?>
                                                 <tr>
                                                    <td class="text-right"><strong class=""> Total Received</strong></td>
                                                    <td class="text-success total ">0</td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                       
                                     <!-- -->
                                </div>
                                 <div class="col-md-12 text-center ">
                                    <div class="border-top my-2"></div>
                                    
                                    <button type="button" class="btn btn-warning px-5" id="buying">Buy</button>
                                 </div>
                             </div>
                             <div class="row akhirbuy" style="display:none;">    
                                 
                                
                                 <div class="col-md-12 text-center " >
                                    
                                     <div class="w-100">
                                          <div class="form-group">
                                            <strong id="coin_payment"></strong>
                                            <div class="input-group mb-3"> 
                                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                                <input type="text" class="form-control" aria-label="Value" id="coinvalue" readonly="readonly" value="0"> 
                                                 <span class="input-group-text" onclick="javascript:copytext('coinvalue');" style="cursor:pointer;"><i class="bx bx-copy"></i></span>
                                            </div>
                                          </div>   
                                          
                                         
                                         
                                      <div class="blockchain xhide">
                                             <div class="form-group">
                                                <label>Payment Address</label>
                                                <div id="qrcode" style=""></div>
                                                
                                                <div class="input-group mb-3"> 
                                                   
                                                    
                                                </div>    
                                             </div>
                                             <div class="form-group">
                                                 
                                                <div class="input-group mb-3"> 
                                                    <span class="input-group-text"><i class="bx bx-link"></i></span>
                                                    <input type="text" class="form-control" aria-label="Value" id="received_address" readonly="readonly" value=""> 
                                                     <span class="input-group-text" onclick="javascript:copytext('received_address');" style="cursor:pointer;"><i class="bx bx-copy"></i></span>
                                                </div>  
                                             </div>
                                       </div>      
                                        <!-- -->
                                        <div class="bank xhide">
                                             <h6>Choose Payment Bank</h6>
                                             <hr/>
                                             <ul class="list-group bank-group">
  
                                             
                                              	<?php
												for($i=0;$i<count($bank_transfer);$i++)
												{
												?>
                                                	
                                              	<li class="list-group-item bank-item bank-p-<?=$bank_transfer[$i]['id']?>" onclick="javascript:bank_group('<?=$bank_transfer[$i]['id']?>');">
                                                	<div class="fu pull-right"><i class="fa fa-ban"></i></div>
													<?php
													if(!empty($bank_transfer[$i]['qrcodes']))
													{
													?> 
                                                     <img src="<?=config_item('main_site')?>uploads/<?=$bank_transfer[$i]['qrcodes']?>"  class="img-responsive" width="300" height="300"/>
                                                    <?php
													}
													?> 
                                                    <br/>
                                                    <strong>
                                                    	Bank: <?=$bank_transfer[$i]['bank']?>
                                                    </strong>
                                                    <p>
                                                    	No Rekening: <?=$bank_transfer[$i]['no_rekening']?>
                                                    </p>
                                                    <p>
                                                    	Atas Nama: <?=$bank_transfer[$i]['atas_nama']?>
                                                    </p>
                                                    
                                                </li>
                                                <?php
												}
												?>
                                             </ul>
                                       </div> 
                                        <!-- --> 
                                     </div>	
                                     
                                     
                                     <div class="border-top my-2"></div>
                                    
                                     
                                    
                                        <div class=" ">
                                            <button type="button" class="btn btn-primary  " id="nexttx">Next</button> 
                                        
                                            <a href="javascript:void(0);" id="cancelbuy" class="btn btn-danger">Cancel</a>
                                        </div>    
                                      
                                        
                                 </div>
                            </div>	
                             
                             
                       </div>
                    
                 </div>
      
 		<?php
				  }else
				  {
					  
				  }
				  
				}
			?>
  </div>
  <div class="col-md-4">
      <?php
			include __DIR__."/../chunk/wallet.php";
		?>
  </div>
</div>             
<!-- end row -->
<!-- modal tx -->
<div id="modaltx" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" method="post" id="frm-object">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">HASH Transaction</h4>
      </div>
      <div class="modal-body">
      	<div class="hash_blockchain xhide">
            <div class="form-group ">
                <label>HASH</label>
                <input type="text" class="form-control required" minlength="20" maxlength="200"  name="txhash_customer" id="txhash_customer" placeholder="HASH Payment" />
            </div>
        </div>   
        
        <div class="hash_bank xhide">
            <div class="form-group">
                    	<label>Bukti Transfer(image Only)</label>
                        <div class="input-group">
                          <input type="text" class="form-control required"   placeholder="Image" id="img-container">
                          <span class="input-group-btn">
                          	<input type="file" class="hide" style="display:none" id="image" name="image"  />
                            <button class="btn btn-secondary" type="button" id="btn-upload"><i class="fa fa-upload"></i></button>
                          </span>
                        </div>
                        
                     </div>
             <div class="form-group ">
                <label>Keterangan</label>
                <textarea class="form-control required" name="keterangan" id="keterangan" ></textarea>
            </div>        
        </div>    
        
         
         
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="usdt" value="" id="usdt_vals" />
        <input type="hidden" name="id_currency" value="" id="id_currency" />
        <input type="hidden" name="id_tier" value="<?=$tier['id']?>" id="id_tier" />
        <input type="hidden" name="price" value="" id="price" />
        <input type="hidden" name="simbol" value="" id="simbol" />
        <input type="hidden" name="address_wallet" value="" id="address_wallet" />
        <input type="hidden" name="bonus" value="" id="bonus" />
        <input type="hidden" name="token" value="" id="token" />
        <input type="hidden" name="network" value="" id="network" />
        <input type="hidden" name="total" value="" id="total" />
        <input type="hidden" name="id_bank_transfer" value="" id="id_bank_transfer" />
        <input type="hidden" name="type" value="" id="type" />
        
      	<button type="submit" class="btn btn-primary">Process</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
	</form>
  </div>
</div>   

<script>

$(function()
{
	$("#usdts").on('input',function()
	{
		//var bonustoken = parseFloat('<?=$tier['bonus_token']?>');
		var totals = 0 ;
		var totals_bonus = 0;
		var ns = $(this).val();
		$("#usdt_vals").val(ns);
		var bonus = <?=$tier['bonus']?>/100;
		$(".infocoin").html("");
		<?php
		/*
		if(simbol=="bnb")
		{
			var isian = ns; //convert 0.005 btc to usd
			var exchangeRate = parseInt(<?=isset($coin['binancecoin']['usd'])?$coin['binancecoin']['usd']:0?>);
			var amount = isian * exchangeRate;
			console.log(amount);
			totals = amount.toFixed(9) / <?=$tier['usdt']?>;
			$(".infocoin").html("<b>$</b> " + amount.toFixed(9));
			totals_bonus = bonus*totals;
		}else
		{
			totals = ns / <?=$tier['usdt']?>;
			totals_bonus = bonus*totals;
			
		}*/
		?>
		if(prices>0)
		{
			var isian = ns; //convert 0.005 btc to usd
			var exchangeRate = parseFloat(prices);
			var amount = isian / exchangeRate;
			
			console.log(amount);
			$(".namecoin_value").html(amount.toFixed(9));
			
			totals = isian / <?=$tier['usdt']?>;
			//$(".infocoin").html("<b>$</b> " + amount.toFixed(9));
			totals_bonus = bonus*totals;
			$("#price").val(amount.toFixed(9));
			$("#coinvalue").val(amount.toFixed(9));
		}else
		{
			
			$(".namecoin_value").html(ns);
			totals = ns / <?=$tier['usdt']?>;
			
			totals_bonus = bonus*totals;
			$("#price").val(ns);
			$("#coinvalue").val(ns);
		}
		
		
		<?php
		if($min_usdtv<$tier['min_usdt'])
        {
        ?>
			totals_bonus = <?=$bonus?>;
		<?php
		}
		?>	
		$(".tokens").html(totals.toFixed(0));
		$(".bonuses").html(totals_bonus.toFixed(0));
		var total_all = totals + totals_bonus; //totals + totals_bonus + bonustoken;
		$(".total").html(total_all.toFixed(0));
		
		$("#bonus").val(totals_bonus.toFixed(0));
		$("#token").val(totals.toFixed(0));
		$("#total").val(total_all.toFixed(0));
		
	});
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
		rules: {
			 
			 usdt: {
				required: true,
				min: <?=$min_usdtv?>,
				max: <?=$max_usdtv?>, 
			}
		},
		messages: {
			 
			usdt: {
				required: "Enter a usd",
				min:"min <?=$min_usdtv?> usd",
				max:"max <?=$max_usdtv?> usd",
				 
			}
		},
		submitHandler:function(){
			/*var req = post('<?=site_url('buy/save')?>',$("#frm-object").serialize());
			req.done(function(out){
				if(out.error==false)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('my-token')?>";
				}
				else
				{
					smart_message(out.message);
				}
			});
			req.fail(function()
			{
				smart_message("failed buying, check your connection then refresh page");
			});
			return false;
			*/
			if(coinsimbol=="binanceidr")
			{
				var id_bankx = $("#id_bank_transfer").val();
				if(id_bankx =="")
				{
					smart_message("Choose Bank");
					return;	
				}
			}
			var formdata = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url('buy/save')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href="<?=site_url('my-token')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
	//
	$("#buying").on('click',function()
	{
		$("#type").val(0);
		console.log(coinsimbol);
		var usdts = $("#usdts").val();
		if((usdts >= <?=$min_usdtv?>) && (usdts <= <?=$max_usdtv?>) )
		{
			if(coinsimbol=="binanceidr")
			{
				$("#type").val(1);
				$(".blockchain").addClass("xhide"); 
				$(".bank").removeClass("xhide");
			}
			else
			{
				$(".blockchain").removeClass("xhide"); 
				$(".bank").addClass("xhide");
			}
			
			$(".akhirbuy").show();
			$(".awalbuy").hide();
			awalbuys = 1;
		}else
		{
			smart_message("Min <?=$min_usdtv?> and max <?=$max_usdtv?> usdt");	
		}
		
	});
	//cancelbuy
	$("#cancelbuy").on('click',function()
	{
		$(".akhirbuy").hide();
		$(".awalbuy").show();
	});
	//nexttx
	$("#nexttx").on('click',function()
	{
		if(coinsimbol=="binanceidr")
		{
				$("#modaltx").find(".modal-title").text("Bukti Transfer");
				$(".hash_blockchain").addClass("xhide"); 
				$(".hash_bank").removeClass("xhide");
				$("#modaltx").find("#txhash_customer").removeClass("required");
				$("#modaltx").find("#img-container").addClass("required");
				$("#modaltx").find("#keterangan").addClass("required");
		}
		else
		{
				$("#modaltx").find("#txhash_customer").addClass("required");
				$("#modaltx").find("#img-container").removeClass("required");
				$("#modaltx").find("#keterangan").removeClass("required");
				
				$("#modaltx").find(".modal-title").text("Hash Payment");
				$(".hash_blockchain").removeClass("xhide"); 
				$(".hash_bank").addClass("xhide");
		}
		$("#modaltx").modal("show");
	});
	$("#btn-upload").on('click',function(){
		$("#image").trigger('click');
	});
	$("#image").on('change',function(){
		$("#img-container").val($(this).val());
	});
});
</script>
  