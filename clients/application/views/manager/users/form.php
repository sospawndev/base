
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Info
            </div>
            <div class="card-body">
                
                     <!-- -->
                           <form action="javascript:void(0);" method="post" id="frm-profile">
                                  
                                  
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Username" value="<?=isset($data['company_name'])?$data['company_name']:''?>" />
                                    </div>
                                     
                                
                                
                                
                                 
                                  
                                <!-- end form awal -->
                               <div class="form-group">
                                <label>Image</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" value=" <?=isset($data['avatar'])?$data['avatar']:''?>" readonly name="avatar_s" id="avatar_s">
                                      <input type="file"  class="hide" style="display:none" name="avatar" id="avatar">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                         
                                      </span>
                                	</div>
                            	</div>
								<?php
                                if(isset($data['avatar']) && !empty($data['avatar']))
                                {
                                ?>
                                <div id="avatar_container">
                                    <small>
                                    <?=isset($data['avatar'])?$data['avatar']:''?> <a href="javascript:void(0);" data-ref="<?=$data['id']?>" id="delete-avatar" data-toggle="tooltip" title="" data-original-title="Delete avatar"><i class="fa fa-close"></i></a>
                                    </small>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label>PIC Name </label>
                                    <div class="input-group">
                                      
                                           <input type="text" class="form-control"  id="company_pic" name="company_pic" placeholder="company_pic" value="<?=isset($data['company_pic'])?$data['company_pic']:''?>" /> 
                                    </div>       
                                    
                                </div>
                                <div class="form-group">
                                    <label>Phone Number </label>
                                    <div class="input-group">
                                      
                                           <input type="text" class="form-control"  id="telp" name="telp" placeholder="Phone" value="<?=isset($data['telp'])?$data['telp']:''?>" /> 
                                    </div>       
                                    
                                </div>
                                <div class="form-group">
                                    <label>What kind of your business? </label>
                                    <div class="input-group">
                                            
                                        <select name="company_type_bis" id="company_type_bis" class="form-control  required   ">
                                            <option value=""></option>
                                            <?php
												 
                                                for($i=0;$i<count($bisnis_type);$i++)
                                                {
													$selected = "";
													if($data['company_type_bis']==$bisnis_type[$i]['name'])
													{
														$selected = "selected='selected'";
													}
                                            ?>
                                                    
                                                    <option value="<?=$bisnis_type[$i]['name']?>" <?=$selected?>><?=$bisnis_type[$i]['name']?></option>
                                            <?php
                                                }
                                            ?>
                                           </select>
                                    </div>       
                                    
                                </div>
                                
                                
                                <div class="form-group">
                                    <label>Country </label>
                                    <div class="input-group">
                                      
                                       <select name="country" id="country" class="form-control  required   ">
                                            <option value=""></option>
                                            <?php
												 
                                                for($i=0;$i<count($country);$i++)
                                                {
													$selected = "";
													if($data['country']==$country[$i]['name'])
													{
														$selected = "selected='selected'";
													}
                                            ?>
                                                    
                                                    <option value="<?=$country[$i]['name']?>" <?=$selected?>><?=$country[$i]['name']?></option>
                                            <?php
                                                }
                                            ?>
                                           </select>
                                    </div>       
                                    
                                </div>
                                
                                
                               
                                 
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    
                                    <input type="hidden" name="id" value="<?=user_info('id')?>" id="id" />
                                   
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <a href="<?=site_url("profile")?>" class="btn btn-reset"><i class="fa fa-refresh"></i> Refresh</a>
                                </div>
                            </form>            
                     <!--- -->            	
                 
             
            </div>
          
      </div>
                   
                         		   
                         
    </div> 
       
</div>

                     
<script>
$(document).ready(function(){
	$("#frm-profile").validate({
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
			 
			var data = new FormData($("#frm-profile")[0]);
			var req = postFile('<?=site_url('users/save')?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('profile')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
			return false;
		}
	});
	$("#btn-upload").click(function(){
		$("#avatar").trigger('click');
	});
	$("#avatar").change(function(){
		$("#avatar_s").val($(this).val());
	});
	$("#delete-avatar").click(function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete avatar?",
				message: "Do you want to delete this avatar.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('users/delete-avatar')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								smart_success_box(out.message,'#frm-object .block-content');
								$("#avatar_container").remove();
							}
							else
							{
								smart_error_box(out.message,'#frm-object .block-content');
							}
						});		
					}
				}
			});
		}
		return false;
	});
	 
	//
			 $('#company_type_bis').select2({
				allowClear: true,
				placeholder: "Select an option"
			}); 
			 $('#country').select2({
				allowClear: true,
				placeholder: "Select an option"
			}); 
			$('#province').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#city').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#district').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#country').change(function()
			{
				var cd = $(this).val();
				$(".prevs").addClass("xhide");
				if(cd == "INDONESIA")
				{
					$(".prevs").removeClass("xhide");					
				}
			});
			
			$('#province').change(function()
			{
				var ids = $(this).val();
				getcity(ids); 
			});
			$('#city').change(function()
			{
				var ids = $(this).val();
				getdistrict(ids); 
			});
			
			// 
			$('#id_bank').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
});
</script>        
 		<style type="text/css">
		html.dark-theme .modal-footer .btn
		{
			color:white;	
		}
		.xhide 
		{
			display:none !important;	
		}
		.select2-container {
			width: 100% !important;
		}
		.select2-container--default .select2-selection--single {
			 
			 
		}
		</style>  