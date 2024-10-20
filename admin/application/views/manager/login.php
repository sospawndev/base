 

<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?=base_url()?>">
  <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
  <link rel="icon" href="<?=config_item('main_site')?>/uploads/<?=settings('favicon')?>" type="image/png" />
  
  <!-- Bootstrap CSS -->
  <link href="assets/skodash/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/style.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/icons.css" rel="stylesheet">
    <link href="assets/skodash/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/semi-dark.css" rel="stylesheet" />
   <link href="assets/skodash/assets/css/green-theme.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
  <link href="assets/skodash/assets/css/pace.min.css" rel="stylesheet" />

  <title><?=config_item("site_name")?></title>
  <style type="text/css">
  	html.green-theme body{
  
		color: #000;
		background-color:#900;
	
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
	html.dark-theme body #js-validation-login i
	{
		color:black;
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
               <!--
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="assets/skodash/login-2.png" class="img-fluid" alt=""  >
                </div>
                -->
                <div class="col-lg-12">
                  <div class="card-body p-4 p-sm-5">
                    
                    <h6 class="card-title">Sign In</h6>
                    <p class="card-text mb-5">Manage Your <b><?=config_item("site_name")?></b></p>
                  	<form action="javascript:void(0);" role="form" method="post" id="js-validation-login" class="form-body">
                       
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Username</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bx bx-user"></i></div>
                              <input type="text" class="form-control radius-30 ps-5"   required="required" name="username" id="username" placeholder="Enter username">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" class="form-control radius-30 ps-5" required="required"  name="password"id="password" placeholder="Enter Password">
                            </div>
                          </div>
                          <div class="col-6">
                          </div>
                          <div class="col-6 text-end">	
                          	 
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-danger radius-30">Sign In</button>
                               
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="d-grid">
                              
                             
                            </div>
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
			$('#js-validation-login').submit(function(){
					console.log($("#js-validation-login").serialize()); 
					var req = post('<?=site_url('login/check')?>',$("#js-validation-login").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'#js-validation-login');
							 
							document.location.href='<?=base_url('home')?>';
							 						
							
						}
						else
						{
							smart_error_box(out.message,'#js-validation-login');
						}
					});
 
			});
		});
		</script>

</body>

</html>