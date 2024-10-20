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
    content: "\f217";
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
			<?php
				 
					$bn = "$";
					$values = 1;
					 
					$pricex = setting('price_coin');
					$totalp = ($pricex>0 && $values>0)? $values/$pricex:0;
					$totalp = number_format($totalp,4);
					$minprice = floatval(setting('min_buy'))*$pricex;
					$minprice = number_format($minprice,2);
			?>
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
                            <div class="col-md-12 ">
                               		 <img src="assets/images/product/A-1.jpeg" class="img-responsive" width="80%"/>
                                </div>
                            <h2><strong><?=custom_language('Buy')?> <?=setting("coin_name")?></strong></h2>
                            <p><?=custom_language('Fill all form field to go to next step')?>
                            <br/>
                            <span style="color:blue;"><?=custom_language('Your Balance')?>: <b>$<?=number_format(floatval(user_balance('balance')),2)?></b> </span> 
                            <br/>
                            <strong style="color:red;">1 <?=setting("coin_name")?> = $<?=number_format(floatval(setting('price_coin')),2)?> </strong></p>
                            
                            <div class="row">
                                
                                <div class="col-md-12 mx-0">
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="account" data-key="1"><strong><?=custom_language('Buy')?></strong></li>
                                            <li id="personal" data-key="2"><strong><?=custom_language('Promo')?></strong></li>
                                            <li id="noteconfirm" data-key="4"><strong><?=custom_language('Confirm')?></strong></li> 
                                             
                                        </ul>
                                        <!-- fieldsets -->
                                        <fieldset  class="1  ">
                                            <h5 style="color:green;"> 
											<?=custom_language('Minimum Purchase')?> <br/>
											<?=number_format(floatval(setting("min_buy")),2)?> <?=setting('coin_name')?> = $<?=$minprice?>
                                            </h5>
                                            <div class="row  ">
                                                
                                                <div class="col-12">
                                                     
                                                    <div class="form-group form-custom form-label form-border">
                                                            <h4 class="pt-1 mb-n1 font-16  "> <?=setting('coin_name')?></h4>
                                                             <input type="number" class="form-control exchange-value   rounded-xs" id="total_coin" name="total_coin" placeholder="0" min="<?=floatval(setting('min_buy'))?>" value="1" pattern="([0-9]+.{0,1}[0-9]*,{0,1})*[0-9]" required />
                                                           
                                                         
                                                    </div>
                                                    <div class="message_buy xhide">
                                                    		<p class="text-red" style="float:right; color:red;"><?=custom_language('Estimated payment')?>： <b class="not_mesage">0</b> </p>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                            </div>
                                            <div class="row  btn-trigger">
                                            	<?php
												/*
                                                <div class="col-3">
                                                	<a class="btn btn-secondary text-white">1</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn btn-secondary text-white">10</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn btn-secondary text-white">50</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn btn-secondary text-white">100</a>
                                                </div>
												*/
												?>
                                                <div class="col-3">
                                                	<a class="btn bg-grey text-white" style="background:red;" data-val="10" data-id="" data-diskon=="0">10</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn bg-orange text-white" style="background:red;" data-val="100" data-id="" data-diskon=="0">100</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn bg-yellow text-white" style="background:red;" data-val="300" data-id="" data-diskon=="0">300</a>
                                                </div>
                                                <div class="col-3">
                                                	<a class="btn bg-red text-white" style="background:red;" data-val="500" data-id="" data-diskon=="0">500</a>
                                                </div>
                                                <?php
													/*if(count($packs)>0)
													{
														$clsp = "col-12";
														if(count($packs)==3)
														{
															$clsp = "col-4";
														}
														if(count($packs)==2)
														{
															$clsp = "col-6";
														}
														if(count($packs)==4)
														{
															$clsp = "col-3";
														}
														if(count($packs)>4)
														{
															$clsp = "col-2";
														}
														for($i=0;$i<count($packs);$i++)
														{
															$css_level = "";
															 
															$yp = explode(" ",$packs[$i]['name']);
															if(is_array($yp))
															{
																$css_level = strtolower($yp[0]);	
															}
															
												?>
                                                			<div class="<?=$clsp?>">
                                                                    <a class="btn   text-black <?=$css_level?>" data-id="<?=$packs[$i]['id']?>" data-val="<?=$packs[$i]['perfomances']?>" data-diskon="<?=floatval($packs[$i]['discount'])?>"><?=custom_language($packs[$i]['name'])?> <?=(floatval($packs[$i]['discount'])>0)?"<br/> ".custom_language("Disc")."(".floatval($packs[$i]['discount'])."%)":""?></a>
                                                                </div>
	                                                	
                                                <?php
														}
													}*/
												?>
                                            </div>
                                            <hr/>
                                            <input type="button"   class="next action-button next1" value="<?=custom_language('Next Step')?>"/>
                                        </fieldset>
                                        <fieldset class="2 xhide">
                                            <div class="form-card">
                                                <h2 class="fs-title"><?=custom_language('Promo Code')?></h2>
                                                <input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="<?=custom_language('Promo Code')?>"/>
                                                <div class="message xhide" style="color:green;">
                                                	<?=custom_language('Congraturalion Got Promo')?> <span><b></b></span>
                                                </div>
                                                
                                                <br/>
                                                <small><i><b><?=custom_language('if you dont have promo, just click next')?></b></i></small>
                                                
                                            </div>
                                            <input type="button"   class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                            <input type="button"   class="next action-button" value="<?=custom_language('Next Step')?>"/>
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
                                                              
                                                             <div class="form-group"  >
                                                                <h5><?=custom_language('Payment')?> <b class="totalv pull-right"></b></h5><br/>
                                                                <h5 class="promotexth4"><?=custom_language('Promo')?> <b class="promotext pull-right"></b></h5><br/>
                                                                <h5 class="totalallsh4"><?=custom_language('Total')?> <b class="totalalls pull-right"></b></h5><br/>
                                                                
                                                             </div>
                                                        </div> 
                                                     </div>
                                                </div>     
                                                 
                                                <!-- -->
                                                 <input type="hidden" value="" name="id_promo" id="id_promo" /> 
                                                 <input type="hidden" value="" name="promo_value" id="promo_value" />
                                                 <input type="hidden" value="" name="total" id="total" />
                                                 <input type="hidden" value="" name="value_total" id="value_total" />
                                                 <input type="hidden" value="" name="diskon" id="diskon" />
                                                 
                                                 <input type="hidden" value="" name="id_package" id="id_package" />
                                                 
                                                  <input type="button"   class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                            	  <input type="submit"   class="action-button" value="Buy"/>
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
var discount = 0;
$(document).ready(function(){
    
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;


$(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    console.log(current_fs);
    console.log(next_fs);
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
	var value_total = $("#value_total").val();
	textis();
	if(value_total>=<?=$minprice?>)
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
		smart_message("<?=custom_language("Min Buy")?> $<?=$minprice?>")	
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
	
	var promotext = $("#promo_code").val();
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
					url:"<?=site_url('buy/promorcode')?>",
					data:{
						promo_code:function(){
							return $("#promo_code").val();
						},
						id_package:function(){
							return $("#id_package").val();
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
			var value_total = $("#value_total").val();
			if(value_total><?=user_balance('balance')?>)
			{
				$("#promo_code").val("");	
				$(".message").addClass("xhide");
				$(".message span").html("");
				smart_message("<?=custom_language('Balance is not enough')?>");
				
				return;	
			}
			var id_package = $("#msform #id_package").val();
			var promo_code = $("#msform #promo_code").val();
			if(promo_code != "")
			{
				$("#msform #id_package").val("");
			}
			var formdata = new FormData($("#msform")[0]);
			var req = postFile('<?=site_url('buy/save')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href="<?=site_url('activity')?>?active=buy";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
	/*
	$("#msform #value_total").keyup(function()
	{
		var yprice = $(this).val();
		var price_x = <?=setting('price_coin')?>;
		 
		var xj = (price_coin * yprice) / parseFloat(price_x);
		$("#msform #total_coin").val(xj);
	});
	*/
	$("#msform #total_coin").keyup(function()
	{
		$("#msform #id_package").val("");
		discount = 0;
		total_coinj();
	});
	$(".btn-trigger a").click(function()
	{
		//var ct = $(this).text();
		var ct = $(this).attr("data-val");
		var id_package = $(this).attr("data-id");
		discount = $(this).attr("data-diskon");
		
		$("#msform #promo_code").val("");
		promo_value = 0;
		$("#msform #total_coin").val(ct);
		$("#msform #id_package").val(id_package);
		$(".message").addClass("xhide");
		total_coinj();
	});
	total_coinj();
});
function total_coinj()
{
	$("#msform .next1").removeClass("xhide");
	var ytotal_coin = $("#msform #total_coin").val();
	var price_x = <?=setting('price_coin')?>;
	var xj = (price_x * ytotal_coin);
	$("#msform #total").val(xj);
	var cdisck = 0;
	if(discount>0)
	{
		cdisck = (discount/100) * xj;
		xj = xj - cdisck;		
	}
	$("#msform .message_buy").removeClass("xhide");
	$("#msform .message_buy b").text(xj);
	
	$("#msform #value_total").val(xj);
	$("#msform #diskon").val(cdisck);
	if(xj><?=floatval(user_balance('balance'))?>)
	{
		$("#msform .next1").addClass("xhide");
	}
}
</script>        