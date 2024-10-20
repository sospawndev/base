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

#progressbar #validation:before {
    font-family: FontAwesome;
    content: "\f084";
}
#progressbar #wallet:before {
    font-family: FontAwesome;
    content: "\f1ee";
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
                            <h2><strong><?=custom_language('Withdraw Balance')?></strong></h2>
                            <p><?=custom_language('Fill all form field to go to next step')?>
                            <br/>
                            <span style="color:blue;"><?=custom_language('Your Balance')?>: <b>$<?=number_format(user_balance('balance'),2)?></b> </span>
                            
                            <br/>
                            
                            
                            </p>
                            
                             
                            <hr/>
                            <p>
                            	 
                                <span class="alert alert-danger" ><?=$currency['name']?>  <b><?=$currency['network']?></b> </span>
                            </p>
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                             
                                            <li id="personal" data-key="1"><strong><?=custom_language('Amount')?></strong></li>
                                            <li id="wallet" data-key="2"><strong><?=custom_language('Wallet Address')?></strong></li>
                                            <li id="validation" data-key="3"><strong><?=custom_language('Verification')?></strong></li>
                                            
                                            
                                             
                                        </ul>
                                        <!-- fieldsets -->
                                        <fieldset  class="1  ">
                                             
                                            <div class="form-card">
                                                <h2 class="fs-title"><?=custom_language('Amount')?></h2>
                                                <input type="number" name="amount" id="amount" class="form-control required"   placeholder="<?=number_format(setting('min_transfer'),2)?>"  min="<?=number_format(setting('min_wd'),2)?>" max="<?=number_format(user_balance('balance'),2)?>" />
                                                
                                            </div>
                                            <input type="button"   class="next action-button next1" value="<?=custom_language('Next Step')?>"/>
                                        </fieldset>
                                        <fieldset  class="2  xhide">
                                             
                                            <div class="form-card">
                                                <h2 class="fs-title"><?=custom_language('Wallet Address')?></h2>
                                                <input type="text" name="receive_address" id="receive_address" class="form-control required"   placeholder=" " value="<?=user_info('wallet_address')?>"  />
                                                
                                            </div>
                                            <input type="button"   class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                            <input type="button"   class="next action-button" value="<?=custom_language('Next Step')?>"/>
                                        </fieldset>
                                        <fieldset class="3 xhide">
                                            <div class="form-card">
                                               <h2 class="fs-title"><?=custom_language('Email Verification')?></h2>
                                                <input type="text" name="email_verifikasi" id="email_verifikasi" class="form-control required" placeholder=""/>
                                                <div class="message_verifikasi xhide" style="color:green;">
                                                	 
                                                </div>
                                                
                                                <br/>
                                                <small><i><b><?=custom_language('Check you Email inbox or spam')?></b></i></small>
                                                ,  <a href="javascript:void(0)" onclick="javascript:resend_verification_email();"><?=custom_language('Click Here To Resend Verification')?></a>
                                            </div>
                                            <input type="button"   class="previous action-button-previous" value="<?=custom_language('Previous')?>"/>
                                             
                                            <input type="hidden" name="id_currency" value="<?=$currency['id']?>" />
                                            <input type="submit"   class="action-button" style="background:#069;" value="<?=custom_language('Process')?>"/> 
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
var acc_code = "";

$(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    console.log(current_fs);
    console.log(next_fs);
	var receive_address = $("#msform #receive_address").val();
    //Add Class Active
    if(eq==2)
	{
		if(receive_address == "")
		{
				smart_message("<?=custom_language("Wallet Address Empty")?>");
			return;
		} 
	}
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
	var value_total = $("#amount").val();
	textis();
	if(value_total>=<?=setting("min_transfer")?>)
	{
		  
		 $("fieldset."+ (eq) +"").addClass("xhide"); 
	
		 $("fieldset."+ (eq+1) +"").removeClass("xhide"); 
		 console.log(acc_code);
		 if(acc_code==="" && eq==2)
		 {
			 verification_email();
		 }

		 eq +=1;
		 if(eq==2)
		 {
			nextv = true;	
		 }
	}else
	{
		smart_message("<?=custom_language("Min Transfer")?> $<?=setting("min_transfer")?>")	
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
	
	 
	
}
$(function()
{
	$("#msform").validate({
		ignore:[],
		 
		messages:{
			akun_identity : {
				remote : "<?=custom_language('Akun Identity cannot be used')?>"
			},
			email_verifikasi : {
				remote : "<?=custom_language('Email Code Varification cannot be used')?>"
			}, 
		},
		rules:{
			 
			akun_identity:{
				remote:{
					url:"<?=site_url('withdraw/akun_identity')?>",
					data:{
						akun_identity:function(){
							return $("#akun_identity").val();
						} 
						 
					},
					dataFilter:function(out)
					{
						$(".message_akun").addClass("xhide");
						var json = JSON.parse(out); 
						if(json.error==true)
						{
							return false;
						}
						$(".message_akun").removeClass("xhide");
						$(".message_akun").html("<?=custom_language('Validation Identity Success')?> <?=custom_language('Name')?>: <b>"+ json.arr.name+"</b>");
						 return true;
					}
				}
			},
			email_verifikasi:{
				remote:{
					url:"<?=site_url('withdraw/email_verifikasi')?>",
					data:{
						akun_identity:function(){
							return $("#email_verifikasi").val();
						} 
						 
					},
					dataFilter:function(out)
					{
						$(".message_verifikasi").addClass("xhide");
						var json = JSON.parse(out); 
						if(json.error==true)
						{
							return false;
						}
						$(".message_verifikasi").removeClass("xhide");
						$(".message_verifikasi").html("<?=custom_language('Email Verification Success')?>");
						 return true;
					}
				}
			}
		},
		submitHandler:function(){
			var receive_address = $("#receive_address").val();
			if (receive_address === "") {
				 smart_message("<?=custom_language('Wallet Address Empty')?>");
				 return;
			} 
			var formdata = new FormData($("#msform")[0]);
			var req = postFile('<?=site_url('withdraw/save')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href="<?=site_url('activity')?>?active=wd";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
	$("#msform #amount").keyup(function()
	{
		$("#msform .next1").removeClass("xhide");
		var cam = $(this).val();
		if(cam><?=user_balance('balance')?>)
		{
			$("#msform .next1").addClass("xhide");
		}
		//user_balance('balance')
		
	});
});
function verification_email()
{
	var formdata = new FormData($("#msform")[0]);
	var req = postFile('<?=site_url('withdraw/validation_key')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					 acc_code=out.arr.acc_code;
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;	
}
function resend_verification_email()
{
	var req = get('<?=site_url('withdraw/resend_validation_key')?>',{id:1}); 
			req.done(function(out){
				if(!out.error)
				{
					 acc_code=out.arr.acc_code;
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;	
}
</script>        