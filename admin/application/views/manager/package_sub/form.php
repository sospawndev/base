<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    
                                    <div class="form-group">
                                        <label><?=$arr['name']?></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=isset($data['name'])?$data['name']:''?>" />
                                    </div>
                                     <div class="form-group">
                                        <label>3 months after the main online</label>
                                        <input type="text" class="form-control" name="three_month" id="three_month" placeholder="" value="<?=isset($data['three_month'])?$data['three_month']:'0'?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>launch 3-6 months after the main online</label>
                                        <input type="text" class="form-control" name="six_month" id="six_month" placeholder="" value="<?=isset($data['six_month'])?$data['six_month']:'0'?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>launch 6-9 months after the main online</label>
                                        <input type="text" class="form-control" name="nine_month" id="nine_month" placeholder="" value="<?=isset($data['nine_month'])?$data['nine_month']:'0'?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>launch 9-12 months after the main online</label>
                                        <input type="text" class="form-control" name="tweleve_month" id="tweleve_month" placeholder="" value="<?=isset($data['tweleve_month'])?$data['tweleve_month']:'0'?>" />
                                    </div>
                                     
                                    
                                    
                                
                                
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <input type="hidden" name="id_package" value="<?=isset($arr['id'])?$arr['id']:''?>" id="id_package" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <button type="button" class="btn btn-reset"><i class="fa fa-refresh"></i> Refresh</button>
                                    <a href="<?=site_url("package-sub/views/".$arr['id'])?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a> 
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
			var req = postFile('<?=site_url("package-sub/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('package-sub/views/'.$arr['id'])?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .card-body');
				}
			});
			return false;
		}
	});
	 
	//getcoins();
});
 
</script>          