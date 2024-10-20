<style type="text/css">
.pay-option-label.xaddress
{
	background-color:#ccc;
}
#qrcode img
{
	text-align:center;
	padding-left: 25%;	
}
.tflex {
  display: flex;
  padding: 5px;
}
.bank-group
{
	cursor:pointer;	
}
@media only screen and (max-width: 600px) {
    #qrcode img
	{
		text-align:center;
		padding-left: 5%;	
	}
}
</style>
			<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Task</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?=site_url("home")?>"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?=site_url("tasks/add")?>">Create</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                <li class="breadcrumb-item active" aria-current="page">Manual Process</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							 
						</div>
					</div>
				</div>
                
                <!-- -->
               <form action="javascript:void(0);" method="post" id="frm-object"> 
                <div class="row">
					
                    <div class="col-xl-7 mx-auto">
						
                        <h6 class="mb-0 text-uppercase">Process</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									  
                                   <!-- -->
                                   <table class="table align-middle table-striped">
                                   	<tbody>
                                    	  
                                                
                                          <tr>
                                            <td class="text-center">
                                            	<h5>Please Pay To This Address For Process</h5>
                                                <hr/>
                                                Payment Address
                                                <div id="qrcode" style=""></div>
                                                <hr/>
                                                <p>
                                                	Bank : <?=$data['name']?>
                                                 	<br/>
                                                	No Rekening : <?=$data['no_rekening']?>
                                                    <br/>
                                                	Atas Nama : <?=$data['atas_nama']?>
                                                </p>
                                             </td>
                                           </tr>
                                           <tr>
                                             <td class="text-left">   
                                                <!-- -->
                                                <hr/>
                                                <h5>Task Request</h5>
                                                <ol class="text-left">
                                                	<li>
                                                    	Item Name : <strong><?=$carr['name']?></strong>
                                                    </li>
                                                    <li>
                                                    	Links : <a href="<?=$carr['links']?>" target="_blank"><?=$carr['links']?></a>
                                                    </li>
                                                    <li>
                                                    	Price : <strong>x<?=number_format($task_payment['jumlah'])?> (Rp. <?=number_format($task_payment['prices'])?>)</strong>
                                                    </li>
                                                    <li>
                                                    	Description : <br/>
                                                        <?=$carr['description']?>
                                                    </li>
                                                     <li>
                                                    	Total Payment : <strong>Rp. <?=number_format(($task_payment['prices']+setting("admin_fee")))?></strong>
                                                    </li>
                                                </ol>
                                                <!-- -->
                                            </td>
                                         </tr>
                                    </tbody>
                                   </table>
                                   <!-- -->   
                                      
								</div>
							</div>
						</div>
                       </div> 
                         <!-- -->
                            <div class="col-xl-5 mx-auto">
                                    
                                    <h6 class="mb-0 text-uppercase">Sender Information</h6>
                                    <hr/>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="p-4 border rounded">
                                                  <!-- -->
                                                   <div class="form-group">
                                                        <label>Bank Transfer Name</label>
                                                        <div class="form-group">
                                                            <select name="id_bank" id="id_bank" class="form-control required">
                                                                <?php
                                                                for($i=0;$i<count($list_bank);$i++)
                                                                {
                                                                ?>
                                                                <option value="<?=$list_bank[$i]['id']?>"><?=$list_bank[$i]['name']?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                         
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <input type="text" class="form-control required" id="no_rekening" name="no_rekening" placeholder="Account Number" value="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Beneficary Name</label>
                                                        <input type="text" class="form-control required" id="atas_nama" name="atas_nama" placeholder="Beneficary Name" value="" />
                                                    </div>
                                                   <div class="form-group">
                                                        <label>Attachment of Transfer</label>
                                                        <div class="input-group">
                                                          <input type="text" class="form-control" value=" " readonly name="avatar_s" id="avatar_s">
                                                          <input type="file"  class="hide" style="display:none" name="img_screen" id="avatar">
                                                          <span class="input-group-btn">
                                                            <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                                            <button class="btn btn-default" type="button" id="btn-clear" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
                                                          </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <hr/>
                                                     <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Process</button>
                                                  <!-- -->
                                                
                                                  
                                            </div>
                                        </div>
                                    </div>
                                    
                                      
                           </div>
                           <!-- -->
                          
               </div>
              
                     
             </div>  
             </form>            
                
                <!-- -->
<script>
var data_task_payment = [];
$(document).ready(function(){
	new QRCode(document.getElementById("qrcode"), "<?=$data['no_rekening']?>");	
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
			var req = postFile('<?=site_url("tasks/save_manual")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					bootbox.alert({
                                message: 'Thank You! For Your Payment',
                                callback: function () {
                                			smart_success_box(out.message,'#frm-object .card-body');
											document.location.href="<?=site_url('tasks')?>";
                               		 }
                                });
					
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
	$("#id_bank").select2();
	
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