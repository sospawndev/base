<?php
$setting = settings(); 
?>
<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?=base_url()?>">
  <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
 <link rel="icon" href="<?=config_item('main_site')?>uploads/<?=setting('favicon')?>" type="image/png" />
  
  <!-- Bootstrap CSS -->
  <link href="assets/skodash/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/style.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/icons.css" rel="stylesheet">
    <link href="assets/skodash/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/red-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/green-theme.css" rel="stylesheet" />
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
  <link href="assets/skodash/assets/css/pace.min.css" rel="stylesheet" />

 <title><?=isset($setting['website_title'])?$setting['website_title']:"Client"?></title>
   <style type="text/css">
  	html.green-theme body{
  
		color: #000;
		background-color:#900;
		overflow-y:auto;
	
	}
	html.green-theme .form-control, html.green-theme .form-select {
	  color: #fff;
	  background-color: #da2a2a;
	  border: 1px solid rgb(255 255 255 / 12%);
	}
	html.green-theme i {
	  color: #fff;
	   
	}
	html.green-theme ::placeholder {
		color: #fff !important;
		opacity: 0.8 !important;
	}
	main.authentication-content {
		 
		padding-top: 300px;
		padding-bottom: 300px;
		 
	}
  </style>
</head>

<body class="light-theme">

  <!--start wrapper-->
  <div class="wrapper">
        <!--start content-->
       <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="<?=config_item('main_site')?>uploads/backauth.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                 
                 <div class="card-body p-4 p-sm-5">
                  
                  <form action="javascript:void(0);" role="form" method="post" id="frm-object" class="form-body">
                    <p class="card-text mb-5 message"></p>  
                    <h5 class="card-title">Sign Up</h5>
                    <p class="card-text mb-5">Manage Your Task Account</p>
                  	 
                 	   
                        <div class="row g-3">
                         <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Company Name (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="text" class="form-control radius-30 ps-5 required"   required="required" name="company_name" id="company_name" placeholder="Enter Name">
                            </div>
                          </div>
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">PIC Name (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="text" class="form-control radius-30 ps-5 required"   required="required" name="company_pic" id="company_pic" placeholder="Enter PIC">
                            </div>
                          </div>
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Phone Number (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-phone"></i></div>
                              <input type="text" class="form-control radius-30 ps-5 required"   required="required" name="telp" id="telp" placeholder="Enter Phone Number">
                            </div>
                          </div>
                           <div class="col-12">
                            <label for="phone" class="form-label">Country (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-flag"></i></div>
                               <select name="country" id="country" class="form-control  required radius-30 ps-5  ">
                               	<option value=""></option>
								<?php
									for($i=0;$i<count($country);$i++)
									{
										
								?>
                                		
                                		<option value="<?=$country[$i]['name']?>"><?=$country[$i]['name']?></option>
                                <?php
									}
								?>
                               </select>
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Office Address (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-home"></i></div>
                              <textarea   class="form-control radius-30 ps-5 required"   required="required" name="company_address" id="company_address" placeholder="Enter Office Address"></textarea>
                            </div>
                          </div>
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">What kind of your business? (*)</label>
                            <div class="ms-auto position-relative">
                              
                               <select name="company_type_bis" id="bisnis_type" class="form-control  required radius-30 ps-5  ">
                               	<option value=""></option>
								<?php
									for($i=0;$i<count($bisnis_type);$i++)
									{
										
								?>
                                		
                                		<option value="<?=$bisnis_type[$i]['name']?>"><?=$bisnis_type[$i]['name']?></option>
                                <?php
									}
								?>
                               </select>
                            </div>
                          </div>
                           
                         
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" class="form-control radius-30 ps-5"  required="required" name="email" id="email"   placeholder="Email Address">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" class="form-control radius-30 ps-5" required="required"  name="password"id="password" placeholder="Enter Password">
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="terms" value="1"  >
                              <label  >I Agree to the <a href="javascript:void(0);" id="terms">Terms & Conditions</a></label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary radius-30">Sign up</button>
                            </div>
                          </div>
                          <div class="col-12">
                            <p class="mb-0">Already have an account? <a href="<?=site_url("login")?>">Sign in here</a></p>
                          </div>
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </main>
       
      
        
       <!--end page main-->

  </div>
  <!--end wrapper-->
  <!-- modal reset pass -->
    <div id="modalterms" class="modal fade" role="dialog">
      <div class="modal-dialog">
         
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <h4 class="modal-title">Terms & Conditions</h4>
          </div>
          <div class="modal-body" >
              <div style="max-height:600px;">
                  <div style="overflow:auto; max-height:500px;">
                        <?=setting('terms')?>
                  </div>
              </div>    
          </div>
          <div class="modal-footer">
             
            <!--
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
            -->
            
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
       
      </div>
    </div>   

  <!--plugins-->
  <script src="assets/skodash/assets/js/jquery.min.js"></script>
  <script src="assets/skodash/assets/js/pace.min.js"></script>
  <script src="assets/skodash/assets/js/bootstrap.bundle.min.js"></script>
   <link href="assets/plugins/select2/css/select2.css" rel="stylesheet">  
        <script src="assets/plugins/select2/js/select2.js"></script>
  <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
  <script src="assets/plugins/jquery-validation/additional-methods.js"></script>
   <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>  
  <script src="assets/skodash/assets/smart.js"></script>
        <script>
		$(function()
		{
			$("#frm-object").validate({
				ignore:[],
				onkeyup:false,
				errorClass: 'help-block text-right animated fadeInDown',
				errorElement: 'div',
				errorPlacement: function(error, e) {
					jQuery(e).parents('.col-12').append(error);
				},
				highlight: function(e) {
					jQuery(e).closest('.col-12').removeClass('has-error').addClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				success: function(e) {
					jQuery(e).closest('.col-12').removeClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				submitHandler:function(){
					var req = post('<?=site_url('register/save')?>',$("#frm-object").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'#frm-object .message');
							//document.location.href="<?=site_url('home')?>";
						}
						else
						{
							smart_message(out.message,'#frm-object .message');
						}
					});
					req.fail(function()
					{
						smart_message("failed, check your connection then refresh page");
					});
					return false;
				}
			});
			//
			 $('#country').select2({
				allowClear: true,
				placeholder: "Select an option"
			}); 
			 $('#bisnis_type').select2({
				allowClear: true,
				placeholder: "Select an option"
			}); 
			$('#province').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#city').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#district').select2({
				allowClear: true,
				placeholder: "Select an option"
			});
			$('#country').change(function()
			{
				var cd = $(this).val();
				$(".prevs").addClass("hide");
				if(cd == "INDONESIA")
				{
					$(".prevs").removeClass("hide");					
				}
			});
			
			$('#province').change(function()
			{
				var ids = $(this).val();
				getcity(ids); 
			});
			$('#city').change(function()
			{
				var ids = $(this).val();
				getdistrict(ids); 
			});
			
			// 
			$("#terms").click(function()
			{
				$("#modalterms").modal("show");
			});
		});
		var city_sel = '';
		function getcity(ids)
		{
			var req = post('<?=site_url('api/get-by-province')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
			$("#city").find('option').remove();
			req.done(function(out){
				if(!out.error)
				{
					$.each(out.data,function(key,val){
						$("#city").append("<option value='"+val.id+"'>"+val.name+"</option>");
					});
				}
				$("#city").trigger('change.select2');
				$("#city").val(city_sel).trigger('change');
			});	
		}
		function getdistrict(ids)
		{
			var req = post('<?=site_url('api/get-by-city')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
			$("#district").find('option').remove();
			req.done(function(out){
				if(!out.error)
				{
					$.each(out.data,function(key,val){
						$("#district").append("<option value='"+val.id+"'>"+val.name+"</option>");
					});
				}
				$("#district").trigger('change.select2');
				$("#district").val(city_sel).trigger('change');
			});	
		}
		function resendclick()
		{
			$.ajax({
                            url: "register/resend",
                            type: 'POST',
                            data: {id:1},
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function(){
                                 
                            },
                            success: function(out)
                            {
                                
                                 smart_message("Resend success");
                            },
                            error: function()
                            {
                                 smart_message("Resend Failed");
                            },
                            complete:function(out){
                                
                            }
                        });	
		}
		</script>
        <style type="text/css">
		html.dark-theme .modal-footer .btn
		{
			color:white;	
		}
		.hide, .hidden
		{
			display:none !important;	
		}
		.select2-container {
			width: 100% !important;
		}
		.select2-container--default .select2-selection--single {
			 
			 
		}
		.modal-dialog
		{
			max-width:90%;	
		}
		</style>

</body>

</html>