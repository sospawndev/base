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
            <div class="content">
                 <!-- -->
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
                 <!-- --> 
            </div>
        </div>
 
 
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
			var req = post('<?=site_url("otp/auth")?>',{id:1});
			req.done(function(out){
				if(!out.error)
				{
					 smart_message(out.message);
				}
				else
				{
					//smart_error_box(out.message,'#frm-object .block-content');
					smart_message(out.message);
				}
			});
			return false;
	});
});
</script>