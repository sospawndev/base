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
  <title><?=isset($setting['website_title'])?$setting['website_title']:"Client"?></title>
  <base href="<?=base_url()?>">
  <link rel="icon" href="<?=config_item('main_site')?>uploads/<?=setting('favicon')?>" type="image/png" />
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
        
  <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
  <script src="assets/plugins/jquery-validation/additional-methods.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
	<script src="assets/ckfinder/ckfinder.js"></script>
    <script src="assets/ckeditor/adapters/jquery.js"></script>
    <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>   
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
  <script src="assets/skodash/qrcode.js"></script>         
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
  function copytext(elems)
  {
	   var copyText = document.getElementById(elems);

	  copyText.select();
	  copyText.setSelectionRange(0, 99999); 
	  navigator.clipboard.writeText(copyText.value);
	  smart_message("copy to clipboard");
  }
  
  function CopyToClipboard(id)
  {
			$("#smart-loader").modal('show'); 
			/*
			var r = document.createRange();
			r.selectNode(document.getElementById(id));
			window.getSelection().removeAllRanges();
			window.getSelection().addRange(r);
			document.execCommand('copy');
			window.getSelection().removeAllRanges();*/
			var texts = $("#"+ id).val();
			copyToClipboard_val(texts);
			smart_message("copy to clipboard");
			 
  }
  function copyToClipboard_val(text) {
		if (window.clipboardData && window.clipboardData.setData) {
			// Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
			return window.clipboardData.setData("Text", text);
	
		}
		else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
			var textarea = document.createElement("textarea");
			textarea.textContent = text;
			textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
			document.body.appendChild(textarea);
			textarea.select();
			try {
				return document.execCommand("copy");  // Security exception may be thrown by some browsers.
			}
			catch (ex) {
				console.warn("Copy to clipboard failed.", ex);
				return prompt("Copy to clipboard: Ctrl+C, Enter", text);
			}
			finally {
				document.body.removeChild(textarea);
			}
		}
	}
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
  </script> 
  <style type="text/css">
  	button.btn, i.fa, .btn
	{
		 
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