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
        	 
            <div class="col-12">
            	<h4 class="text-center alert alert-primary" style="background-color:#4A89DC;">
               <?=count($ref)?>  <br/> <?=custom_language("Number  Referral")?>
                </h4>
            </div>
            
            
        </div>  
        
       
   </div>        
</div>

<div class="card card-style">
            <div class="content">
                <div class="tabs tabs-pill" id="tab-group-2">
                    <div class="tab-controls rounded-m p-1 overflow-visible">
                        <a class="font-13 rounded-m shadow-bg shadow-bg-s tab-topup tabsb" data-bs-toggle="collapse" href="#tab-team" aria-expanded="true"><?=custom_language("Refferal")?></a>
                        
                       
                    </div>
                    <div class="mt-3"></div>
                    <!-- Tab Group 1 -->
                    <div class="collapse show coltab" id="tab-team" data-bs-parent="#tab-group-2">
                        
                         <table class="table table-bordered">
                        	<thead>
                            	<tr>
                                	<th><?=custom_language("User Id")?></th>
                                    <th><?=custom_language("Reward")?></th>
                                	 
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
								for($i=0;$i<count($ref);$i++)
								{
									 
								?>
                            	
                                <tr>

                                    <td>A-<?=$ref[$i]['pid']?></td>
                                	<td><?=number_format($ref[$i]['reward'],0)?></td> 
                                    
                                </tr>
								
                                <?php
								}
								?>
                            </tbody>
                        </table>
                    </div>
                     
                     
                      
                    <!-- -->
                </div>
            </div>
        </div>
        
        


    </div>       
  
  <style type="text/css">
  	.coltab table td, .coltab table th
	{
		color:black;			
	}
  </style>     
       
       
       
      