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
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=isset($data['name'])?$data['name']:""?>" />
                                       
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
			var req = postFile('<?=site_url("task-type/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('task-type')?>";
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
});
 
</script>          