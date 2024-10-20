<script>
function pageo(ids)
{
	$("#menu-list").html("");
	//	document.location.href = "<?=base_url()?>rewards/viewc/"+ ids; 	
	var req = get('<?=site_url('rewards/getview')?>',{id_customer:ids});
			req.done(function(out){
				if(!out.error)
				{
					$("#menu-list").html(out.temp);
					var myOffcanvas = document.getElementById('menu-list')
					//$("#testc").click();
					var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
    				bsOffcanvas.show();
				}
				else
				{
					 
				}
	});
	return false;
}
function pagetree(ids)
{
	$("#menu-tree-list").html("");
	//	document.location.href = "<?=base_url()?>rewards/viewc/"+ ids; 	
	var req = get('<?=site_url('jtree/gettree')?>',{id_customer:ids});
			req.done(function(out){
				if(!out.error)
				{
					$("#menu-tree-list").html(out.temp);
					var myOffcanvas = document.getElementById('menu-tree-list')
					//$("#testc").click();
					var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
    				bsOffcanvas.show();
				}
				else
				{
					 
				}
	});
	return false;
}
</script>
<style type="text/css">
 
#qrcodes img
{
	text-align:center;
	 	
}
 
@media only screen and (max-width: 600px) {
    #qrcodes img
	{
		text-align:center;
		padding-left: 0;
		margin-left:-40px;	
	}
}
</style>
<?php
$avatar = "assets/images/pictures/31t.jpg";
if(!empty(user_info('avatar')))
{
	$avatar = "uploads/".user_info('avatar');
}
?>
<a href="javascript:void(0);" id="testc" class="list-group-item xhide" data-bs-toggle="offcanvas" data-bs-target="#menu-list">
                        Click
                    </a>
<div class="card card-style bg-white ">
	<div class="content">		
        
        <div class="row">
        	<div class="col-12" >
            	<center>
        			 <div id="qrcodes" style="width:400px; background:"></div>
               </center>     
               <hr/>
            </div>
            <div class="col-12">
            		 <div class="form-group">
                                 
                                <div class="input-group "> 
                                	<span class="input-group-text"><i class="bi bi-link"></i></span>
									<input type="text" class="form-control" aria-label="Reffreal" id="refinput" readonly="readonly" value="<?=site_url('register/views/'."A-".user_balance('pid'))?>"> 
                                     <span class="input-group-text" onclick="javascript:CopyToClipboard('refinput');" style="cursor:pointer;"><i class="fa fa-copy"></i></span>
								</div>
                               
                                
                                
                              </div>
            </div>
       </div>      
        <hr/>
        <div class="row">
        	 
            <div class="col-6">
            	<h4 class="text-center alert alert-primary" style="background-color:#4A89DC;">
               <?=count($arr_ref)?>  <br/> <?=custom_language("Number Direct Referral")?>
                </h4>
            </div>
            <div class="col-6">
            	<h4  class="text-center alert alert-primary" style="background-color:#4A89DC;">
                <?=$cinfo?> <br/> <?=custom_language("Number Team Info")?>
                </h4>
            </div>
            
        </div>  
        <div class="row">
        	<div class="col-12">
            	<a href="javascript:void(0);" onclick="javascript:pagetree(<?=user_info('id')?>);" class="btn btn-full gradient-highlight shadow-bg shadow-bg-s mt-4"><?=custom_language("View Refferal")?></a>
            </div>
        </div>  
       
   </div>        
</div>

<div class="card card-style">
            <div class="content">
                <div class="tabs tabs-pill" id="tab-group-2">
                    <div class="tab-controls rounded-m p-1 overflow-visible">
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-topup tabsb" data-bs-toggle="collapse" href="#tab-team" aria-expanded="true"><?=custom_language("Team Info")?></a>
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-tf tabsb" data-bs-toggle="collapse" href="#tab-earn" aria-expanded="false"><?=custom_language("Reward Earning")?></a>
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                    <div class="collapse show coltab" id="tab-team" data-bs-parent="#tab-group-2">
                        
                         <table class="table">
                        	<thead>
                            	<tr>
                                	<th><?=custom_language("User Id")?></th>
                                	<th><?=custom_language("Perfomance")?></th>
                                	<th><?=custom_language("Perfomance Under Umbrella")?></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
								for($i=0;$i<count($arr_ref);$i++)
								{
									 
								?>
                            	
                                <tr class="reffs" onclick="javascript:pageo(<?=$arr_ref[$i]['id']?>);" style="cursor:pointer;">

                                    <td>A-<?=$arr_ref[$i]['pid']?></td>
                                	<td><?=number_format($arr_ref[$i]['buy_coin'],2)?> <?=setting('coin_name')?></td>
                                	<td><?=ref_count($arr_ref[$i]['id'])?></td>
                                    
                                </tr>
								
                                <?php
								}
								?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tab Group 2 -->
                    <div class="collapse coltab" id="tab-earn" data-bs-parent="#tab-group-2">
                       
                         <table class="table">
                        	<thead>
                            	<tr>
                                	<th style="width:25%;"><?=custom_language("Order Id")?></th>
                                	<th style="width:15%;"><?=custom_language("Level")?></th>
                                	<th style="width:25%;"><?=custom_language("Date")?>(%)</th>
                                    <th><?=custom_language("Percentage")?>(%)</th>
                                    <th><?=custom_language("Amount")?></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
								for($i=0;$i<count($earnsv);$i++)
								{
									$levels = user_level(my_level($earnsv[$i]['id_customer']));
									$us = json_decode($earnsv[$i]['level_earn_info'],true);
									if(isset($us['level']))
									{
								?>
                            	<tr >
                                	<td class="text-left" >
									<?=$earnsv[$i]['pid']?>
                                     
                                    </td>
                                    <td  class="text-left"><?=$us['level']?></td>
                                	<td class="text-left" ><?=date('Y-m-d H:i',strtotime($earnsv[$i]['tanggal']))?></td>
                                	<td class="text-left"><?=number_format($earnsv[$i]['ref_reward'],2)?></td>
                                    <td class="text-left">$<?=number_format($earnsv[$i]['total'],2)?></td>
                                </tr>
                                <?php
									}
								}
								?>
                            </tbody>
                        </table>
                        
						  
                    </div>
                   
                    <!-- -->
                     
                      
                    <!-- -->
                </div>
            </div>
        </div>
        
        


    </div>       
 <script>
   $(function()
	{
    	new QRCode(document.getElementById("qrcodes"), '<?=user_balance('pid')?>');
	});
	
 </script> 
       
       
       
       
      