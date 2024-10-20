<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
$task_type = $data['task_type'];
$task_payment_arr = $data['task_payment_arr'];
?>
	<div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Task Detail')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                </div>
            </div>
        </div>
	<div class="card card-style">
            <div class="content">
                 <!-- -->
                		 <div class="col-md-12">
                                    <!--  -->
                                     <div class="card card-style">
                                        <div class="content padding-0 margin-0" >
                                                <div class="row padding-0 margin-0">
                                                    <div class="col-md-12 padding-0 margin-0" >
                                                        <div class="card  card-style  padding-0 margin-0" style="min-height:150px;">
                                                              
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark"><?=$task_type['name']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- <?=$data['task_complete']?>/<?=$task_payment_arr['jumlah']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-10"> <b><?=date('d-m-Y',strtotime($data['start_date']))?></b></p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                               <h1 class="text-left">
                                                                    <?=$data['name']?>
                                                               </h1>
                                                               <hr/>
                                                               <div>
                                                               		 <b>Your Reward <?=number_format($data['rewards'],0)?> has been sent </b>
                                                                     <br/>
                                                                     Info:
                                                                     <a href="<?=$data['network_url']?>tx/<?=$data['txhash']?>" target="_blank"><?=$data['txhash']?></a>
                                                               </div>
                                                               <hr/>
                                                                <a href="<?=site_url('tasks')?>" class="btn btn-info btn-sm btn-xs btn-lg btn-full">Back to Task</a>
                                                             </div>
                                                        </div>
                                                    </div>     
                                                </div>
                                        </div>
                                     </div>   
                                  <!-- -->
                                  </div>
                 <!-- -->
            </div>
        </div>
  
 <!-- modal reset pass -->
 <div id="modal-screenshot"  
        class="offcanvas offcanvas-bottom offcanvas-detached rounded-m">
        	<!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
            <div class="menu-size" style="height:auto;">
                <div class="d-flex mx-3 mt-3 py-1">
                    <div class="align-self-center">
                        <h1 class="mb-0">Send Screenshot</h1>
                    </div>
                    <div class="align-self-center ms-auto">
                        <a href="#" class="ps-4 shadow-0 me-n2" data-bs-dismiss="offcanvas">
                            <i class="bi bi-x color-red-dark font-26 line-height-xl"></i>
                        </a>
                    </div>
                </div>
                <div class="divider divider-margins mt-0"></div>
                <div class="content mt-0">
                      	<div class="col-12" style="min-height:400px;">
                             
                             <!-- -->
                             <form action="javascript:void(0);" method="post" id="frm-screenshot">  
                              	<div class="message"></div>
                                <div class="form-group">
                                                        <label>Screenshot</label>
                                                        <div class="input-group">
                                                          <input type="text" class="form-control" value=" " readonly name="avatar_s" id="avatar_s">
                                                          <input type="file"  class="hide" style="display:none" name="img_screen" id="avatar">
                                                          <span class="input-group-btn">
                                                            <button class="btn btn-primary" type="button" id="btn-upload" data-toggle="tooltip" title="" data-original-title="Upload avatar"><i class="fa fa-upload"></i></button>
                                                            <button class="btn btn-default" type="button" id="btn-clear" data-toggle="tooltip" title="" data-original-title="Clear"><i class="fa fa-times"></i></button>
                                                          </span>
                                                        </div>
                                   </div>
                                   	<div class="form-group">
                                    	<label>Note</label>
                                        <textarea class="form-control required" placeholder="please add your comment at least 10 character and put your id account with "@" at the front" minlength="10" name="prove"></textarea>
                                    </div>                    
                                    <hr/>
                                    <div class="form-group">
                                    	<input type="hidden" value="<?=isset($data['user_reward']['id'])?$data['user_reward']['id']:""?>" name="id" id="id" />
                                   		<button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Process</button>  
										 <?php
															   		if(isset($data['user_reward']['status']))
																	{
																		if($data['user_reward']['status']==3)
																		{
																?>
                                                                		<a href="<?=$data['links']?>" class="btn btn-small btn-info pull-right" target="_blank" id="linktask" >Link Task</a>
                                                                <?php			
																		}
																	}
															   ?>  	
                                   </div>
                              </form>                      
                             <!-- -->
                        </div>
                </div>
                 
            </div>
    </div>         
 <script type='text/javascript'>
 	var task_types = "<?=isset($data['user_reward']['status'])?strtolower(rewardstatus($data['user_reward']['status'])):'waiting'?>";
	var userdata = <?=json_encode($data['user_reward'])?>;
	function checkstatuses()
	{
		if(task_types=="waiting")
		{
			$("#start_task").text("Start Task");
			$("#start_task").addClass("btn-info");
			$("#start_task").removeClass("btn-success");	
		}else if(task_types=="screenshot")
		{
			 
			$("#start_task").text("Send "+ task_types);
			$("#start_task").addClass("btn-success");
			$("#start_task").removeClass("btn-info");
		}else if(task_types=="denied")
		{
			$("#start_task").text("Denied");
			$("#start_task").addClass("btn-danger");
			$("#start_task").removeClass("btn-success");
		}
		 
	}
	$(document).ready(function() {   
		 //$("#goto").attr("href","<?=$data['links']?>");
		 //$("#goto").trigger("click");
		 $("#start_task").click(function()
		 {
			
			if(task_types=="waiting")
			{
				var formdata = new FormData($("#form-personal")[0]);
				var req = post('<?=site_url('tasks/save')?>',{id:<?=$data['id']?>,status:3,osc:window.browserInfo});
				req.done(function(out){
					if(!out.error)
					{
						$("#start_task").text("Send "+ out.status);
						$("#start_task").addClass("btn-success");
						$("#start_task").removeClass("btn-info");
						
						task_types="screenshot";
						$("#frm-screenshot #id").val(out.id);
						openInNewTab("<?=$data['links']?>");
					}
					else
					{
						smart_message(out.message);
					}
				});
				return false;
			}else if(task_types=="screenshot")
			{
				 
				//$("#modal-screenshot").addClass('show');
				
				$("#modal-screenshot").offcanvas('show');
				//visibility
				 
				//$("#modal-screenshot").attr('style','display:block; visibility:visible');
				return false;
			}
		 });
		$("#btn-upload").click(function(){
			$("#avatar").trigger('click');
		});
		$("#avatar").change(function(){
			$("#avatar_s").val($(this).val());
		});
		
		$("#frm-screenshot").validate({
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
				var data = new FormData($("#frm-screenshot")[0]);
				var req = postFile('<?=site_url("tasks/updatescreenshot")?>',data);
				req.done(function(out){
					if(out.error==false)
					{
						smart_success_box(out.message,'#frm-screenshot .message');
						//document.location.href= window.location;
					}
					else
					{
						smart_error_box(out.message,'#frm-screenshot .message');
					}
				});
				return false;
			}
		}); 
		checkstatuses();		
	});
 	
	function openInNewTab(url) {
	  window.open(url, '_blank').focus();
	}


</script>	
 
    
 
       
      