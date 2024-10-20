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
             
               <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Token">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-buy" type="button"><i class="bx bx-coin-stack"></i></button>
              </li>
               <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="profile">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"><i class="bx bx-user"></i></button>
              </li>
               
              
              
              </li>
            </ul>
          </div>
          <div class="textmenu">
            <div class="brand-logo">
              <img src="<?=config_item('main_site')?>uploads/<?=setting('logo')?>" width=" " alt="" height="50"/>
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
				if($class=="tasks")
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-buy">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Task</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  <a href="<?=site_url('tasks/add')?>" class="list-group-item"><i class="bx bx-data"></i>Create Task</a>
                  <a href="<?=site_url('tasks')?>" class="list-group-item"><i class="bx bx-data"></i>List</a>
                  <a href="<?=site_url('tasks/customer')?>" class="list-group-item"><i class="bx bx-data"></i>Customer Activity</a>
                  
                </div>
              </div>
              <?php
				$active = "";
				$active_page = "";
				if(($class=="users" && $method=="profile") || $class=="refferal" )
				{
					$active = "active show";	
					$active_page = "active-page";
				}
			   ?>
              <div class="tab-pane fade <?=$active?>" id="pills-profile">
                <div class="list-group list-group-flush">
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-0">Profile</h5>
                    </div>
                    <small class="mb-0"></small>
                  </div>
                  <a href="<?=site_url('profile')?>" class="list-group-item"><i class="bx bx-data"></i>My Profile</a>
                   
                  
                </div>
              </div>
              
               
              
              
                
            </div>
          </div>
       </aside>
       <!--start sidebar -->
       