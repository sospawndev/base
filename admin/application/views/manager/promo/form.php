<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    
                                    <div class="form-group">
                                        <label>Promo Code</label>
                                        <input type="text" class="form-control" name="pid" id="pid" placeholder="Promo Code" value="<?=isset($data['pid'])?$data['pid']:$promo_code?>" readonly="readonly"/>
                                        <small><i>Cannot be edit</i></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" id="type" class="form-control required select2">
                                                    <option value="0" <?=isset($data['type']) && $data['type']==0?'selected="selected"':''?>>Number</option>
                                                    <option value="1" <?=isset($data['type']) && $data['type']==1?'selected="selected"':''?>>Percent</option>
                                                     
                                                </select>
                                            </div> 
                                       </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount Promo <span class="txttype"><?=isset($data['type']) && $data['type']==1? '%':'$'?></span></label>
                                                <input type="number" class="form-control required" name="jumlah" id="jumlah" placeholder="Values Promo" value="<?=isset($data['jumlah'])?$data['jumlah']:0?>"   /> 
                                            </div> 
                                       </div>     
                                   </div>     
                                   <div class="form-group">
                                                <label>Usage amount</label>
                                                <input type="number" class="form-control required" name="total_used" id="total_used" placeholder="Total Used" min="1" value="<?=isset($data['total_used'])?$data['total_used']:0?>"     /> 
                                     </div>  
                                     <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="start_date" id="start_date" placeholder="start date" value="<?=isset($data['start_date'])?$data['start_date']:''?>" />
                                            </div> 
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="end_date" id="end_date" placeholder="end date" value="<?=isset($data['end_date'])?$data['end_date']:''?>" />
                                            </div> 
                                        </div>
                                        
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
			var req = postFile('<?=site_url("promo/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('promo')?>";
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