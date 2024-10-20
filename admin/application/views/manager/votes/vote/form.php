<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="id_vote_category" id="id_vote_category" class="form-control required select2">
                                                <?php
													for($i=0;$i<count($vote_category);$i++)
													{
														$selected = "";
														if(isset($data['id_vote_category']))
														{
															if($vote_category[$i]['id']==$data['id_vote_category'])
															{
																$selected = "selected='selected'";
															}
															
														}
												?>
                                                		<option value="<?=$vote_category[$i]['id']?>" <?=$selected?>><?=$vote_category[$i]['name']?></option>
                                                <?php
													}
												?>
                                                </select>
                                            </div> 
                                       </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control required" name="titles" id="titles" placeholder="title" value="<?=isset($data['titles'])?$data['titles']:""?>"   /> 
                                            </div> 
                                       </div>     
                                   </div>     
                                   	  
                                     <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="start_dates" id="start_date" placeholder="start date" value="<?=isset($data['start_dates'])?$data['start_dates']:''?>" />
                                            </div> 
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="end_dates" id="end_date" placeholder="end date" value="<?=isset($data['end_dates'])?$data['end_dates']:''?>" />
                                            </div> 
                                        </div>
                                        
                                    </div>  
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="input-group">
                                          <input type="text" class="form-control" value=" <?=isset($data['image'])?$data['image']:''?>" readonly name="image_s" id="image_s">
                                          <input type="file"  class="hide" style="display:none" name="image" id="image">
                                          <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload image"><i class="fa fa-upload"></i></button>
                                            <button class="btn btn-default" type="button" id="btn-clear" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
                                          </span>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($data['image']) && !empty($data['image']))
                                    {
                                    ?>
                                    <div id="image_container">
                                        <small>
                                        <?=isset($data['image'])?$data['image']:''?> <a href="javascript:void(0);" data-ref="<?=$data['id']?>" id="delete-image" data-toggle="tooltip" title="" data-original-title="Delete logo"><i class="fa fa-close"></i></a>
                                        </small>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                 	  <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description"  class="form-control"><?=isset($data['description'])?$data['description']:""?></textarea>
                                 </div>	
                                
                                
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
			var req = postFile('<?=site_url("votes/vote/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('votes/vote')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
			return false;
		}
	});
	 
	$("#type").change(function()
	{
		var yo = $(this).val();
		console.log(yo)
		if(yo=="1")
		{
			$(".txttype").html("%");
			$("#jumlah").prop("max","100");	
		}else
		{
			$(".txttype").html("$");
			$("#jumlah").removeAttr("max");	
		}
	});
	$('#start_date').datetimepicker({
		timepicker:true,
		format:'Y-m-d H:i',
		formatDate:'Y-m-d',
		mask:'9999-19-39 29:59'
	});
	$('#end_date').datetimepicker({
		timepicker:true,
		format:'Y-m-d H:i',
		formatDate:'Y-m-d',
		mask:'9999-19-39 29:59'
	});
	$("#btn-upload").click(function(){
		$("#image").trigger('click');
	});
	$("#image").change(function(){
		$("#image_s").val($(this).val());
	});
	$("#delete-image").click(function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete image?",
				message: "Do you want to delete this image.",
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
						var req = post('<?=site_url('votes/vote/delete-image')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								smart_success_box(out.message,'#frm-object .block-content');
								$("#image_container").remove();
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