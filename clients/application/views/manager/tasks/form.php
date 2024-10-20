			<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Task</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?=site_url("home")?>"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Create</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							 
						</div>
					</div>
				</div>
                
                <!-- -->
                <div class="row">
					<form action="javascript:void(0);" method="post" id="frm-object">
                    <div class="col-xl-9 mx-auto">
						
                        <h6 class="mb-0 text-uppercase">Choose Task</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									  
                                      <div class="form-group">
                                        <label>Type Task</label>
                                        <select id="id_task_type" name="id_task_type" class="form-control " >
                                        	<option value=""  > -- choose --</option>
											<?php
												 for($i=0;$i<count($task_type);$i++)
												{
													$selected = "";
													if(isset($data['task_type']))
													{
														if($data['task_type']==$task_type[$i]['id'])
														{
															$selected = "selected='selected'";
														}
													}
											?>
                                            		<option value="<?=$task_type[$i]['id']?>" <?=$selected?> ><?=$task_type[$i]['name']?></option>
                                            <?php
												} 
											?>
                                        </select>
                                         
                                    </div> 
                                      
								</div>
							</div>
						</div>
                        
                        <!-- -->
                        <div class="step2 xhide">
                         	
                            <h6 class="mb-0 text-uppercase">Item Purchase</h6>
                            <hr/>
                            <div class="card">
                                <div class="card-body">
                                    <div class="p-4 border rounded">
                                          
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Item</label>  
                                                    <select id="id_task_payment" name="id_task_payment" class="form-control " >
                                                        <option value=""  > -- choose --</option>
                                                         
                                                    </select>   
                                                     
                                                </div> 
                                           </div>
                                           
                                           <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prices</label>   
                                                   <input type="text" class="form-control" name="prices"   id="prices" placeholder="Prices" value="0" readonly="readonly"/>
                                                     
                                                </div> 
                                           </div>
                                                
                                       </div>      
                                          
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="step3 xhide">
                         	
                            <h6 class="mb-0 text-uppercase">Information</h6>
                            <hr/>
                            <div class="card">
                                <div class="card-body">
                                    <div class="p-4 border rounded">
                                          
                                         <!-- -->
                                         <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control required" name="name" id="name" value="<?=isset($data['name'])?$data['name']:''?>" placeholder='Title of your task example: "Download Apps ZENDZ di Google Play"' />
                                    </div>
                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="text" class="form-control required" name="links" id="links" value="<?=isset($data['links'])?$data['links']:''?>" placeholder='Copy your Apps Link example "https://play.google.com/store/apps/details?id=com.zendz"' />
                                    </div>
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="text" class="form-control required" name="start_date" id="start_date" placeholder="From Date" value="<?=isset($data['start_date'])?$data['start_date']:''?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>To Date</label>
                                        <input type="text" class="form-control required" name="end_date" id="end_date" placeholder="To Date" value="<?=isset($data['end_date'])?$data['end_date']:''?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description"  class="form-control"><?=isset($data['description'])?$data['description']:""?></textarea>
                                	 </div>
                                     <div class="form-group">
                                        <label>Image</label>
                                            <div class="input-group">
                                              <input type="text" class="form-control required" value=" <?=isset($data['icon'])?$data['icon']:''?>" readonly name="avatar_s" id="avatar_s">
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
                                         <!-- -->    
                                          
                                    </div>
                                </div>
                            </div>
                            
                        
                         	
                             
                            <hr/>
                            <div class="card">
                                <div class="card-body">
                                    <div class="p-4 border rounded">
                                           <div class="form-group">
                                    
                                                <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                                <!-- 
                                                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                                -->
                                                <button type="submit" class="btn btn-primary" style="width:100%;"><i class="si si-paper-plane "></i> Process To Payment</button>
                                                
                                            </div> 
                                    </div>
                                </div>         
                            </div>
                            
                        </div>
                
               </div>
              </form>          
             </div>           
                
                <!-- -->
<script>
var data_task_payment = [];
$(document).ready(function(){
	CKEDITOR.replace("description",ck_conf); 	
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
			var req = postFile('<?=site_url("tasks/savefirst")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('tasks/step-payment')?>";
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
	$("#id_task_payment").change(function()
	{
		var ids = $(this).val();
		$.each(data_task_payment,function(key,val){
			 if(val.id==ids)
			 {
				$("#prices").val(val.rprices);	 
			 }
		 }); 
		 $(".step3").removeClass("xhide");
	});
	/// 
	$('#start_date').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
	$('#end_date').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });	
});


function gettask_payment(ids)
{
	var req = post('<?=site_url('tasks/gettask_payment')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
	req.done(function(out){
		if(!out.error)
		{
			data_task_payment = out.data;
			var uys = '';
			$("#id_task_payment").html("");
			$("#id_task_payment").html('<option value=""  > -- choose --</option>'); 
			$.each(out.data,function(key,val){
				 
				$("#id_task_payment").append("<option value='"+val.id+"'>"+val.jumlah+"</option>");
		    });
			
			$("#id_task_payment").trigger('change.select2');
			$("#id_task_payment").val(uys).trigger('change');
			$(".step3").addClass("xhide");
			$(".step2").removeClass("xhide");
		}
		else
		{
			smart_error_box(out.message,'#frm-object .card-body');
		}
	});		
}
</script>                
<style type="text/css">
.select2-container
{
	width:100% !important;	
}
</style>