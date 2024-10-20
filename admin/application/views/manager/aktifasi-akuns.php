<?php
$setting = settings(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title><?=isset($setting['website_title'])?$setting['website_title']:""?></title>
		<base href="<?=base_url()?>">
        <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token"> 
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="assets/css/connect.min.css" rel="stylesheet">
        <link href="assets/css/admin3.css" rel="stylesheet">
        <link href="assets/css/dark_theme.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="auth-page sign-in">
        
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="auth-form">
                            <div class="row">
                                <div class="col">
                                    <div class="logo-box"><a href="#" class="logo-text"><?=isset($setting['website_title'])?$setting['website_title']:""?></a></div>
                                    <form action="javascript:void(0);" role="form" method="post" class="js-validation-login">
                                         <h6 class="text-center">Instruksi akun ke email Anda</h6>
                                         <p>Kami telah mengirim kode verifikasi Activasi ke alamat email Anda</p>
                                         <small class="text-muted small">Jika Anda tidak menerima dalam beberapa menit, periksa filter email, spam, atau sampah Anda.</small>
                                        <div class="form-group">
                                            <input type="text" id="pincode-input1">                         
                                        </div>
                                         <div class="form-group text-center text-danger" id="err-container"></div> 
                                           
                                        
                                         
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block d-xl-block">
                         
	                        <div class="auth-image" style="background-image:url('uploads/<?=isset($setting['login_background'])?$setting['login_background']:""?>'); background-color: #fff; background-repeat: no-repeat; background-size: 100% auto;"></div>
                          
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Javascripts -->
        <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>  
		<script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="assets/plugins/bootstrap/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/js/connect.min.js"></script>
       <script src="assets/smart.js"></script>
        <link rel="stylesheet" href="assets/bpincode/css/bootstrap-pincode-input.css">
        <script src="assets/bpincode/js/bootstrap-pincode-input.js"></script>
        <style>
	   .pincode-input-container > .pincode-input-text
	   {
		   width:60px;
		   text-align:center;
	   }
		.pincode-input-container.touch .touchwrapper
		{
		}
	   </style>
		<script>
          $(document).ready(function(){
             // http://fkranenburg.github.io/bootstrap-pincode-input
             $('#pincode-input1').pincodeInput({inputs:6,hidedigits:false,complete:function(value, e, errorElement){
                   // check the code
                   var req = post('<?=site_url('aktifasi/check')?>',{code:value,pid:'<?=$pid?>','<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
                   req.done(function(out){
                       if(out.error==false)
                       {
                            //errorElement
                          document.location.href="<?=site_url('dashboard')?>";
                            
                       }
                       else
                       {
                          $("#err-container").html(out.message); 
                       }
                   });
                }});
          });
        </script>
    </body>
</html>