<script src="assets/skodash/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<div class="row">
  <div class="col-md-12">
         <div class=" ">
                      <div class=" ">
                        <div class="card radius-10">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <div class="">
                                <p class="mb-1">Task Progress</p>
                                <h3 class="mb-0 text-primary"><?=$task_progress?></h3>
                              </div>
                              <div class="ms-auto fs-2 text-primary">
                                <i class="bx bx-coin"></i>
                              </div>
                            </div>
                            
                             
                          </div>
                        </div>
                       </div>
                       
                       <div class=" ">
                        <div class="card radius-10">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <div class="">
                                <p class="mb-1">Task Complete</p>
                                <h3 class="mb-0 text-primary"><?=$task_complete?></h3>
                              </div>
                              <div class="ms-auto fs-2 text-primary">
                                <i class="fa fa-check"></i>
                              </div>
                            </div>
                            <div class="border-top my-2"></div>
                            
                          </div>
                        </div>
                       </div>
                       
                       <div class=" ">
                        <div class="card radius-10">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <div class="">
                                <p class="mb-1">Task Canceled</p>
                                <h3 class="mb-0 text-primary"><?=$task_cancel?></h3>
                              </div>
                              <div class="ms-auto fs-2 text-danger">
                                <i class="fa fa-remove"></i>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                       </div>
                      
                      
                       <div class=" ">
                        <div class="card radius-10">
                          <div class="card-body">
                            <div class="d-flex align-items-center">
                              <div class="">
                                <p class="mb-1">Task Waiting</p>
                                <h3 class="mb-0 text-primary"><?=$task_wait?></h3>
                              </div>
                              <div class="ms-auto fs-2 text-info">
                                <i class="fa fa-hourglass"></i>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                       </div> 
                      
                       
                       
                     
        </div>               
   </div>
       
</div>   
             
<!-- end row -->
<div class="row">
  		 <div class="col-12 col-lg-12 col-xl-12 d-flex">
             <div class="card radius-10 w-100">
              <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                  <div class="col">
                    <h5 class="mb-0"><?=count($task)?> Last Task</h5>
                  </div>
                  <div class="col">
                    
                  </div>
                 </div>
              </div>
               <div class="card-body">
                 <div class="categories">
                    <table class="table align-middle mb-0 dda">
                        <thead>
                                            <tr>
                                                <th>
                                                Pid
                                                </th>
                                                <th>
                                                Name
                                                </th>
                                                 
                                                 
                                                <th>
                                                Start Date
                                                </th>
                                                <th>
                                                Status
                                                </th>
                                                
                                            </tr>    
                                        </thead>
                                        <tbody>
                                              <?php
											  if(count($task)>0)
											  {
												  for($i=0;$i<count($task);$i++)
												  {
											  ?>
                                              	<tr>
                                                 	<td><?=$task[$i]['pid']?></td>   
                                                 	<td><?=$task[$i]['name']?></td>   
                                                 	<td><?=$task[$i]['start_date']?></td>   
                                                 	<td><?=rewardstatus($task[$i]['status'])?></td>   
                                                 </tr>
                                              <?php
												  }
											  }else
											  {
											  ?>
                                              <tr>
                                              	<td colspan="4" valign="middle" align="center">No Task</td>
                                              </tr>
                                              <?php
											  }
											  ?>
                                        </tbody>
                  </table>
					 
                 </div>
               </div>
             </div>
           </div>
 </div>   
  