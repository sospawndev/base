  <div class="row">
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Wheel Played</h5>
                              <h2><?=$wheel?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <!-- -->
                   <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Score Played</h5>
                              <h2><?=$skor?></h2>
                              
                        </div>
                    </div>
                  </div>
                   
                  
  </div> 
  			<div class="row">
                  <div class="col-md-12 col-lg-12">
                      <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Recent 5 Wheel</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                     
                                    <th scope="col">Address </th>
                                    <th scope="col">Wheel </th>
                                    <th scope="col">Date </th>
                                    
                                    <th scope="col">Winner </th>
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
								   	for($i=0;$i<count($arr);$i++)
									{
										
								   ?>
                                   
                                   		<tr>
                                        	<td><?=$arr[$i]['address_wallet']?></td>
                                            <td><?=$arr[$i]['numbers']?></td>
                                            <td><?=$arr[$i]['tanggal']?></td>
                                            <td>
											<?php
											if($arr[$i]['winner']==1)
											{
											?>
                                            	<i class="fa fa-check"></i>
                                            <?php
											}else
											{
											?>
                                            	<i class="fa fa-ban"></i>
                                            <?php
											}
											?>
											</td>
                                        </tr>
                                   <?php
									}
								   ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                      <!-- -->
                      <div class="col-md-12 col-lg-12">
                      <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Recent 5 Score</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                     
                                    <th class="text-left">Match</th>
                                    <th class="text-center">Winner</th>
                                    <th class="text-left">Address</th>
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
								   	for($i=0;$i<count($match);$i++)
									{
										
								   ?>
                                   
                                   		<tr>
                                        	<td class="text-center number" style="width:60%;">
                                                    	<span style="color:black;">
														<?=$match[$i]['team1']['name']?> 
                                                        </span>
                                                        <span style="color:red;">
                                                        (<?=$match[$i]['skor_team1']?>) 
                                                        </span>
                                                        vs 
														<span style="color:black;">
														<?=$match[$i]['team2']['name']?> 
                                                        </span>
                                                        <span style="color:red;">
                                                        (<?=$match[$i]['skor_team2']?>) 
                                                        </span>
														
                                                    </td>
                                                    <td class="text-center number">
                                                    	<span>
														<?php
															if($match[$i]['winner']==1)
															{
																echo '<i class="fa fa-check" aria-hidden="true"></i>';
															}else
															{
																echo "<i class='fa fa-ban' aria-hidden='true'></i>";
															}
														?>	
                                                        </span>
                                                    </td>
                                                    <td><?=$match[$i]['address_wallet']?></td>
                                             
                                        </tr>
                                   <?php
									}
								   ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                      <!-- -->
                  </div>               