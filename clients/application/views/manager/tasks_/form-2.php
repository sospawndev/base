<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Choose Purchase Item - <b>Step 2</b>
                   <span class="pull-right">
                    <b>Next Step 3 - Insert Information </b>         
                   </span>  
            </div>
            <div class="card-body">
                		<div class="row">
                              <div class="col-md-5">      
                                    
                                    <b><u>Task Choosed</u></b> 
                                    <div class="form-group">
                                        <label>Type Task</label>
                                        <br/> 
                                        <strong class=""><?=$task_type['name']?></strong> 
                                    </div> 
                                    
                                    
                             </div>
                              <div class="col-md-7">             
                                   
                                    <b><u>Choose Purchase Item</u></b> 
                                   
                                    	 
                                  	 <?php
												 for($i=0;$i<count($task_payment);$i++)
												{
													$selected = "";
													 
											?>
                                            <div class="form-group">
                                            		<input type="radio"   name="id_task_payment" id="id_task_payment<?=$task_payment[$i]['id']?>" autocomplete="off" value="<?=$task_payment[$i]['id']?>" checked>
                                                    <label class="btn btn-outline-primary" for="id_task_payment<?=$task_payment[$i]['id']?>"> Rp. <?=number_format($task_payment[$i]['prices'],0)?> - Count(<b><?=$task_payment[$i]['jumlah']?></b>)
                                                    </label>
                                              </div>           
                                            <?php
												} 
											?>
                                    
                                  
                          </div>   
                          <hr/>       
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id_task_type" value="<?=$task_type['id']?>" id="id_task_type" />
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-arrow-right "></i> Next Step</button>
                                    <a href="<?=site_url("tasks/add")?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-arrow-left"></i> Previous Step</a>
                                     
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
			var req = postFile('<?=site_url("tasks/savetwo")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('tasks/step3')?>";
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
	$("#id_task_type").select2();
	$("#id_task_payment").select2();
	//getcoins();
	$("#id_task_type").change(function()
	{
		var ids = $(this).val();
		gettask_payment(ids);
	});
});
function gettask_payment(ids)
{
	var req = post('<?=site_url('tasks/gettask_payment')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
	req.done(function(out){
		if(!out.error)
		{
			var uys = '';
			$("#id_task_payment").html("");
			$("#id_task_payment").html('<option value=""  > -- choose --</option>'); 
			$.each(out.data,function(key,val){
				 
				$("#id_task_payment").append("<option value='"+val.id+"'>"+val.lists+"</option>");
		    });
			$("#id_task_payment").trigger('change.select2');
			$("#id_task_payment").val(uys).trigger('change');
		}
		else
		{
			smart_error_box(out.message,'#frm-object .card-body');
		}
	});		
}
</script>          