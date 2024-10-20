							<?php
								$vars = template_closed_phase();
								$vtiers = tiers();
								if(isset($vtiers['id']))
								{
									if($vtiers['ends']==0)
									{
										$percen = ($vtiers['phase_token']/$vtiers['total_supply'])*100;
										$starts = strtotime($vtiers['start_date']);
										$timenow = strtotime(date('Y-m-d H:i:s'));
										$ends = strtotime($vtiers['end_date']);
										if((round($percen,2)<100) && (($timenow>=$starts) && ($timenow<=$ends)))
										{
							?>
                                       
                                         
                                        <div class="timer-wrap">
                                            <div id="timer" class="timer"></div>
                                            <div class="timer__titles">
                                                <div>Days</div>
                                                <div>Hours</div>
                                                <div>Minutes</div>
                                                <div>Seconds</div>
                                            </div>
                                        </div> 
                                        <!-- -->
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
                                                 <strong > <?=number_format($vtiers['phase'],0)?></strong> Raised Amount <?=$vtiers['name']?><br/>
                                                  <strong > <?=number_format($vtiers['total_usdt'],0)?></strong> Total Amount All Phase<br/>  
                                                   <strong > <?=number_format($vtiers['customer'],0)?></strong> Investors<br/>  
                                                </div> 
                                                
                                        </div>
                                         
                                        
                                        <!-- edits --> 	
                                          
                                        <script>
                                        $(function()
                                        {
											 
                                            //var date = new Date(2019, 3, 5, 0, 0, 0, 0);
											var date = new Date('<?=$vtiers['end_date']?>');
											console.log(date);
											var now = new Date();
											var diff = (date.getTime()/1000) - (now.getTime()/1000);
										
											var clock = $('.timer').FlipClock(diff,{
												clockFace: 'DailyCounter',
												countdown: true
											}); 
                                        });
                                        </script>
                            <?php
										}else
										{
											//echo $vars;	
										}
									}else
									{
							 		  //echo $vars;
									}
								}else
								{
							 		//echo $vars;
								}
							?>
							 