 

<!doctype html>
<html lang="en" class="dark-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?=base_url()?>">
  <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
  <link rel="icon" href="assets/skodash/favicon.png" type="image/png" />
  
  <!-- Bootstrap CSS -->
  <link href="assets/skodash/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/style.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/icons.css" rel="stylesheet">
    <link href="assets/skodash/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
  <link href="assets/skodash/assets/css/pace.min.css" rel="stylesheet" />

  <title><?=config_item("site_name")?></title>
</head>

<body class="dark-theme">

  <!--start wrapper-->
  <div class="wrapper">
    
       <!--start content-->
       <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
               <!--
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="assets/skodash/login-2.png" class="img-fluid" alt=""  >
                </div>
                -->
                <div class="col-lg-12">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Forgot Password</h5>
                    <p class="card-text mb-5">Manage Your Token <?=config_item("site_name")?></p>
                  	<form action="javascript:void(0);" role="form" method="post" id="js-validation-login" class="form-body js-validation-login">
                       <div class="mb-3 pesans">
                                
                       </div>
                        <div class="row g-3">
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Enter Email</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="email" class="form-control radius-30 ps-5"   required="required" name="email" id="email" placeholder="Enter Email">
                            </div>
                            
                          </div>
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Password (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="password" class="form-control radius-30 ps-5"   required="required" name="password" id="password" placeholder="Enter password">
                            </div>
                            
                          </div>
                          
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Confirm Password (*)</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="password" class="form-control radius-30 ps-5"   required="required" name="confirmpassword" id="confirmpassword" equalTo="#password" placeholder="Enter Confirm Password">
                            </div>
                            
                          </div>
                          
                          <div class="col-6">
                            <div class="d-grid">
                              <input type="hidden" value="<?=$data['id']?>" name="id" />  
                              <button type="submit" class="btn btn-primary radius-30">Forgot</button>
                               
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="d-grid">
                              
                              
                            </div>
                          </div>
                           <div class="col-12">
                                <p class="mb-0"><a href="<?=site_url("login")?>">if you have account, Sign in here</a></p>
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


  <!--plugins-->
  <script src="assets/skodash/assets/js/jquery.min.js"></script>
  <script src="assets/skodash/assets/js/pace.min.js"></script>
  <script src="assets/skodash/assets/js/bootstrap.bundle.min.js"></script>
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
					jQuery(e).parents('.vg').append(error);
				},
				highlight: function(e) {
					jQuery(e).closest('.vg').removeClass('has-error').addClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				success: function(e) {
					jQuery(e).closest('.col-12').removeClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				submitHandler:function(){
					var req = post('<?=site_url('api/forgotsave')?>',$("#frm-object").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							document.location.href="<?=site_url('home')?>";
							 
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
			
			 
			 
		});
		 
		</script>

</body>

</html>