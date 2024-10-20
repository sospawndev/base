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
                    <h3 class="font-16 mb-2"><?=custom_language('Task')?> </h3>
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
                         
                         <a class="font-13 rounded-m shadow-bg tab_ongoing shadow-bg-s tabsb" data-bs-toggle="collapse" href="#tabtipe_ongoing" aria-expanded="true">On Going</a>
                       
                       
                         <a class="font-13 rounded-m shadow-bg shadow-bg-s tab_completed tabsb" data-bs-toggle="collapse" href="#tabtipe_completed" aria-expanded="false">Completes</a>
                         <a class="font-13 rounded-m shadow-bg shadow-bg-s tab_upcoming tabsb" data-bs-toggle="collapse" href="#tabtipe_upcoming" aria-expanded="false">Upcoming</a>
                        
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                       
                        <div class="collapse tabtipe_upcoming  coltab" id="tabtipe_upcoming" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div id='pagination_upcoming'></div>
                            <div class="row" >
                                 <div id="data_upcoming" class="row" >
                                 
                                 </div>
                                   
                            </div>  
                            <!-- -->
                           
                        </div>     
                        <!-- Tab Group ongoing -->
                         <div class="collapse tabtipe_ongoing show coltab" id="tabtipe_ongoing" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div id='pagination_on_going'></div>
                            <div class="row" >
                                 <div id="data_on_going" class="row" >
                                 
                                 </div>
                                   
                            </div>  
                            <!-- -->
                           
                        </div>     
                        
                        <!-- -->
                        <!-- Tab Group ongoing -->
                         <div class="collapse tabtipe_completed coltab" id="tabtipe_completed" data-bs-parent="#tab-group-2">
                            <!-- -->
                             <div id='pagination_completes'></div>
                            <div class="row" >
                                 <div id="data_completes" class="row">
                                 
                                 </div>
                                   
                            </div>  
                            <!-- -->
                           
                        </div>     
                        
                        <!-- -->
                    </div>
                 <!-- -->
            </div>
        </div>
        
 <script type='text/javascript'>
	$(document).ready(function() {   
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
	});
 	function createPagination_upcoming(pageNum){
		$.ajax({
			url: '<?=base_url()?>index.php/tasks/upcoming/'+pageNum,
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
			url: '<?=base_url()?>index.php/tasks/on_going/'+pageNum,
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
			url: '<?=base_url()?>index.php/tasks/completes/'+pageNum,
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
 
    
 
       
      