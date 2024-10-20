<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=isset($data['name'])?$data['name']:''?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Sysmbol</label>
                                        <select id="simbol" name="simbol" class="form-control " >
                                        	<option value=""  > -- choose --</option>
											<?php
												 for($i=0;$i<count($simbol);$i++)
												{
													$selected = "";
													if(isset($data['simbol']))
													{
														if($data['simbol']==$simbol[$i]['id'])
														{
															$selected = "selected='selected'";
														}
													}
											?>
                                            		<option value="<?=$simbol[$i]['id']?>" <?=$selected?> ><?=$simbol[$i]['name']?></option>
                                            <?php
												} 
											?>
                                        </select>
                                        <small style="color:red;">If simbol is empty, currency will be set usd. </small>
                                    </div> 
                                    <div class="form-group">
                                        <label>Network</label>
                                        <input type="text" class="form-control" name="network" id="network" placeholder="Network" value="<?=isset($data['network'])?$data['network']:''?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Received Address</label>
                                        <input type="text" class="form-control" name="received_address" id="received_address" placeholder="Received Address" value="<?=isset($data['received_address'])?$data['received_address']:''?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>Icon</label>
                                            <div class="input-group">
                                              <input type="text" class="form-control" value=" <?=isset($data['icon'])?$data['icon']:''?>" readonly name="avatar_s" id="avatar_s">
                                              <input type="file"  class="hide" style="display:none" name="avatar" id="avatar">
                                              <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                                
                                              </span>
                                            </div>
                                        </div>
                                        <?php
                                        if(isset($data['icon']) && !empty($data['icon']))
                                        {
                                        ?>
                                        <div id="avatar_container">
                                            <small>
                                            <?=isset($data['icon'])?$data['icon']:''?> <a href="javascript:void(0);" data-ref="<?=$data['id']?>" id="delete-avatar" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-close"></i></a>
                                            </small>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                
                                
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
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
		submitHandler:function(){
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url("currency/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('currency')?>";
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
				title: "Delete icon?",
				message: "Do you want to delete this icon.",
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
						var req = post('<?=site_url('currency/delete-icon')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								smart_success_box(out.message,'#frm-object .card-body');
								$("#avatar_container").remove();
							}
							else
							{
								smart_error_box(out.message,'#frm-object .card-body');
							}
						});		
					}
				}
			});
		}
		return false;
	});  
	$("#simbol").select2();
	//getcoins();
});
function getcoins()
{
	var req = get('<?=site_url('api/getcoin')?>',{id:1,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
	req.done(function(out){
		if(!out.error)
		{
			var uys = '';
			$("#simbol").find('option').remove(); 
			$.each(out.data,function(key,val){
				<?php
				if(isset($data['simbol']))
				{
				?>
					if(val.id=='<?=$data['simbol']?>')
					{
						uys = val.id;
					}
				<?php
					 
				}
				?>
				$("#simbol").append("<option value='"+val.id+"'>"+val.name+"</option>");
		    });
			$("#simbol").trigger('change.select2');
			$("#simbol").val(uys).trigger('change');
		}
		else
		{
			smart_error_box(out.message,'#frm-object .card-body');
		}
	});		
}
</script>          