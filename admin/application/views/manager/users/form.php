<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Admin
            </div>
            <div class="card-body">
                
                                     
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?=isset($data['username'])?$data['username']:''?>" />
                                    </div>
                                    <?php
                                    if(!isset($mode) || $mode!='edit')
                                    {
                                    ?>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control required" name="password" id="password" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <label>Retype your password</label>
                                        <input type="password" class="form-control required" id="cpassword" equalto="#password" placeholder="Re-type your password" />
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <hr />
                                
                                <div class="form-group">
                                    <label>Nick Name</label>
                                    <input type="text" class="form-control required" id="name" name="name" placeholder="Nick Name" value="<?=isset($data['name'])?$data['name']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" email="true" class="form-control required" id="email" name="email" placeholder="Email" value="<?=isset($data['email'])?$data['email']:''?>" />
                                </div>
                                 <div class="form-group">
                                        <label>Wallet Address</label>
                                        <input type="text" class="form-control" name="wallet_address" id="wallet_address" placeholder="wallet address" value="<?=isset($data['wallet_address'])?$data['wallet_address']:''?>" />
                                    </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <select name="active" id="active" class="form-control required select2">
                                        <option value="0" <?=isset($data['active']) && $data['active']==0?'selected="selected"':''?>>Non Active</option>
                                        <option value="1" <?=isset($data['active']) && $data['active']==1?'selected="selected"':''?>>Active</option>
                                        <option value="2" <?=isset($data['active']) && $data['active']==2?'selected="selected"':''?>>Suspend</option>
                                    </select>
                                </div>
                                  
                                <!-- end form awal -->
                               <div class="form-group">
                                <label>Avatar</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" value=" <?=isset($data['avatar'])?$data['avatar']:''?>" readonly name="avatar_s" id="avatar_s">
                                      <input type="file"  class="hide" style="display:none" name="avatar" id="avatar">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                        <button class="btn btn-default" type="button" id="btn-clear" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
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
                                    <label>Telp </label>
                                    <div class="input-group">
                                      
                                           <input type="text" class="form-control" number="true" id="telp" name="telp" placeholder="Telp" value="<?=isset($data['telp'])?$data['telp']:''?>" /> 
                                    </div>       
                                    
                                </div>
                                 
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address" placeholder="Address"><?=isset($data['address'])?$data['address']:''?></textarea>
                                </div>
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="level" class="required" value="<?=$level_users?>" />
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
		messages:{
			username : {
				remote : "user already exist"
			},
			email : {
				remote : "email already exist"
			}
		},
		rules:{
			avatar_s:{
				extension:"jpg|png"
			},
			username:{
				remote:{
					url:"<?=site_url('users/check-username-exist')?>",
					data:{
						username:function(){
							return $("#username").val();
						},
						id:function(){
							return $("#id").val();
						}
					},
					dataFilter:function(out)
					{
						var json = JSON.parse(out);
						if(json.error==true)
						{
							return false;
						}
						return true	;
					}
				}
			},
			email:{
				remote:{
					url:"<?=site_url('users/check-email-exist')?>",
					data:{
						username:function(){
							return $("#email").val();
						},
						id:function(){
							return $("#id").val();
						}
					},
					dataFilter:function(out)
					{
						var json = JSON.parse(out);
						if(json.error==true)
						{
							return false;
						}
						return true	;
					}
				}
			}
		},
		submitHandler:function(){
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=$url_submit?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('users')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
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
	$("#active").change(function(){
		$("#reasons-container").addClass('hide');
		$("#reasons").val('');
		if($(this).val()==2)
		{
			$("#reasons-container").removeClass('hide');
			<?php
			if(isset($data['reasons']))
			{
			?>
			$("#reasons").val('<?=stripslashes($data['reasons'])?>');
			<?php
			}
			?>
		}
	});
	$("#active").trigger('change');
	
});
</script>          