<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Setting
            </div>
            <div class="card-body">
                
                                     
                                <div class="form-group">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control required" id="website_title" name="website_title" placeholder="Site Name" value="<?=isset($data['website_title'])?$data['website_title']:''?>" />
                                </div> 
                                
                               <!-- isi form -->
                                <div class="form-group">
                                    <label>Logo</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" value=" <?=isset($data['logo'])?$data['logo']:''?>" readonly name="avatar_s" id="avatar_s">
                                      <input type="file"  class="hide" style="display:none" name="avatar" id="avatar">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                        <button class="btn btn-default" type="button" id="btn-clear" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
                                      </span>
                                    </div>
                                </div>
                                <?php
                                if(isset($data['logo']) && !empty($data['logo']))
                                {
                                ?>
                                <div id="avatar_container">
                                    <small>
                                    <?=isset($data['logo'])?$data['logo']:''?> <a href="javascript:void(0);" data-ref="<?=$data['id']?>" id="delete-avatar" data-toggle="tooltip" title="" data-original-title="Delete logo"><i class="fa fa-close"></i></a>
                                    </small>
                                </div>
                                <?php
                                }
                                ?>
                                 <div class="form-group">
                                    <label>Favicon</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" value=" <?=isset($data['favicon'])?$data['favicon']:''?>" readonly name="favicon_s" id="favicon_s">
                                      <input type="file"  class="hide" style="display:none" name="favicon" id="favicon">
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="btn-favicon" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                        <button class="btn btn-default" type="button" id="btn-clear-favicon" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
                                      </span>
                                    </div>
                                </div>
                                <?php
                                if(isset($data['favicon']) && !empty($data['favicon']))
                                {
                                ?>
                                <div id="avatar_container">
                                    <small>
                                    <?=isset($data['favicon'])?$data['favicon']:''?> <a href="javascript:void(0);" data-ref="<?=$data['id']?>" id="delete-favicon" data-toggle="tooltip" title="" data-original-title="Delete logo"><i class="fa fa-close"></i></a>
                                    </small>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                        <label>Process Payment</label>
                                        <select id="pg_type" name="pg_type" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<option value="0"  <?php if(isset($data['pg_type'])){ if($data['pg_type']==0){ ?> selected="selected"  <?php } }?>> Manual</option> 
											<option value="1"  <?php if(isset($data['pg_type'])){ if($data['pg_type']==1){ ?> selected="selected"  <?php } }?> > Auto</option> 
                                        </select>
                                    </div> 
                                <div class="form-group">
                                    <label>Coin Name</label>
                                    <input type="text" class="form-control required" id="coin_name" name="coin_name" placeholder="Coin Name" value="<?=isset($data['coin_name'])?$data['coin_name']:''?>" />
                                </div>
                                 
                               
                                <div class="form-group">
                                     <label>Email Admin Notif Withdraw</label>
                                    <input type="email" class="form-control required" id="email_notif" name="email_notif" placeholder="Email Admin Notif Withdraw" value="<?=isset($data['email_notif'])?$data['email_notif']:''?>" />
                                </div>
                                 <div class="form-group">
                                     <label>Email Admin Notif Topup</label>
                                    <input type="email" class="form-control required" id="email_topup" name="email_topup" placeholder="Email Admin Notif Topup" value="<?=isset($data['email_topup'])?$data['email_topup']:''?>" />
                                </div>
                                 
                                 
                                
                                <div class="form-group">
                                     <label>Min Withdraw</label>
                                    <input type="text" class="form-control required" id="min_wd" name="min_wd" placeholder="Min Withdraw" value="<?=isset($data['min_wd'])?$data['min_wd']:''?>" />
                                </div>
                                
                                 <div class="form-group">
                                     <label>Min Buy in <?=settings('coin_name')?></label>
                                    <input type="text" class="form-control required" id="min_buy" name="min_buy" placeholder="Min Buy" value="<?=isset($data['min_buy'])?$data['min_buy']:''?>" />
                                </div>
                                <div class="form-group">
                                     <label>Reward User in % </label>
                                    <input type="text" class="form-control required" id="reward_percen" name="reward_percen" placeholder="Reward User" value="<?=isset($data['reward_percen'])?$data['reward_percen']:'0'?>" />
                                </div>
                                <div class="form-group">
                                     <label>Admin Fee </label>
                                    <input type="text" class="form-control required" id="admin_fee" name="admin_fee" placeholder="Admin Fee" value="<?=isset($data['admin_fee'])?$data['admin_fee']:'0'?>" />
                                </div>
                                <hr/>
                                 <div class="form-group">
                                     <label>Refferal Reward</label>
                                    <input type="text" class="form-control required" id="refferal_reward" name="refferal_reward" placeholder="Refferal Reward" value="<?=isset($data['refferal_reward'])?$data['refferal_reward']:'3000'?>" />
                                 </div>
                                    <div class="form-group">
                                     <label>Min Finish Task To Get Refferal Reward</label>
                                    <input type="text" class="form-control required" id="refferal_task" name="refferal_task" placeholder="Refferal Task" value="<?=isset($data['refferal_task'])?$data['refferal_task']:'3'?>" />
                                </div>
                                <hr/>
                                 <div class="form-group">
                                     <label>Min Transfer</label>
                                    <input type="text" class="form-control required" id="min_transfer" name="min_transfer" placeholder="Min Transfer" value="<?=isset($data['min_transfer'])?$data['min_transfer']:''?>" />
                                </div>
                                <div class="form-group">
                                     <label>Admin Fee <b>Transfer</b></label>
                                    <input type="text" class="form-control required" id="admin_fee_tf" name="admin_fee_tf" placeholder="Admin Fee Transfer" value="<?=isset($data['admin_fee_tf'])?$data['admin_fee_tf']:'0'?>" />
                                </div> 
                                <hr/>
                                <div class="form-group">
                                        <label>Withdraw Page</label>
                                        <select id="withdraw_page" name="withdraw_page" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<option value="0"  <?php if(isset($data['withdraw_page'])){ if($data['withdraw_page']==0){ ?> selected="selected"  <?php } }?>> Disabled</option> 
											<option value="1"  <?php if(isset($data['withdraw_page'])){ if($data['withdraw_page']==1){ ?> selected="selected"  <?php } }?> > Enabled</option> 
                                        </select>
                                    </div> 
                                <div class="form-group">
                                     <label>Auto Close Withdraw Page When Balance on PG</label>
                                    <input type="text" class="form-control required" id="balance_close" name="balance_close" placeholder="Auto Close Withdraw Page When Balance on Ewallet" value="<?=isset($data['balance_close'])?$data['balance_close']:'100000'?>" />
                                </div>    
                                <div class="form-group">
                                     <label>Withdraw Additional Fee</label>
                                    <input type="text" class="form-control required" id="wd_additionalfee" name="wd_additionalfee" min="2500" placeholder="Min Withdraw" value="<?=isset($data['wd_additionalfee'])?$data['wd_additionalfee']:'2500'?>" />
                                </div>
                                 <div class="form-group">
                                     <label>Vote Reward</label>
                                    <input type="text" class="form-control required" id="vote_reward" name="vote_reward" min="500" placeholder="Vote Reward" value="<?=isset($data['vote_reward'])?$data['vote_reward']:'1000'?>" />
                                </div>
                                <div class="form-group">
                                     <label>Number of task to get Vote</label>
                                    <input type="text" class="form-control required" id="vote_task" name="vote_task" min="1" placeholder="Number of task to get Vote" value="<?=isset($data['vote_task'])?$data['vote_task']:'4'?>" />
                                </div>
                                
                                <hr/>
                                
                                <div class="form-group">
                                        <label>Contact support</label>
                                        <textarea name="contact_support" id="contact_support"  class="form-control"><?=isset($data['contact_support'])?$data['contact_support']:""?></textarea>
                                 </div>
                                <div class="form-group">
                                        <label>About Us</label>
                                        <textarea name="about_us" id="about_us"  class="form-control"><?=isset($data['about_us'])?$data['about_us']:""?></textarea>
                                 </div> 
                                 <div class="form-group">
                                        <label>Term of Services</label>
                                        <textarea name="terms" id="terms"  class="form-control"><?=isset($data['terms'])?$data['terms']:""?></textarea>
                                 </div>
                                  
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <button type="button" class="btn btn-secondary btn-reset"><i class="fa fa-refresh"></i> Refresh</button>
                                </div>       	
                 </div>
             
            </div>
         </div>
      </div>
                      
                         		   
                         
         
</div>
</form>                        
<script>
$(document).ready(function(){
	CKEDITOR.replace("contact_support",ck_conf); 
	CKEDITOR.replace("about_us",ck_conf); 
	CKEDITOR.replace("terms",ck_conf); 
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
		submitHandler:function(){
			update_ckeditor();
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url("setting/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('setting')?>";
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
						var req = post('<?=site_url('setting/delete-avatar')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
	$("#btn-favicon").click(function(){
		$("#favicon").trigger('click');
	});
	$("#favicon").change(function(){
		$("#favicon_s").val($(this).val());
	});
	$("#delete-favicon").click(function(){
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
						var req = post('<?=site_url('setting/delete-favicon')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
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
});
</script>          