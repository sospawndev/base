<?php
$ima = user_info('avatar');
$avatar = "uploads/default.png";
if(!empty($ima))
$avatar = config_item("main_site")."uploads/".user_info('avatar');
?>
	<!--start top header-->
    <header class="top-header">        
      <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
          </div>
          <div class="top-navbar d-none d-xl-block">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item">
            <a class="nav-link" href="<?=site_url('home')?>">Dashboard</a>
            </li>
            
           
           
          </ul>
          </div>
          <div class="search-toggle-icon d-xl-none ms-auto">
            
          </div>
          <form class="searchbar d-none d-xl-flex ms-auto">
              
          </form>
          <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-1">
                  <img src="<?=$avatar?>" class="user-img" alt="">
                  <div class="user-name d-none d-sm-block"> <?=strtoupper(user_info("company_name"))?></div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                   <a class="dropdown-item" href="<?=site_url("profile")?>">
                     <div class="d-flex align-items-center">
                        <img src="<?=$avatar?>" alt="" class="rounded-circle" width="60" height="60">
                        <div class="ms-3">
                          <h6 class="mb-0 dropdown-user-name"><?=strtoupper(user_info("company_name"))?></h6>
                          
                        </div>
                     </div>
                   </a>
                 </li>
                 <li><hr class="dropdown-divider"></li>
                 <li>
                    <a class="dropdown-item" href="<?=site_url("profile")?>">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                         <div class="setting-text ms-3"><span>Profile</span></div>
                       </div>
                     </a>
                  </li>
                  
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <a class="dropdown-item" href="<?=site_url("logout")?>">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                         <div class="setting-text ms-3"><span>Logout</span></div>
                       </div>
                     </a>
                  </li>
              </ul>
            </li>
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="projects">
                  <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                 <div class="row row-cols-2 gx-2">
                    <!-- -->
                    <div class="col">
                              <a href="<?=site_url('tasks')?>">
                              <div class="apps p-2 radius-10 text-center">
                                 <div class="apps-icon-box mb-1 text-white  bg-primary">
                                   <i class="bx bx-data"></i>
                                 </div>
                                 <p class="mb-0 apps-name">Task List</p>
                              </div>
                            </a>
                     </div>
                     <div class="col">
                              <a href="<?=site_url('tasks/add')?>">
                              <div class="apps p-2 radius-10 text-center">
                                 <div class="apps-icon-box mb-1 text-white  bg-success">
                                   <i class="fa fa-file"></i>
                                 </div>
                                 <p class="mb-0 apps-name">Create Task</p>
                              </div>
                            </a>
                     </div>
                     <div class="col">
                              <a href="<?=site_url('tasks/customer')?>">
                              <div class="apps p-2 radius-10 text-center">
                                 <div class="apps-icon-box mb-1 text-white  bg-danger">
                                   <i class="fa fa-users"></i>
                                 </div>
                                 <p class="mb-0 apps-name">Customer Activity</p>
                              </div>
                            </a>
                     </div>
                     <div class="col">
                              <a href="<?=site_url('profile')?>">
                              <div class="apps p-2 radius-10 text-center">
                                 <div class="apps-icon-box mb-1 text-white  bg-warning">
                                   <i class="bx bx-user"></i>
                                 </div>
                                 <p class="mb-0 apps-name">Profile</p>
                              </div>
                            </a>
                     </div>
                    <!-- -->
                 </div><!--end row-->
              </div>
            </li>
            
            </ul>
            </div>
      </nav>
    </header>
       <!--end top header-->
       
 