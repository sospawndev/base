
        <div style="width:100vw">
             
             			<div class="pt-3">
                           <div class="page-title d-flex">
                               <div class="align-self-center">
                                   <a href="#"
                                   data-bs-dismiss="offcanvas"
                                   id="backprofile"
                                   class="me-3 ms-0 icon icon-xxs bg-theme rounded-s shadow-m">
                                       <i class="bi bi-chevron-left color-theme font-14"></i>
                                   </a>
                               </div>
                               <div class="text-center me-auto" style="width:80%;">
                                   <center><h1 class="color-theme mb-0 font-18"><?=custom_language('Detail Info')?></h1></center>
                               </div>
                               <div class="align-self-center ms-auto">
                                   <a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-sidebar"
                                   class="icon icon-xxs gradient-highlight color-white shadow-bg shadow-bg-xs rounded-s">
                                       <i class="bi bi-list font-20"></i>
                                   </a>
                               </div>
                           </div>
                       </div>
                       <div class="content mt-0">
                            <!-- -->
                            	<?php
								if(count($arr)>0)
								{
									for($i=0;$i<count($arr);$i++)
									{
										if(!empty($arr[$i]['customer_info']))
										{
											$customer_info = json_decode($arr[$i]['customer_info'],true);
										  if(isset($customer_info['id']))
										  {	
								?>
                                        <div class="row">
                                            <div class="col-4">
                                                <strong><?=custom_language('Order Id')?></strong><br/>
                                                <b class="color-black"><?=$arr[$i]['pid']?></b>
                                            </div>
                                            <div class="col-4">
                                                <strong><?=custom_language('User Id')?></strong><br/>
                                                <b class="color-black">A-<?=get_pid_cust($arr[$i]['id_customer'])?></b>
                                                
                                            </div>
                                            <div class="col-4">
                                                <strong><?=custom_language('Settlement Date')?></strong><br/>
                                                <b class="color-black"><?=date('Y-m-d',strtotime($arr[$i]['tanggal']))?></b>
                                                 
                                            </div>
                                            
                                            <!-- -->
                                            <div class="col-4">
                                                <strong><?=custom_language('Order Cost')?></strong><br/>
                                                <b class="color-black">$<?=number_format($arr[$i]['total'],2)?></b>
                                            </div>
                                            <div class="col-4">
                                                <strong><?=custom_language('Amount Reward')?></strong><br/>
                                                <b class="color-black">$<?=number_format($arr[$i]['ref_total'],2)?></b>
                                                
                                            </div>
                                            <div class="col-4">
                                                <strong><?=custom_language('User Information')?></strong><br/>
                                                <b class="color-black"><?=$customer_info['email']?></b>
                                                 
                                            </div>
                                            
                                        </div>
                                        <hr/>
                                <?php
										  }
										}
									}
								}
								?>
                            <!-- -->
                            
                            
                       </div>
                       
                    </div>
                   