<style type="text/css">
/*Background color*/
#grad1 {
    background: : transparent;
   
}

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;

    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
   /* display: none;*/
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
}



#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0;
}

/*Blue Buttons*/
#msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
}

/*Dropdown List Exp Date*/
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 33.2%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f01a";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f1f2";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d";
}

#progressbar #noteconfirm:before {
    font-family: FontAwesome;
    content: "\f044";
}
#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;

    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: skyblue;
}

/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}

.radio {
    display:inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor:pointer;
    margin: 8px 2px; 
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}

.pay-option-label.xaddress
{
	background-color:#ccc;
}
#qrcode img
{
	text-align:center;
	padding-left: 25%;	
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
		padding-left: 0;	
	}
	span.titletoptup {
		float: left;
	}
	.mobile.depo
	{
		display:none;	
	}
}

</style>		 

        <div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                
            </div>
        </div>
        <div class="card card-style">
        	
            <!-- -->
            
            <div class="container-fluid" id="grad1">
                <div class="row justify-content-center mt-0">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2><strong><?=custom_language('Top Up Account')?></strong></h2>
                            <p><?=custom_language('Fill all form field to go to next step')?></p>
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="account" data-key="1"><strong><?=custom_language('Top Up')?></strong></li>
                                            <li id="payment" data-key="3"><strong><?=custom_language('Payment')?></strong></li>
                                            <li id="noteconfirm" data-key="4"><strong><?=custom_language('Confirm')?></strong></li> 
                                             
                                        </ul>
                                        <!-- fieldsets -->
                                        <fieldset  class="1  ">
                                            <div class="form-card">
                                                <h2 class="fs-title">USD($)</h2>
                                                <input type="number" name="value_total" id="value_total" class="form-control required" min="<?=setting('min_invest')?>" placeholder="usdt" value="<?=setting('min_invest')?>"/>
                                                
                                            </div>
                                            <input type="button"   class="next action-button" value="<?=custom_language('Next Step')?>"/>
                                        </fieldset>
                                        
                                        <fieldset class="2 xhide">
                                            <div class="form-card">
                                                <h2 class="fs-title"><?=custom_language('Payment Information')?></h2>
                                                <!-- -->
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
															<p class="mb-0 opacity-50 mobile depo"><?=custom_language('Deposit Address')?>: <b><?=$currency[$i]['received_address']?></b></p>
														</div>
														<div class="align-self-center m-auto">
															<div id="chart-btc" class="chart mt-n5 pt-4 ms-n3"><!-- plugins/apex/apex-call.js --></div>
														</div>
														<div class="ms-auto">
															<h4 class="mb-n1 pt-2">1 <?=$bn?> = <?=$totalp?> <?=setting('coin_name')?></h4>
															<h5 class="mb-0 color-green-dark text-end"><small><?=custom_language('Network')?> <?=$currency[$i]['network']?></small></h5>
														</div>
													</a>
												</div>
											<?php
												}
											?>
                                            
                                                <!-- --> 
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                            <input type="button" name="make_payment" class="next action-button" value="<?=custom_language('Next Step')?>"/>
                                        </fieldset>
                                        <fieldset class="3 xhide">
                                            <div class="form-card">
                                                <!-- -->
                                                <div class="card card-style"> 
                                                     <div class="content  qrcode_o xhide">
                                                          <div class="row  ">
                                                                <div class="col-12">
                                                                    <!-- -->
                                                                    <!-- -->
                                                                     <div class="form-group">
                                                                        <h4 class="pt-1 mb-n1 font-16 text-center "> <?=custom_language('Deposit Address')?><b class="rec_dev"></b></h4> 
                                                                        <hr />
                                                                        <div class="input-group mb-3"> 
                                                                            <span class="input-group-text"><i class="bi bi-link"></i></span>
                                                                            <input type="text" class="form-control" aria-label="rec_addr" id="rec_addr" readonly="rec_addr" value=""> 
                                                                             <span class="input-group-text" onclick="javascript:CopyToClipboard('rec_addr');" style="cursor:pointer;"><i class="fa fa-copy"></i></span>
                                                                        </div>
                                                                       
                                                                        
                                                                        
                                                                      </div>
                                                                      <div id="qrcode" style=""></div>
                                                                    <!-- -->
                                                                </div>
                                                           </div>
                                                        </div>	
                                                    </div>
                                                <div class="card card-style"> 
                                                	<div class="row  ">
                                                    	<div class="col-12">
                                                             <hr/>
                                                             <div class="form-group"  >
                                                                <h5><?=custom_language('Payment')?> <b class="totalv pull-right"></b></h5><br/>
                                                                <h5 class="promotexth4"><?=custom_language('Promo')?> <b class="promotext pull-right"></b></h5><br/>
                                                                <h5 class="totalallsh4"><?=custom_language('Total')?> <b class="totalalls pull-right"></b></h5><br/>
                                                                
                                                             </div>
                                                        </div> 
                                                     </div>
                                                </div>     
                                                <h4 class="pt-1 mb-n1 font-16  "><?=custom_language('Input Your tx id after transfer')?></h4>
                                       
                                     			<input type="text" class="form-control exchange-value   rounded-xs required" id="tx_hash" name="tx_hash" placeholder="0x"  />
                                                <!-- -->
                                                 <input type="hidden" value="" name="simbol" id="simbol" />
                                                 <input type="hidden" value="" name="coin_name" id="coin_name" />
                                                 <input type="hidden" value="" name="network" id="network" />
                                                 <input type="hidden" value="" name="received_address" id="received_address" /> 
                                                 <input type="hidden" value="" name="id_currency" id="id_currency" />
                                                 <input type="hidden" value="" name="id_promo" id="id_promo" /> 
                                                 <input type="hidden" value="" name="promo_value" id="promo_value" />
                                                 <input type="hidden" value="" name="total" id="total" /> 
                                                  <input type="button"   class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                            	  <input type="submit"   class="action-button" value="<?=custom_language('Top Up')?>"/>
                                            </div>
                                        </fieldset>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -->
            
        
        </div>    
             



<script>
var promo_value = 0;
var eq = 1;
var nextv=false;
$(document).ready(function(){
    
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;


$(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    console.log(current_fs);
    console.log(next_fs);
	var id_currencyeq = $("#msform #id_currency").val();
    //Add Class Active
    if(eq==2)
	{
		if(id_currencyeq == "")
		{
				smart_message("<?=custom_language("Pls select which USDT network , TRC20, BEP20 or ERC20")?>");
			return;
		} 
	}
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
	var value_total = $("#value_total").val();
	//id_currency
	
	textis();
	if(value_total>=<?=setting("min_invest")?>)
	{
		  
		  
		 $("fieldset."+ (eq) +"").addClass("xhide"); 
		
		 $("fieldset."+ (eq+1) +"").removeClass("xhide"); 
		 eq +=1;
		 if(eq==4)
		 {
			nextv = true;	
		 }
	}else
	{
		smart_message("<?=custom_language("Min Invest")?> $<?=setting("min_invest")?>");
	}
     
	//next_fs.show(); 
    //hide the current fieldset with style
    /*current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });*/
	
	
});

$(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    /*
	//show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
	*/
	 $("fieldset."+ (eq-1) +"").removeClass("xhide"); 

	 $("fieldset."+ (eq) +"").addClass("xhide"); 
	 eq -=1;
});
$("#progressbar li").click(function(e){
	
	if(nextv)
	{
		 var ct = $(this).attr("data-key");
		 for(var i=1;i<5;i++)
		 {
			 
			$("fieldset."+ (i) +"").addClass("xhide"); 
		 }
		  
		 for(var i=0;i<=(ct-1);i++)
		 {
			console.log(i);
			$("#progressbar li:nth-child("+ (i+1) +")").addClass("active");
		 }
		 for(var i=(ct-1);i<=3;i++)
		 {
			$("#progressbar li:nth-child("+ (i+1) +")").removeClass("active");
			  
		 } 
		$("#progressbar li:nth-child("+ (ct) +")").addClass("active"); 
		$("fieldset."+ (ct) +"").removeClass("xhide");
		eq = ct; 
	}
});
$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
});

$(".submit").click(function(){
    return false;
});
    
});
function textis()
{
	
	var promotext = ""; //$("#promo_code").val();
	if(promotext === "")
	{
		$(".promotexth4").addClass("xhide");
		$(".totalallsh4").addClass("xhide");
	}else
	{
		$(".promotexth4").removeClass("xhide");
		$(".totalallsh4").removeClass("xhide");	
	}
	
	var value_total = $("#value_total").val();
	var totalalls = value_total - promo_value;
	$(".promotext").html("$"+ promo_value);	
	$(".totalv").html("$"+ value_total);
	$(".totalalls").html("$"+ totalalls);
	$("#msform #total").val(totalalls);
	
}
$(function()
{
	$("#msform").validate({
		ignore:[],
		 
		messages:{
			promo_code : {
				remote : "Promo cannot be used"
			},
			 
		},
		rules:{
			 
			promo_code:{
				remote:{
					url:"<?=site_url('payment/promorcode')?>",
					data:{
						promo_code:function(){
							return $("#promo_code").val();
						},
						value_total:function(){
							return $("#value_total").val();
						}
						 
					},
					dataFilter:function(out)
					{
						$(".message").addClass("xhide");
						promo_value = 0;
						var json = JSON.parse(out);
						if(json.error==true)
						{
							return false;
						}
						console.log(json);
						$(".message").removeClass("xhide");
						promo_value = json.data; 
						$("#msform #id_promo").val(json.arr.id);
						$("#msform #promo_value").val(promo_value);
						textis();
						$(".message span").html(json.message);
						return true	;
					}
				}
			}
		},
		submitHandler:function(){
			if(id_currency<=0)
			{
				smart_message("<?=custom_language("Pls select which USDT network , TRC20, BEP20 or ERC20")?>");
				 return;	
			}
			var tx_hash= $("#msform #tx_hash").val();
			if(id_currency=="")
			{
				smart_message("<?=custom_language("Input Your tx id after transfer")?>");
				 return;	
			}
			var formdata = new FormData($("#msform")[0]);
			var req = postFile('<?=site_url('payment/savetopup')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href="<?=site_url('activity')?>?active=topup";
				}
				else
				{
					//smart_error_box(out.message,'#frm-object .block-content');
					smart_message(out.message);
				}
			});
			return false;
		}
	});
});
</script>        