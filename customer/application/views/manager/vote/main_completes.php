<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
?>
	<div class="content my-0 mt-n2 px-1">
            <div class="d-flex">
                <div class="align-self-center">
                    <h3 class="font-16 mb-2"><?=custom_language('Vote')?> </h3>
                </div>
                <div class="align-self-center ms-auto">
                </div>
            </div>
        </div>
	<div class="card card-style">
            <div class="content">
                 <!-- -->
                  <div class="tabs tabs-pill" id="tab-group-2">
                    <div class="tab-controls rounded-m p-1 overflow-visible">
                         
                         <a class="font-13 rounded-m shadow-bg tab_ongoing shadow-bg-s tabsb"  href="<?=site_url("vote/on-going")?>" aria-expanded="false">On Going</a>
                       
                       
                         <a class="font-13 rounded-m shadow-bg shadow-bg-s tab_completed tabsb"   href="<?=site_url("vote/completes")?>" aria-expanded="true">Completes</a>
                         <a class="font-13 rounded-m shadow-bg shadow-bg-s tab_upcoming tabsb"   href="<?=site_url("vote/upcoming")?>" aria-expanded="false">Upcoming</a>
                        
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                       
                          
                        <!-- Tab Group ongoing -->
                         <div class="collapse tabtipe_ongoing show coltab" id="tabtipe_ongoing" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div id='pagination_on_going'></div>
                            <div class="row" >
                                 <?php
								 	echo $temps;
								 ?>
                                 
                                   
                            </div>  
                            <!-- -->
                           
                        </div>     
                        
                        <!-- -->
                        
                    </div>
                 <!-- -->
            </div>
        </div>
 <style type="text/css">
.progress
{
	/* From https://css.glass */
	/*
	background: rgba(255, 255, 255, 0.2);
	*/
	color: #6c757d; 
	height:24px;
	margin-bottom:5px;
}
.progress span {
    position: absolute;
    right: 30px;
    left: 30px;
    z-index: 2;
    color: #6c757d; /* Change according to needs */
    text-align: center;
     
	padding-left:7px;
}
.progress span.txt-left {
	text-align: left;
}
.progress span.txt-right {
	text-align: right;
	 
}
.progress.active span {
	color: #fff;
}
.progress.active span.txt-right {
	color: #000;
}
 </style>        
 <script type='text/javascript'>
	$(document).ready(function() {   
		<?php
		/*
		createPagination_upcoming(0);
		$('#pagination_upcoming').on('click','a',function(e){
			e.preventDefault(); 
			var pageNum = $(this).attr('data-ci-pagination-page');
			createPagination_upcoming(pageNum);
		});
		//on_going
		createPagination_on_going(0);
		$('#pagination_on_going').on('click','a',function(e){
			e.preventDefault(); 
			var pageNum = $(this).attr('data-ci-pagination-page');
			createPagination_on_going(pageNum);
		});
		//on_completes
		createPagination_completes(0);
		$('#pagination_completes').on('click','a',function(e){
			e.preventDefault(); 
			var pageNum = $(this).attr('data-ci-pagination-page');
			createPagination_completes(pageNum);
		});
		<?php
		if(isset($_GET['task']))
		{
		?>
				$.each($(".tabsb"),function()
				{
					$(this).attr("aria-expanded",false);
				});
				$.each($(".coltab"),function()
				{
					$(this).removeClass("show");
				});
				$(".tab_<?=$_GET['task']?>").attr("aria-expanded",true);
				$("#tabtipe_<?=$_GET['task']?>").addClass("show");
				$('#pagination_<?=$_GET['task']?>').trigger("click");
		<?php
		}
		?>
		*/
		?>
	});
 	function createPagination_upcoming(pageNum){
		$.ajax({
			url: '<?=base_url()?>index.php/vote/upcoming/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				$('#pagination_upcoming').html(responseData.pagination);
				$("#data_upcoming").html(responseData.temps);
				//paginationData(responseData.empData);
			}
		});
	}
	function createPagination_on_going(pageNum){
		$.ajax({
			url: '<?=base_url()?>index.php/vote/on_going/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				$('#pagination_on_going').html(responseData.pagination);
				$("#data_on_going").html(responseData.temps);
				//paginationData(responseData.empData);
			}
		});
	}
	
	function createPagination_completes(pageNum){
		$.ajax({
			url: '<?=base_url()?>index.php/vote/completes/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(responseData){
				$('#pagination_completes').html(responseData.pagination);
				$("#data_completes").html(responseData.temps);
				//paginationData(responseData.empData);
			}
		});
	}

</script>	
 
    
 
       
      