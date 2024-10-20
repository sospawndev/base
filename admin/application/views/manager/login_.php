<?php
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=config_item('site_name')?> Admin">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="<?=config_item('site_name')?>">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title><?=config_item('site_name')?> Admin</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="assets/_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="assets/_assets/css/main.min.css" rel="stylesheet">
        <link href="assets/_assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
              <span class='sr-only'>Loading...</span>
            </div>
          </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            <div class="authent-logo">
                                 
                            </div>
                            <div class="authent-text">
                                <p>Welcome to </p>
                                <b>
                                <?=config_item('site_name')?>
                                </b>
                                <p>Please Sign-in to your account.</p>
                            </div>

                           <form action="javascript:void(0);" role="form" method="post" class="js-validation-login">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingInput">Username</label>
                                        <input type="text" class="form-control"   name="username" id="username" aria-describedby="usernameHelp" placeholder="Enter username">
                                        
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingPassword">Password</label>
                                        <input type="password" class="form-control" name="password"id="password" placeholder="Password">
                                        
                                      </div>
                                </div>
                                <div class="mb-3 form-check">
                                   
                                </div>
                                <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Sign In</button>
                                 
                            </div>
                              </form>
                              <div class="authent-reg">
                                 
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
        <!-- Javascripts -->
         <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>
		<script src="assets/_assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="assets/_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="assets/_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/_assets/js/main.min.js"></script>
         <script src="assets/smart.js"></script>
        <script>
		$(function()
		{
			$('.js-validation-login').submit(function(){
					var req = post('<?=site_url('login/check')?>',$(".js-validation-login").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'.js-validation-login');
							 
							document.location.href='<?=base_url('home')?>';
							 						
							
						}
						else
						{
							smart_error_box(out.message,'.js-validation-login');
						}
					});
 
			});
		});
		</script>
    </body>
</html>

 