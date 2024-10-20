<?php
include __DIR__."/chunk/header.php";
?>
<!--start wrapper-->
  <div class="wrapper">
  	 <?php
		include __DIR__."/chunk/page_header.php";
		include __DIR__."/chunk/sidebar.php";
	?>
     <!--start content-->
          <main class="page-content">
       		 <?php
             	if(isset($tpl) && is_file(__DIR__."/".$tpl.'.php') && file_exists(__DIR__."/".$tpl.'.php'))
				{
					include(__DIR__."/".$tpl.'.php');
				}
			 ?>	
       </main>
    <!--end content-->
       
  </div>
<!--end wrapper-->
   
  <script src="assets/skodash/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/skodash/assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="assets/skodash/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
 
  <script src="assets/skodash/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/skodash/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="assets/skodash/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
 
  <!--app-->
  <script src="assets/skodash/assets/js/app.js"></script> 
 </body>
</html>
 