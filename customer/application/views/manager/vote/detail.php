<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
 
?>
	<div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Vote Detail')?> </h3>
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
                                                           <div class="card-body padding-0 margin-0 card-task">
                                                              
                                                               <h1 class="text-center h-task">
                                                                    Dapatkan Reward Sebesar <?=number_format($data['reward'],0)?> <?=setting("coin_name")?>
                                                               </h1>
                                                                <img src="<?=config_item('main_site')?>uploads/<?=$data['image']?>" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark"><?=$data['cats']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- <?=$data['vote_complete']?></span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-10"> <b><?=date('d-m-Y',strtotime($data['start_dates']))?></b></p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                               <h1 class="text-left">
                                                                    <?=$data['titles']?>
                                                               </h1>
                                                               <hr/>
                                                               <div>
                                                               		<a href="" target="_blank" id="goto" style="display:none;">Apps</a>
																	<?php
																		echo $data['description'];
																	?>
                                                               </div>
                                                               <hr/>
                                                                <form id="form-object">
															   <?php
															   	if(isset($data['user_reward']['id']))
																{
																	 
																?>
                                                                	 <?php
																		for($x=0;$x<count($data['vote_option']);$x++)
																		{
																			$ac = "";
																			if($data['vote_option'][$x]['percen']>0)
																			{
																				$ac = "active";	
																			}
																	?>
																			<div class="progress <?=$ac?>">
																				<div class="progress-bar bg-success " style="width: <?=$data['vote_option'][$x]['percen']?>%">
																				  
																				</div>
																				
																					<span class="txt-left"><?=$data['vote_option'][$x]['name']?></span>
																					<span class="txt-right"><?=$data['vote_option'][$x]['percen']?>%  </span>
																				 
																			</div>  
																	<?php
																		}
																	?>
                                                                    <?=$data['vote_complete']?> Pemilih, <?=$data['days']?> Hari Lagi, Voted
                                                                    <hr/>
                                                                 	 
                                                                    <a href="<?=site_url("vote")?>"  class="btn btn-info btn-sm btn-xs btn-lg btn-full" style="width:100%;">Back To Vote</a>
                                                                <?php		
																	 
																}else
																{
																	if(count($data['vote_option'])>0)
																	{
																?>
                                                                		<h4 class="text-center">
																			Vote your option
                                                                       </h4>
                                                                <?php		
																	 
																		for($i=0;$i<count($data['vote_option']);$i++)
																		{
																			$acc = "";
																			if($i==0)
																			{
																				$acc = "active";	
																			}
															    ?>
                                                                
                                                                        <label class="d-flex py-1 form-check-label" for="flexRadioDefault<?=$data['vote_option'][$i]['id']?>">
                                                                        	<div class="align-self-center">
                                                                                <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-xs"><i class="bi bi-vector-pen color-white"></i></span>
                                                                            </div>
                                                                             
                                                                            <div class="align-self-center ps-1">
                                                                                
                                                                            <?=$data['vote_option'][$i]['name']?>
                                                                          
                                                                            </div>
                                                                            <div class="align-self-center ms-auto text-end">
                                                                                <input class="form-check-input" type="radio" name="id_vote_option" id="flexRadioDefault<?=$data['vote_option'][$i]['id']?>" value="<?=$data['vote_option'][$i]['id']?>" <?=($i==0)?'checked':''?>>
                                                                            </div>
                                                                       </label>
                                                                       <div class="divider my-2 opacity-50"></div>
                                                                
                                                                		 
                                                                         
                                                                <?php
																		}
																	}
																?>
                                                                	
                                                                     <textarea name="osc" id="osc" style="display:none;"></textarea>
                                                                     <input type="hidden" name="id_vote" value="<?=$data['id']?>" />
                                                                	 <button href="javascript:void(0);"  class="btn btn-info btn-sm btn-xs btn-lg btn-full" style="width:100%;">Start Vote</button>
                                                                <?php	
																}
															   ?>
                                                               </form>
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
  
 <style type="text/css">
  .progress
{
	/* From https://css.glass */
	/*
	background: rgba(255, 255, 255, 0.2);
	*/
	border-radius: 0px;
	 
	backdrop-filter: blur(5px);
	-webkit-backdrop-filter: blur(5px);
	border: 1px solid rgba(255, 255, 255, 0.3);	
	height:24px;
	margin-bottom:5px;
}
.progress span {
    position: absolute;
    top: 0;
    z-index: 2;
    color: #6c757d; /* Change according to needs */
    text-align: center;
    width: 100%;
	padding-left:7px;
}
.progress span.txt-left {
	text-align: left;
}
.progress span.txt-right {
	text-align: right;
	 
}
.progress.active span {
	color: #fff;
}
.progress.active span.txt-right {
	color: #000;
}
 </style>  
 <script type='text/javascript'>
 	var task_types = "<?=isset($data['user_reward']['id'])?'voted':'waiting'?>";
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
		 
		   
		$("#form-object").validate({
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
				var data = new FormData($("#form-object")[0]);
				var req = postFile('<?=site_url("vote/save")?>',data);
				req.done(function(out){
					if(!out.error)
					{
						smart_success_box(out.message,'#form-object');
						//document.location.href= window.location;
						document.location.href= out.url;
					}
					else
					{
						smart_error_box(out.message,'#form-object');
					}
				});
				return false;
			}
		}); 
		//checkstatuses();		
		$("#osc").val(JSON.stringify(window.browserInfo));
	});
 	
	function openInNewTab(url) {
	  window.open(url, '_blank').focus();
	}


</script>	
 
    
 
       
      