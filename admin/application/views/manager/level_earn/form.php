<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    
                                    <div class="form-group">
                                        <label>Level</label>
                                        <input type="text" class="form-control required" name="level" id="level" placeholder="level" value="<?=isset($data['level'])?$data['level']:''?>" />
                                    </div>
                                     
                                    <div class="form-group">
                                        <label>Under Umbrealla  </label>
                                        <input type="text" class="form-control  " name="under_umbrealla" id="under_umbrealla" placeholder="under umbrealla" value="<?=isset($data['under_umbrealla'])?$data['under_umbrealla']:'1'?>" />
                                         <b><i>Insert -1 for direct and entry Level Total From</i></b>
                                    </div>
                                    <div class="form-group">
                                        <label>Min invest <?=settings('coin_name')?>  </label>
                                        <input type="text" class="form-control required" name="min_invest" id="refferal_reward" placeholder="refferal reward" value="<?=isset($data['min_invest'])?$data['min_invest']:'1'?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Referral Rewards(%)  </label>
                                        <input type="text" class="form-control required" name="refferal_reward" id="refferal_reward" placeholder="refferal reward" value="<?=isset($data['refferal_reward'])?$data['refferal_reward']:'1'?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Static Reward(%)  </label>
                                        <input type="text" class="form-control" name="static_reward" id="static_reward" placeholder="static reward" value="<?=isset($data['static_reward'])?$data['static_reward']:'0'?>" />
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Level Total From  </label>
                                        <input type="text" class="form-control " name="level_from" id="level_from" placeholder="Level Total From" value="<?=isset($data['level_from'])?$data['level_from']:''?>" />
                                       
                                        <b><i>Please empty or zero if you dont use level from before</i></b>
                                    </div>
                                     <div class="form-group">
                                        <label>Level Name From  </label>
                                        <input type="text" class="form-control " name="level_from_name" id="level_from_name" placeholder="Level Name From" value="<?=isset($data['level_from_name'])?$data['level_from_name']:'0'?>" />
                                        <b><i>Please empty or zero if you dont use level from before</i></b>
                                    </div>
                                     
                                    
                                
                                
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <button type="button" class="btn btn-reset"><i class="fa fa-refresh"></i> Refresh</button>
                                    <a href="<?=site_url("level-earn")?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a> 
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
			var req = postFile('<?=site_url("level-earn/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .card-body');
					document.location.href="<?=site_url('level-earn')?>";
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