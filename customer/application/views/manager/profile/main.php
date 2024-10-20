<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')) && is_file(config_item('upload_path').user_info('avatar')) && file_exists(config_item('upload_path').user_info('avatar')))
{
	$avatar = config_item('main_site')."uploads/".user_info('avatar');
}
?>
<div class="card card-style overflow-visible mt-5">
           <div class="mt-n5"></div>
           <a href="javascript:void(0)" id="btn-upload">
           	<img src="<?=$avatar?>" alt="img" width="180" id="renderImage" class="mx-auto rounded-circle mt-n5 shadow-l">
           </a>
           <form action="javascript:void(0);" role="form" method="post" id="form-avatar" class="form-layout">
           <input type="file"  name="image"  id="upload_file" style="display:none;" /> 
           </form>
           <small class="color-red-dark text-center"><i><?=custom_language('Click Image for upload profile')?></i></small>
           <h1 class="color-theme text-center font-30 pt-3 mb-0">
		    		<i class="color-green-light bi bi-check-circle-fill "></i>
		   <?=strtoupper(user_info("name"))?>
            
           </h1>
            <h6 class="color-theme text-center font-15 pt-3 mb-0">
            		 
            </h6>
           <br/> 
           
            
           <?php
		   /*
           <p class="text-center font-11">
             
             <i class="bi bi-check-circle-fill color-yellow-dark pe-2"></i>A-<?=user_info('id')?>
          	
           </p>
           */
		   ?>
           <div class="content mt-0 mb-2">
                <?php
					include __DIR__."/../chunk/wallet.php";
					 
				?>
                <div class="list-group list-custom list-group-flush list-group-m rounded-xs">
                    <a href="#" class="list-group-item" data-bs-toggle="offcanvas" data-bs-target="#menu-information">
                        <i class="bi bi-person-circle"></i>
                        <div><?=custom_language('Information')?></div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
					<a href="#" class="list-group-item" data-bs-toggle="offcanvas" data-bs-target="#menu-refferal-link">
                        <i class="bi bi-person-circle"></i>
                        <div><?=custom_language('Refferal')?></div>
                        <i class="bi bi-chevron-right"></i>
                    </a> 
                   
					<a href="#"   data-bs-toggle="offcanvas" data-bs-target="#menu-about" class="list-group-item">
                        <i class="bi bi-bell-fill"></i>
                        <div><?=custom_language('About Us')?></div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
					<a href="#"   data-bs-toggle="offcanvas" data-bs-target="#menu-terms" class="list-group-item">
                        <i class="bi bi-droplet-fill"></i>
                        <div><?=custom_language('Term of Services')?></div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
					<!--
                    <a href="settings.html" class="list-group-item">
                        <i class="bi bi-gear-fill"></i>
                        <div>Settings</div>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    -->
                </div>
           </div>
       </div>
       <div class="btn btn-full mx-3 gradient-highlight shadow-bg shadow-bg-xs"    data-bs-toggle="offcanvas" data-bs-target="#menu-contact" ><?=custom_language('Contact Support')?></div>
       
 <script>
 $(function()
 {
	$("#btn-upload").click(function(){
		$("#upload_file").trigger('click');
	});
	$("#upload_file").change(function(){
		var input  = $(this)[0];
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('#renderImage').attr('src', e.target.result);
			}
	
			reader.readAsDataURL(input.files[0]);
			$("#form-avatar").trigger("submit");
		}
	}); 
	$("#form-avatar").validate({
		ignore:[],
		submitHandler:function(){
			 
			var formdata = new FormData($("#form-avatar")[0]);
			var req = postFile('<?=site_url('profile/saveavatar')?>',formdata);
			req.done(function(out){
				if(!out.error)
				{
					 
					 smart_message(out.message);
				}
				else
				{
					smart_message(out.message);
				}
			});
			return false;
		}
	});
 });
 </script>      
       
       
       
      