  <div class="row">
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                              <h2><?=$users?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <!-- -->
                   <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Order</h5>
                              <h2><?=$order?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Token Terbeli</h5>
                              <h2><?=number_format($total_token['total'])?></h2>
                              
                        </div>
                    </div>
                  </div>
                   <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">USDT Terkumpul</h5>
                              <h2><?=number_format($total_usdt['total'])?></h2>
                              
                        </div>
                    </div>
                  </div>
                  
  </div> 
  			<div class="row">
                  <div class="col-md-12 col-lg-12">
                      <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Recent 10 order</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No Order</th>
                                    <th scope="col">Customer </th>
                                    <th scope="col">Symbol </th>
                                    <th scope="col">Usdt </th>
                                    
                                    <th scope="col">Tier </th>
                                    <th scope="col">Status </th> 
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
								   	for($i=0;$i<count($arr);$i++)
									{
										
								   ?>
                                   
                                   		<tr>
                                        	<td><?=$arr[$i]['pid']?></td>
                                            <td><?=$arr[$i]['customer']?></td>
                                            <td><?=$arr[$i]['simbol']?></td>
                                            <td><?=$arr[$i]['usdt']?></td>
                                            <td><?=$arr[$i]['tiers']?></td>
                                            <td>
                                            	<strong>
											<?php
												 echo payments($arr[$i]['status']);
											?>
                                            	</strong>
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
                  </div>               