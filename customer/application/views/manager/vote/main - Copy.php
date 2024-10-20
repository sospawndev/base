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
                         
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tabtipe_upcoming" aria-expanded="true">Upcoming</a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tabtipe_ongoing" aria-expanded="false">On Going</a>
                         <a class="font-13 rounded-m shadow-bg shadow-bg-s" data-bs-toggle="collapse" href="#tabtipe_completed" aria-expanded="false">Completed</a>
                        
                        
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                       
                        <div class="collapse show coltab" id="tabtipe_upcoming" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div class="row">
                                <?php
								for($i=0;$i<10;$i++)
								{
								?>  
                                  <!-- -->
                                  <div class="col-md-6">
                                    <!--  -->
                                     <div class="card card-style">
                                        <div class="content padding-0 margin-0" >
                                                <div class="row padding-0 margin-0">
                                                    <div class="col-md-12 padding-0 margin-0" >
                                                        <div class="card  card-style  padding-0 margin-0" style="min-height:150px;">
                                                           <div class="card-body padding-0 margin-0 card-task">
                                                              
                                                               <h1 class="text-center h-task">
                                                                    Dapatkan Reward Sebesar 10.000 IDR
                                                               </h1>
                                                                <img src="<?=config_item('main_site')?>uploads/03.jpg" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark">Download Apps</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- 10/100</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-10"> <b>12-03-2023</b></p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                                <h1 class="text-left">
                                                                    Task 1
                                                               </h1>
                                                             </div>
                                                        </div>
                                                    </div>     
                                                </div>
                                        </div>
                                     </div>   
                                  <!-- -->
                                  </div>
                                  <!-- -->
                                   <?php
										}
									?>
                                </div>  
                            <!-- -->
                           
                        </div>     
                        <!-- Tab Group ongoing -->
                         <div class="collapse coltab" id="tabtipe_ongoing" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div class="row">
                                <?php
								for($i=0;$i<10;$i++)
								{
								?>  
                                  <!-- -->
                                  <div class="col-md-6">
                                    <!--  -->
                                     <div class="card card-style">
                                        <div class="content padding-0 margin-0" >
                                                <div class="row padding-0 margin-0">
                                                    <div class="col-md-12 padding-0 margin-0" >
                                                        <div class="card card-style  padding-0 margin-0" style="min-height:150px;">
                                                           <div class="card-body padding-0 margin-0 card-task">
                                                              
                                                               <h1 class="text-center h-task">
                                                                    Dapatkan Reward Sebesar 10.000 IDR
                                                               </h1>
                                                                <img src="<?=config_item('main_site')?>uploads/03.jpg" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                     <div class="align-self-center">
                                                                         <span class="color-red-dark">Download Apps</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- 10/100</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-15">On Going</p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                                <h1 class="text-left">
                                                                    Task 1
                                                               </h1>
                                                             </div>
                                                        </div>
                                                    </div>     
                                                </div>
                                        </div>
                                     </div>   
                                  <!-- -->
                                  </div>
                                  <!-- -->
                                   <?php
										}
									?>
                                </div>  
                            <!-- -->
                           
                        </div>     
                        
                        <!-- -->
                        <!-- Tab Group ongoing -->
                         <div class="collapse coltab" id="tabtipe_completed" data-bs-parent="#tab-group-2">
                            <!-- -->
                            <div class="row">
                                <?php
								for($i=0;$i<10;$i++)
								{
								?>  
                                  <!-- -->
                                  <div class="col-md-6">
                                    <!--  -->
                                     <div class="card card-style">
                                        <div class="content padding-0 margin-0" >
                                                <div class="row padding-0 margin-0">
                                                    <div class="col-md-12 padding-0 margin-0" >
                                                        <div class="card card-style  padding-0 margin-0" style="min-height:150px;">
                                                           <div class="card-body padding-0 margin-0 card-task">
                                                              
                                                               <h1 class="text-center h-task">
                                                                    Dapatkan Reward Sebesar 10.000 IDR
                                                               </h1>
                                                                <img src="<?=config_item('main_site')?>uploads/03.jpg" alt="img" width="100%" height="370"   class="mx-auto  shadow-l">
                                                                    
                                                            </div>    
                                                             <div class="card-body  card-task" style="min-height:100px;">
                                                                <div class=" d-flex">
                                                                    <!-- -->
                                                                    <div class="align-self-center">
                                                                         <span class="color-red-dark">Download Apps</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ps-1 text-center">
                                                                         <span class="color-black ">- 10/100</span> 
                                                                          
                                                                     </div>
                                                                     <div class="align-self-center ms-auto text-end">
                                                                         <p class="mb-0 font-15">Completed</p>
                                                                     </div>
                                                                    <!-- -->
                                                                </div>
                                                                <h1 class="text-left">
                                                                    Task 1
                                                               </h1>
                                                             </div>
                                                        </div>
                                                    </div>     
                                                </div>
                                        </div>
                                     </div>   
                                  <!-- -->
                                  </div>
                                  <!-- -->
                                   <?php
										}
									?>
                                </div>  
                            <!-- -->
                           
                        </div>     
                        
                        <!-- -->
                    </div>
                 <!-- -->
            </div>
        </div>
        
        

 
    
 
       
      