<div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2">Verification Phone Number</h3>
                </div>
                <div class="align-self-center ms-auto">
                </div>
            </div>
        </div>
	<div class="card card-style">
            <div class="content" id="xphn">
                 <!-- -->
                  <form id="form-wa" method="post" action="javascript:void(0);">
                  		 <div class="form-group" >
                         	
                         	<label> Phone Number </label>
                            <div class="input-group">
                                      <span class="input-group-btn btn btn-secondary" >
                                        +62
                                      </span>
                                      <input type="text" class="form-control required" value="<?=user_balance('telp')?>" name="phones" id="phones" style="font-size:16px !important;">
                                      <span class="input-group-btn">
                                        <button class="btn btn-success" type="button" id="btn-send" data-toggle="tooltip" title="" data-original-title="Get Code"><i class="fa fa-send"></i> Verifiy</button>
                                         
                                      </span>
                                      
                            </div>
                         </div>
                          
                  </form>
                  <?php
				  /*
                  <form id="form-wa" method="post" action="javascript:void(0);">
                  		 <div class="form-group">
                                <label>Verification Code</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control required" value="" name="wa_code" id="wa_code">
                                      
                                      <span class="input-group-btn">
                                        <button class="btn btn-success" type="button" id="btn-send" data-toggle="tooltip" title="" data-original-title="Get Code"><i class="fa fa-send"></i> Get Code</button>
                                         
                                      </span>
                                	</div>
                           </div>
                            <button type="submit" class="btn btn-full gradient-highlight shadow-bg shadow-bg-s mt-4 btn-primary" style="width:100%;"> Process</button>
                  </form>
				  */
				  ?>
                 <!-- --> 
            </div>
        </div>
 
            <div class="d-flex justify-content-center align-items-center container xhide tverify" style="max-width:500px;">
                    <div class="card py-5 px-3">
                        <h5 class="m-0">Verification</h5><span class="mobile-text">Enter the code we just send on your mobile phone <b class="text-danger numbertext"></b></span>
                        <div class="d-flex flex-row mt-5">
                        		<input type="text" id="pincode-input1">
                        </div>
                        <div class="text-center mt-5"><span class="d-block mobile-text">Don't receive the code?</span>
                        <hr/>
                        
                        
                        <p class="wait_resend"> Waiting resend Code in <b><span class="counter"></span></b> </p>
                        <a href="javascript:void(0);" class="font-weight-bold text-danger   text-right resends xhide" onclick="javascript:resends();">Resend</a> 
                        <br/>
                        <a href="javascript:void(0);" class="font-weight-bold text-primary   text-left" onclick="javascript:tchange();">Change Number</a> 
                        </div>
                    </div>
                </div>       
              
             </div>      
            <!-- -->
  </div>
       
 <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-pincode-input/css/bootstrap-pincode-input.css">
 <script src="assets/plugins/bootstrap-pincode-input/js/bootstrap-pincode-input.js"></script>
 <script>
 $(function()
 {
	$("#form-wa").validate({
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
			var data = new FormData($("#form-wa")[0]);
			var req = postFile('<?=site_url("otp/signed")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('home')?>";
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
	$("#btn-send").click(function()
	{
			var req = post('<?=site_url("otp/newauth")?>',{id:1,'phones':$("#phones").val()});
			req.done(function(out){
				if(!out.error)
				{
					 //smart_message(out.message);
					 activeverify();
				}
				else
				{
					//smart_error_box(out.message,'#frm-object .block-content');
					smart_message(out.message);
				}
			});
			return false;
			 
			 
	});
	 $('#pincode-input1').pincodeInput({hidedigits: false, inputs: 4, inputclass: 'form-control',placeholders:"0 0 0 1",complete:function(value, e, errorElement){
               // check the code
                var req = post('<?=site_url('otp/newsign')?>',{wa_code:value,'phones':$("#phones").val()});
			   req.done(function(out){
				   if(out.error)
				   {
						//errorElement
	                  smart_message(out.message); 
				   }
				   else
				   {
					   document.location.href="<?=site_url('home')?>";
				   }
			   });
               
            }});
	 
});
function tchange()
{
	$("#xphn").removeClass("xhide");
	$(".tverify").addClass("xhide");
		
}
function activeverify()
{
	$("#xphn").addClass("xhide");
	$(".tverify").removeClass("xhide");
	$(".numbertext").text("+62"+ $("#phones").val());
	var count = 60, timer = setInterval(function() {
	$(".counter").html(count--);
		if(count == 1){
			 clearInterval(timer);
			 $(".wait_resend").addClass("xhide");
			 $(".resends").removeClass("xhide");
		}
	}, 1000);

		
}
function resends()
{
		
	var req = post('<?=site_url("otp/resends")?>',{id:1,'phones':$("#phones").val()});
			req.done(function(out){
				if(!out.error)
				{
					 //smart_message(out.message);
					activeverify();
					$(".wait_resend").removeClass("xhide");
    				$(".resends").addClass("xhide"); 
				}
				else
				{
					//smart_error_box(out.message,'#frm-object .block-content');
					smart_message(out.message);
				}
			});
			return false;
	
		
}

</script>
<style>
	  	  
	   </style>