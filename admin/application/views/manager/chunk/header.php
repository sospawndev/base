<?php
$setting = settings(); 
?>
<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="application-name" content="<?=isset($setting['website_title'])?$setting['website_title']:""?>">
  <meta name="apple-mobile-web-app-title" content="<?=isset($setting['website_title'])?$setting['website_title']:""?>">
  <title><?=isset($setting['website_title'])?$setting['website_title']:"Admin"?></title>
  <base href="<?=base_url()?>">
  <link rel="icon" href="<?=config_item('main_site')?>uploads/<?=settings('favicon')?>" type="image/png" />
  <!--plugins-->
  <link href="assets/skodash/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/skodash/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="assets/skodash/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="assets/skodash/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/style.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/icons.css" rel="stylesheet">
  <link href="assets/skodash/assets/ikon.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/brun/vendor/font-awesome/css/font-awesome.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="assets/skodash/assets/css/pace.min.css" rel="stylesheet" />


  <!--Theme Styles-->
  <link href="assets/skodash/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/red-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/header-colors.css" rel="stylesheet" />
  <!--plugins-->
  <script src="assets/skodash/assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/skodash/assets/js/jquery.min.js"></script>
  <script src="assets/skodash/assets/js/pace.min.js"></script>
   <!-- datatable -->
        
  <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet">  
  <script src="assets/plugins/DataTables/datatables.min.js"></script>
   <link rel="stylesheet" href="assets/datatable/buttons.dataTables.min.css">
  <script src="assets/datatable/dataTables.buttons.min.js"></script>
		<script src="assets/datatable/buttons.flash.min.js"></script>
		<script src="assets/datatable/jszip.min.js"></script>
		<script src="assets/datatable/pdfmake.min.js"></script>
		<script src="assets/datatable/vfs_fonts.js"></script>
		<script src="assets/datatable/buttons.html5.min.js"></script>
		<script src="assets/datatable/buttons.print.min.js"></script>
        <script src="assets/datatable/buttons.colVis.min.js"></script>  
   <!-- select2 -->
        <link href="assets/plugins/select2/css/select2.css" rel="stylesheet">  
        <script src="assets/plugins/select2/js/select2.js"></script>
 
 <link href="assets/skodash/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="assets/skodash/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="assets/skodash/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/skodash/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
 <script src="assets/skodash/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="assets/skodash/assets/plugins/datetimepicker/js/picker.js"></script>
	<script src="assets/skodash/assets/plugins/datetimepicker/js/picker.time.js"></script>
	<script src="assets/skodash/assets/plugins/datetimepicker/js/picker.date.js"></script>
	<script src="assets/skodash/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="assets/skodash/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
  
   <link href="assets/datetimepicker/build/jquery.datetimepicker.min.css" rel="stylesheet">  
		<script src="assets/datetimepicker/build/jquery.datetimepicker.full.js"></script>
        
  <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
  <script src="assets/plugins/jquery-validation/additional-methods.js"></script>
   <script src="assets/ckeditor/ckeditor.js"></script>
	<script src="assets/ckfinder/ckfinder.js"></script>
    <script src="assets/ckeditor/adapters/jquery.js"></script>
    <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>   
  <script src="assets/skodash/qrcode.js"></script>      
  <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
			var ck_conf = {extraPlugins:'youtube',youtube_controls: true,youtube_autoplay : false,allowedContent: true,removePlugins : 'iframe',"toolbar":[["Source","-","Cut","Copy","Paste","PasteText","PasteFromWord","-","Undo","Redo",'textfield'],["Image","Table","Smiley","Link","Unlink","Anchor"],["NumberedList","BulletedList","-","Outdent","Indent","-","Blockquote","CreateDiv","-","JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock","-","BidiLtr","BidiRtl"],["Bold","Italic","Underline","Strike","Subscript","Superscript","-","RemoveFormat","TextColor","BGColor","NumberedList","BulletedList"],["Styles","Format","Font","FontSize",'filebrowser','filebrowser','uploadwidget','filetools','uploadimage','uploadfile',"Youtube"]],"language":"en","width":"100%",
	"filebrowserBrowseUrl":"assets\/ckfinder\/ckfinder.html","filebrowserImageBrowseUrl":"assets\/ckfinder\/ckfinder.html?type=Images",
	"filebrowserFlashBrowseUrl":"assets\/ckfinder\/ckfinder.html?type=Flash",
	"filebrowserUploadUrl":"assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files",
	"filebrowserImageUploadUrl":"assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images",
	"filebrowserFlashUploadUrl":"assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash"
	
	};
		CKEDITOR.editorConfig = function( config )
		{
			config.resize_enabled = true;
			config.resize_minHeight = 550;
			config.resize_maxHeight = 1000;
			config.filebrowserBrowseUrl = '<?=base_url()?>/assets/kcfinder/browse.php?type=files';
			config.filebrowserImageBrowseUrl = '<?=base_url()?>/assets/kcfinder/browse.php?type=images';
			config.filebrowserFlashBrowseUrl = '<?=base_url()?>/assets/kcfinder/browse.php?type=flash';
			config.filebrowserUploadUrl = '<?=base_url()?>/assets/kcfinder/upload.php?type=files';
			config.filebrowserImageUploadUrl = '<?=base_url()?>/assets/kcfinder/upload.php?type=images';
			config.filebrowserFlashUploadUrl = '<?=base_url()?>/assets/kcfinder/upload.php?type=flash';
		}; 
			 </script>      
  <script src="assets/bootbox.js"></script>
  <script src="assets/skodash/assets/smart.js"></script>
  <script>
  $(function()
  {
	 $('.select2').select2({
		allowClear: true,
	    placeholder: "Select an option"
	}); 
	$(".close").click(function()
	{
		$('.modal').modal('hide');
	});
	$("#smart-message")
	
  });
  </script> 
  <style type="text/css">
  	button.btn, i.fa
	{
		/*
		color:white !important;
		*/
	}
	html.dark-theme .brand-logo img
	{
		filter:inherit;	
		background-size: 100%;
	}
	.xhide
	{
		display:none !important;	
	}

  </style>
</head>
 <body class="light-theme">