<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<link rel="stylesheet" href="assets/tabs/css/style.css" type="text/css" media="all" />
<style type="text/css">
form#msform .form-control {
    color: #000 !important;
    background-color: transparent !important;
}
form#msform input::placeholder { /* Microsoft Edge */
  color: #000 !important;
  opacity: 1;
}
</style>
	<section class="article-wrapper">
				<div class="article-container">
					<div class="article-block">
						<div class="entry-content">
							<h1><?=custom_language('Withdraw Balance')?></h1>
							<p><?=custom_language('Fill all form field to go to next step')?></p>
						</div>
					</div>
				</div>
			</section>
			 <form id="form-object">
            <section class="tabs-wrapper">
				<div class="tabs-container">
					<div class="tabs-block">
						<div id="tabs-section" class="tabs">
							<ul class="tab-head">
								<li>
									<a href="#tab-1" class="tab-link tab-1 active"> <span class="material-icons tab-icon">face</span> <span class="tab-label">Amount</span></a>
								</li>
								 
								<li>
									<a href="" class="tab-link tab-2" > <span class="material-icons tab-icon">build</span> <span class="tab-label">Verification</span></a>
								</li>
								 
							</ul>

							<section id="tab-1" class="tab-body entry-content active active-content 2">
								<h2><?=custom_language('Amount')?></h2>
								 			 
                                            <div class="form-card">
                                                <h2 class="fs-title"> </h2>
                                                <input type="number" name="amount" id="amount" class="form-control required"   placeholder="<?=number_format(setting('min_wd'),2)?>"  min="<?=number_format(setting('min_wd'),2)?>" max="<?=number_format(user_balance('balance'),2)?>" />
                                                
                                            </div>
                                            <span class="message_texts xhide"> <small>Your balance will be deduce <b class="message_deduce" style="color:red;">0</b></small></span> 
                                            <input type="button"   class="next action-button pull-right" value="<?=custom_language('Next Step')?>"/>
							</section>

							<section id="tab-2" class="tab-body entry-content 2">
								<h2><?=custom_language('Verification Code')?></h2>
                                		<h5 class=" text-center alert alert-warning"><span class="acc_code"></span></h5>
								  		<div class="form-card">
                                                
                                                <input type="text" name="email_verifikasi" id="email_verifikasi" class="form-control required" placeholder=""/>
                                                
                                                <div class="message_verifikasi xhide" style="color:green;">
                                                	 
                                                </div>
                                                
                                                <br/>
                                                <?php
												/*
                                                <small><i><b><?=custom_language('Check you Email inbox or spam')?></b></i></small>
                                                ,  <a href="javascript:void(0)" onclick="javascript:resend_verification_email();"><?=custom_language('Click Here To Resend Verification')?></a>
												*/
												?>
                                            </div>
                                            <input type="button"   class="previous action-button-previous pull-left" value="<?=custom_language('Previous')?>"/>
                                             
                                            
                                            <input type="submit"   id="wds"   class="action-button pull-right xhide" style="background:#069;" value="<?=custom_language('Withdraw')?>"/> 
							</section>

							 
						</div>
					</div>
				</div>
			</section>
         </form>   
  <script src="assets/tabs/js/app.js"></script>     
  
  <script>
  var additionalfee = <?=floatval(setting("wd_additionalfee"))?>;
  var totalmin_wd = parseFloat(additionalfee) + <?=floatval(setting("min_wd"))?>;
  var user_balancing = <?=user_balance('balance')?>;
  $(document).ready(function(){
    
		
		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
		var acc_code = "";
		
		var check_akunidentity = false;
		$(".next").click(function(){
			//
			 	var akun_identitys = $("#form-object #akun_identity").val();
				var value_total = $("#amount").val();
				value_total = parseFloat(value_total);
				value_total += additionalfee;
			 	if(akun_identitys == "")
				{
						smart_message("<?=custom_language("Akun Identitiy Empty")?>");
					return;
				}
				if(value_total == "")
				{
					smart_message("<?=custom_language("Amount Empty")?>");
					return;
				} 
				if($(".message_akun").hasClass("xhide"))
				{
					smart_message("<?=custom_language("Akun Identity cannot be used")?>");
					return;
				}
			 
			 
			
			//show the next fieldset
			
			  
			if(value_total<totalmin_wd)
			{
				  
				 
				smart_message("<?=custom_language("Min Withdraw")?> <?=number_format(setting("min_wd"),0)?>");
				return;
				  
			}
			if(value_total>user_balancing)
			{
				smart_message("<?=custom_language("Your Withdraw More than Your balance")?>");
				return;
			}
			 
			//$("fieldset."+ (eq) +"").addClass("xhide"); 
			
				 //$("fieldset."+ (eq+1) +"").removeClass("xhide"); 
				 $(".tab-2").attr("href","#tab-2");
				 $(".tab-2").trigger("click");
				 console.log(acc_code);
				 if(acc_code==="")
				 {
					 verification_email();
				 }
			///
		});
		$(".previous").click(function(){
			 current_fs = $(this).parent();
			  previous_fs = $(this).parent().prev();
			 console.log($(".entry-content").index(previous_fs));
			
			 $("#wds").addClass("xhide");	
				//Remove class active
			 $(".tab-head li a.tab-"+ ($(".entry-content").index(previous_fs)) +"").trigger("click");
		});
		$("#amount").keyup(function()
		{
			amount_c();
		});
		
  });
  
  $(function()
	{
		$("#form-object").validate({
			ignore:[],
			 
			messages:{
				akun_identity : {
					remote : "<?=custom_language('Akun Identity cannot be used')?>"
				},
				email_verifikasi : {
					remote : "<?=custom_language('Verification cannot be used')?>"
				}, 
			},
			rules:{
				 
				akun_identity:{
					remote:{
						url:"<?=site_url('withdraws/akun_identity')?>",
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
							check_akunidentity = true;
							 return true;
						}
					}
				},
				email_verifikasi:{
					remote:{
						url:"<?=site_url('withdraws/email_verifikasi')?>",
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
							$(".message_verifikasi").html("<?=custom_language('Verification Success')?>");
							$("#wds").removeClass("xhide");
							 return true;
						}
					}
				}
			},
			submitHandler:function(){
				 
				var formdata = new FormData($("#form-object")[0]);
				var req = postFile('<?=site_url('withdraws/save_tf')?>',formdata);
				req.done(function(out){
					if(out.error==false)
					{
						if(out.message=="autooclose")
						{
							document.location.href = window.location;
							return;
						}
						document.location.href="<?=site_url('activity')?>?active=wd";
					}
					else
					{
						smart_message(out.message);
						smart_error_box(out.message,'#frm-object .block-content');
					}
				});
				return false;
			}
		});
	});
	function verification_email()
	{
		var formdata = new FormData($("#form-object")[0]);
		var req = postFile('<?=site_url('withdraws/validation_key')?>',formdata);
				req.done(function(out){
					if(!out.error)
					{
						 acc_code=out.arr.acc_code;
						  $(".acc_code").text(acc_code);
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
		var req = get('<?=site_url('withdraws/resend_validation_key')?>',{id:1}); 
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
	function amount_c()
	{
		var amounts = parseFloat($("#amount").val());
		var totalg = amounts + parseFloat(additionalfee);
		$(".message_texts").addClass("xhide");
		if(amounts>0)
		{
			$(".message_deduce").text(totalg);
			$(".message_texts").removeClass("xhide");
		}
	}
  </script>
       