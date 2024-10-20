<?php
$phone_verification = user_balance('phone_verification'); 
?>
	<!-- Page Title-->
        <div class="pt-3">
            <div class="page-title d-flex">
                <div class="align-self-center me-auto">
                    <p class="color-black opacity-80 header-date">
                    	
                    </p>
                    <h4 class="color-black">
					
						<?=custom_language('Welcome')?> 
						 
						<?=user_info("name")?> 
                        
                    
                    </h4>
                   <p class="color-black-light font-18">
             
                    <i class="bi bi-vector-pen "></i>  Your Vote <span class="color-green-light"><?=user_balance('votes')?></span> 
                    
                   </p>  
                   
                   <p class="color-yellow-light font-18">
             
                     <!-- <i class="bi bi-check-circle-fill "></i>  -->
                     <?php
				   	if($phone_verification==1)
					{
				   ?>
                      <i class="color-green-light bi bi-check-circle-fill "></i>
                    <?php
					}else
					{
					?>
                    <i class="color-red-light fa fa-ban "></i>
                    <?php
					}
					?>  
                      A-<?=user_balance('pid')?> 
                    
                   </p> 
                   
                    <p class="color-green-light">
                    	<?php
							/*
							$info = "";
							
							if(!empty(user_balance('level_earn_info')))
							{
								$text_level = json_decode(user_balance('level_earn_info'),true);
								 
								if(isset($text_level['id']))
								{
									$split = explode(" ",$text_level['level']);
									 
									$angka_info = get_level_css(strtolower($split[0]));
									if($angka_info>0)
									{
										$diamond = "";
										for($i=1;$i<=$angka_info;$i++)
										{
											$diamond .= "<i class='fa fa-diamond '></i>";
										}
							?>
										 <?=$diamond?> <?=(isset($split[1]) && isset($split[2]))? $split[1]." ".$split[2]:"";?>
							<?
									}else
									{
							?>
										<b> <?=$text_level['level']?> </b>
							<?php			
									}
								}
							}*/
							if(!empty(user_balance('level_users')) && (user_balance('buy_coin')>0))
							{
								$text_level = user_level(my_level(user_info('id')));//user_level(user_balance('level_users'));
								if(isset($text_level['id']))
								{
									$split = explode(" ",$text_level['level']);
									 
									//$angka_info = get_level_css(strtolower($split[0]));
									$angka_info = preg_replace("/[^0-9.]/", "", $text_level['level']);
									if($angka_info>0)
									{
										$diamond = "";
										for($i=1;$i<=$angka_info;$i++)
										{
											$diamond .= "<i class='fa fa-diamond '></i> ";
										}
							?>
										 <?=$diamond?> <?=(isset($split[1]) )? $split[1]:"";?>
							<?
									}else
									{
							?>
										<b> <?=$text_level['level']?> </b>
							<?php			
									}
								}
							}
							
						   ?>
                    </p>
                </div>
                <div class="align-self-center ms-auto">
                   
                     <!-- -->
                     <?php
					 /*
                     <a href="#" data-bs-toggle="dropdown" class="icon rounded-m shadow-xl">
                         <?php
						 	$img_default = "english.png";
							$carr = get_langs();
							if(isset($carr['id']))
							{
								$img_default = $carr['image'];	
							}
						 ?>
                         <span class="language"><img src="<?=config_item('main_site')?>uploads/<?=$img_default?>" width="25" class="rounded-m" alt="img"></span>
                    </a>
					*/
					?>
                    <!-- Page Title Dropdown Menu-->
                    <div class="dropdown-menu">
                        <div class="card card-style shadow-m mt-1 me-1">
                            <div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
                                
                                <?php
								$langs = arr_lang();
								for($i=0;$i<count($langs);$i++)
								{
								?>
                                <a href="<?=site_url('language/ret/'.$langs[$i]['id'])?>" class="list-group-item">
                                    <img src="<?=config_item('main_site')?>uploads/<?=$langs[$i]['image']?>" width="25" class="rounded-m" alt="img">
                                    
                                    <strong class="font-13" style="padding-left:5px;"> <?=$langs[$i]['name']?> </strong>
                                </a>
                                <?php
								}
								?>
                                
                            </div>
                        </div>
                    </div>
                    <!-- -->
                    <!--
                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-notifications" class="icon bg-white color-theme rounded-m shadow-xl">
                        <i class="bi bi-bell-fill color-black font-17"></i>
                        <em class="badge bg-red-light color-white scale-box">3</em>
                    </a>
                   -->
                    <a href="#" data-bs-toggle="dropdown" class="icon rounded-m shadow-xl">
                        <img src="<?=config_item('main_site')?>uploads/<?=setting('favicon')?>" width="45" class="rounded-m" alt="img">
                    </a>
                    <!-- Page Title Dropdown Menu-->
                    <div class="dropdown-menu">
                        <div class="card card-style shadow-m mt-1 me-1">
                            <div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
                                
                                <a href="profile.html" class="list-group-item">
                                    <i class="has-bg gradient-yellow shadow-bg shadow-bg-xs color-white rounded-xs bi bi-person-circle"></i>
                                    <strong class="font-13"><?=custom_language('Account')?></strong>
                                </a>
                                <a href="<?=site_url('logout')?>" class="list-group-item">
                                    <i class="has-bg gradient-red shadow-bg shadow-bg-xs color-white rounded-xs bi bi-power"></i>
                                    <strong class="font-13"><?=custom_language('Log Out')?></strong>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <?php
		/*
        <svg id="header-deco" viewBox="0 0 1440 600" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150">
            <path id="header-deco-1" d="M 0,600 C 0,600 0,120 0,120 C 92.36363636363635,133.79904306220095 184.7272727272727,147.59808612440193 287,148 C 389.2727272727273,148.40191387559807 501.4545454545455,135.40669856459328 592,129 C 682.5454545454545,122.5933014354067 751.4545454545455,122.77511961722489 848,115 C 944.5454545454545,107.22488038277511 1068.7272727272727,91.49282296650718 1172,91 C 1275.2727272727273,90.50717703349282 1357.6363636363635,105.25358851674642 1440,120 C 1440,120 1440,600 1440,600 Z"></path>
            <path id="header-deco-2" d="M 0,600 C 0,600 0,240 0,240 C 98.97607655502392,258.2105263157895 197.95215311004785,276.4210526315789 278,282 C 358.04784688995215,287.5789473684211 419.16746411483257,280.5263157894737 524,265 C 628.8325358851674,249.4736842105263 777.377990430622,225.47368421052633 888,211 C 998.622009569378,196.52631578947367 1071.3205741626793,191.57894736842107 1157,198 C 1242.6794258373207,204.42105263157893 1341.3397129186603,222.21052631578948 1440,240 C 1440,240 1440,600 1440,600 Z"></path>
            <path id="header-deco-3" d="M 0,600 C 0,600 0,360 0,360 C 65.43540669856458,339.55023923444975 130.87081339712915,319.1004784688995 245,321 C 359.12918660287085,322.8995215311005 521.9521531100479,347.1483253588517 616,352 C 710.0478468899521,356.8516746411483 735.3205741626795,342.3062200956938 822,333 C 908.6794258373205,323.6937799043062 1056.7655502392345,319.62679425837325 1170,325 C 1283.2344497607655,330.37320574162675 1361.6172248803828,345.1866028708134 1440,360 C 1440,360 1440,600 1440,600 Z"></path>
            <path id="header-deco-4" d="M 0,600 C 0,600 0,480 0,480 C 70.90909090909093,494.91866028708137 141.81818181818187,509.8373205741627 239,499 C 336.18181818181813,488.1626794258373 459.6363636363636,451.5693779904306 567,446 C 674.3636363636364,440.4306220095694 765.6363636363636,465.88516746411483 862,465 C 958.3636363636364,464.11483253588517 1059.8181818181818,436.8899521531101 1157,435 C 1254.1818181818182,433.1100478468899 1347.090909090909,456.555023923445 1440,480 C 1440,480 1440,600 1440,600 Z"></path>
        </svg>
		*/
		?>