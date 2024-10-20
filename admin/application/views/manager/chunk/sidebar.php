<?php
$directory = rtrim($this->router->directory,'/');
$class = $this->router->class;
$method = $this->router->method;
$params = $this->uri->segment('3');
$params1 = $this->uri->segment('4');
$ima = user_info('avatar');
$avatar = user_info('avatar');
 

 
?>
 <!--start sidebar -->
       <aside class="sidebar-wrapper">
          <div class="iconmenu"> 
            <div class="nav-toggle-box">
              <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
            </div>
            <ul class="nav nav-pills flex-column">
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-dashboards" type="button"><i class="bi bi-house-door-fill"></i></button>
              </li>
             
               
               <?php
			   /*
               <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Process">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-money" type="button"><i class="bx bx-money"></i></button>
              </li>
              */
			  ?>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Task">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-task" type="button"><i class="bx bx-book"></i></button>
              </li> 
			  <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Vote">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-vote" type="button"><i class="bx bx-upvote"></i></button>
              </li>
               <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="customer and Admin">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-admin" type="button"><i class="bx bx-user"></i></button>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Level">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-level" type="button"><i class="bx bx-building"></i></button>
              </li>
               <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Setting">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-setting" type="button"><i class="bx bx-cog"></i></button>
              </li>
              </li>
            </ul>
          </div>
          <div class="textmenu">
            <div class="brand-logo">
              <!--
              <img src="assets/skodash/logo.png" width=" " alt="" height="50"/>
              -->              
              <img src="<?=config_item('main_site')?>/uploads/<?=settings('logo')?>" width=" " alt="" height="50"/>
            </div>
            <div class="tab-content">
               <?php
				$active = "";
				$active_page = "";
				if($class=="home")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-dashboards">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Dashboards</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  
                  <a href="<?=site_url('home')?>" class="list-group-item"><i class="bi bi-house"></i>Home</a>
                   
                </div>
              </div>
              
               
              <?php
				$active = "";
				$active_page = "";
				if($class=="topup" || $class=="withdraw" || $class=="transfer" || $class=="buy")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-money">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Process</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  
                  <a href="<?=site_url('topup')?>" class="list-group-item"><i class="bx bx-money"></i> Top Up</a>
                  <a href="<?=site_url('withdraw')?>" class="list-group-item"><i class="bx bx-money"></i> Withdraw</a>
                  <a href="<?=site_url('transfer')?>" class="list-group-item"><i class="bx bx-money"></i> Transfer</a>
                  <a href="<?=site_url('buy')?>" class="list-group-item"><i class="bx bx-money"></i> Buying</a>
                  <a href="<?=site_url('buy-ref')?>" class="list-group-item"><i class="bx bx-money"></i> Refferal Reward</a>   
                </div>
              </div> 
               <?php
				$active = "";
				$active_page = "";
				if($class=="task_type" || $class=="task_payment" || $class=="tasks" || $class=="task_reward" || $class=="refferal_reward")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-task">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Task</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  
                  <a href="<?=site_url('task-type')?>" class="list-group-item"><i class="bx bx-book"></i> Type</a>
                  <a href="<?=site_url('task-payment')?>" class="list-group-item"><i class="bx bx-book"></i> Price</a>
                  <a href="<?=site_url('tasks')?>" class="list-group-item"><i class="bx bx-book"></i> Task (<?=task_read()?>)</a>
                  <a href="<?=site_url('task-reward')?>" class="list-group-item"><i class="bx bx-money"></i> Reward (<?=task_reward()?>)</a>
                  <?php
				  /*
                  <a href="<?=site_url('refferal-reward')?>" class="list-group-item"><i class="bx bx-user"></i> Refferal Reward  </a>
				  */
				  ?>
                </div>
              </div> 
              <?php
			  #======= vote
			  ?>
              <?php
				$active = "";
				$active_page = "";
				if($class=="vote" || $class=="vote_option" || $class=="vote_reward" || $class=="vote_category")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-vote">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Vote</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  
                  <a href="<?=site_url('votes/vote-category')?>" class="list-group-item"><i class="bx bx-book"></i> Category</a>
                  <a href="<?=site_url('votes/vote')?>" class="list-group-item"><i class="bx bx-book"></i> Vote</a>
                  <a href="<?=site_url('votes/vote-reward')?>" class="list-group-item"><i class="bx bx-book"></i> Reward</a>
                </div>
              </div> 
               <?php
				$active = "";
				$active_page = "";
				if($class=="level_earn")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-level">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Level</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  <a href="<?=site_url('level-earn')?>" class="list-group-item"><i class="bi bi-building"></i>Level</a>
                 
                   
                </div>
              </div> 
              <?php
				$active = "";
				$active_page = "";
				if($class=="users" || $class=="customer")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-admin">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Users</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  <a href="<?=site_url('customer')?>" class="list-group-item"><i class="bi bi-people"></i>Customer</a>
                  <a href="<?=site_url('clients')?>" class="list-group-item"><i class="bi bi-people"></i>Clients</a> 
                  <a href="<?=site_url('users')?>" class="list-group-item"><i class="bi bi-people"></i>Admin</a>
                   
                </div>
              </div> 
              
              <?php
				$active = "";
				$active_page = "";
				if($class=="packages" || $class=="currency"   || $class=="setting" || $class=="language" || $class=="promo" || $class=="static_text" || $class=="deduction" || $class=="bank" || $class=="bank_transfer" || $class=="bisnis_type" || $class=="occupation" || $class=="education_level"   )
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-setting">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Setting</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  <a href="<?=site_url('bisnis-type')?>" class="list-group-item"><i class="bx bx-money"></i> What kind of business</a>
                   <a href="<?=site_url('occupation')?>" class="list-group-item"><i class="bx bx-money"></i> Occupation</a>
                  <a href="<?=site_url('education-level')?>" class="list-group-item"><i class="bx bx-money"></i> Education Level</a> 
                  <a href="<?=site_url('deduction')?>" class="list-group-item"><i class="bx bx-money"></i> Deduction</a>
                  <a href="<?=site_url('packages')?>" class="list-group-item"><i class="bx bx-box"></i> Package</a>
                  
                  <a href="<?=site_url('static-text')?>" class="list-group-item"><i class="bx bx-cog"></i>Text Language</a>
                  <a href="<?=site_url('promo')?>" class="list-group-item"><i class="bx bx-cog"></i>Promo</a> 
                  <a href="<?=site_url('currency')?>" class="list-group-item"><i class="bx bx-cog"></i>Currency</a> 
                  <a href="<?=site_url('language')?>" class="list-group-item"><i class="bx bx-cog"></i>Language</a>
                  <a href="<?=site_url('setting')?>" class="list-group-item"><i class="bx bx-cog"></i>Setting</a>
                  <a href="<?=site_url('bank')?>" class="list-group-item"><i class="bx bx-cog"></i>Bank</a>
                  <a href="<?=site_url('bank-transfer')?>" class="list-group-item"><i class="bx bx-cog"></i>Rekening Bank</a>
                   
                </div>
              </div> 
              
                
              
               
              
              
                
            </div>
          </div>
       </aside>
       <!--start sidebar -->
       