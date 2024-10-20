<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
     <title><?=$this->config->item('site_name')?></title>
	<base href="<?=base_url()?>">
    <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token"> 
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="front/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="front/img/icon/192x192.png">
    <link rel="stylesheet" href="front/css/style.css">
    <link rel="stylesheet" href="front/css/sub.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css"/> 
    <link rel="manifest" href="__manifest.json">
    <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 
    </script>
     <style>
   .pincode-input-container > .pincode-input-text
   {
	   padding:0;
	   text-align:center;
   }
    .pincode-input-container.touch .touchwrapper
    {
        height:36px;
    }
   </style>
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
         
        <div class="pageTitle"></div>
        <div class="right">
            <a href="<?=site_url("login")?>" class="headerButton">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="login-form">
            <div class="section">
                <h1>Daftar Mitra</h1>
                <h4>Lengkapi Form Dibawah ini, untuk bergabung menjadi mitra</h4>
            </div>
            <div class="section mt-2 mb-5">
                <form action="javascript:void(0);" role="form" method="post" id="frm-register" >

                    <strong class="ft-lt">Kode Aktifasi Akun Anda <span class="label label-warning"><?=$activate_code?></span></strong>
                    <h3 class="text-center ft-lt">Masukan Kode Aktifasi Akun Anda</h3>
                    <div class="form-group">
                        <input type="text" id="pincode-input1">                         
                    </div>

                    <div class="form-group text-center text-danger" id="err-container">
               		</div> 

                    <div class="form-button-group">
                    	 
                    </div>

                </form>
            </div>
        </div>



    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="front/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="front/js/lib/popper.min.js"></script>
    <script src="front/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="front/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="front/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="front/js/base.js"></script>
    <!-- edited-->
     <!-- page scripts -->
    <script src="front/js/jquery-validation/dist/jquery.validate.js"></script>
     
  	<script src="front/smart.js"></script>
    <link rel="stylesheet" href="assets/vendor/bpincode/css/bootstrap-pincode-input.css">
    <script src="assets/vendor/bpincode/js/bootstrap-pincode-input.js"></script>
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