							<?php
								$vtiers = tiers();
								 
								if(isset($vtiers['id']))
								{
									if($vtiers['ends']==0)
									{
										$percen = ($vtiers['phase_token']/$vtiers['total_supply'])*100;
							?>
                                         <div class="row xmessage"> 
                                                <div class="col-md-12 text-left">
                                                  <small style="color:yellow;">
                                                     time is extended until the funds are reached the target

                                                  </small>
                                                </div> 
                                                
                                        </div>
                                         <div  id="countdowns"></div><br/>
                                         	
                                         <div class="row"> 
                                                <div class="col-md-6 text-left">
                                                  <small>
                                                  Token sold<br/>
                                                  <?=number_format($vtiers['phase_token'],0)?> 
                                                  </small>
                                                </div> 
                                                <div class="col-md-6 text-right">
                                                    <small>
                                                    Total Token<br/>
                                                    <?=number_format($vtiers['total_supply'],0)?>
                                                    </small>
                                                </div>
                                        </div>	
                                        <br/>
                                        <div class="progress">
                                           <div class="progress-bar" role="progressbar" data-transitiongoal="0" style="width:<?=round($percen,2)?>%;"> </div>
                                        </div>
                                         <div class="row"> 
                                                <div class="col-md-12 text-left">
                                                 <strong style="font-size:26px;"> <?=number_format($vtiers['phase'],0)?></strong> Raised Amount Phase <?=strtoupper(romawi(tier_fase($vtiers['id'])))?><br/>
                                                  <strong style="font-size:26px;"> <?=number_format($vtiers['total_usdt'],0)?></strong> Total Amount All Phase<br/>  
                                                   <strong style="font-size:26px;"> <?=number_format($vtiers['customer'],0)?></strong> Investors<br/>  
                                                </div> 
                                                
                                        </div>
                                         
                                        <a href="https://presale.artsky.cloud" class="btn secondary-btn">PURCHASE TOKEN</a>
                                        
                                        <script>
                                        $(function()
                                        {
											 
                                            countdown_start();
                                        });
                                        </script>
                            
                            <?php
									}else
									{
							?>
                            			<div> 
                                            <div class='alert alert-danger' style='width:100%; color:linear-gradient(135deg, #49138C, #341477); text-align:center; font-weight:bold;'>Private Sale Is closed </div>
                                        </div>
                            <?php			
									}
								}else
								{
							?>
									<div> 
                                    	<div class='alert alert-danger' style='width:100%; color:linear-gradient(135deg, #49138C, #341477); text-align:center; font-weight:bold;'>Private Sale Is closed </div>
                                    </div>
                            <?php
								}
							?>