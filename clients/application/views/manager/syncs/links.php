							<?php
								$vars = '<a href="'.site_url("home").'" target="_blank" class="btn-sign-in alert alert-danger" style=""><b>Presale Close</b></a>	';
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
                                         	<a href="<?=site_url("home")?>" class="btn-sign-in" target="_blank">Presale Open !</a>	
                            <?php
										}else
										{
											echo $vars;	
										}
									}else
									{
							 		  echo $vars;
									}
								}else
								{
							 		echo $vars;
								}
							?>
							 