<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/skodash/assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="assets/skodash/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/skodash/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="assets/skodash/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="assets/skodash/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/style.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="assets/skodash/assets/css/pace.min.css" rel="stylesheet" />
	


  <!--Theme Styles-->
  <link href="assets/skodash/assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/semi-dark.css" rel="stylesheet" />
  <link href="assets/skodash/assets/css/header-colors.css" rel="stylesheet" />

  <title>Skodash - Bootstrap 5 Admin Template</title>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    <header class="top-header">        
      <nav class="navbar navbar-expand">
        <div class="topbar-logo-header d-none d-xl-flex">
          <div>
            <img src="assets/skodash/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
          </div>
          <div>
            <h4 class="logo-text">Skodash</h4>
          </div>
        </div>
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
          </div>
          <div class="top-navbar d-none d-xl-block ms-3">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item">
            <a class="nav-link" href="index.html">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="app-emailbox.html">Email</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="javascript:;">Projects</a>
            </li>
            <li class="nav-item d-none d-xxl-block">
            <a class="nav-link" href="javascript:;">Events</a>
            </li>
            <li class="nav-item d-none d-xxl-block">
            <a class="nav-link" href="app-to-do.html">Todo</a>
            </li>
          </ul>
          </div>
          <div class="search-toggle-icon d-xl-none ms-auto">
            <i class="bi bi-search"></i>
          </div>
          <form class="searchbar d-none d-xl-flex ms-auto">
              <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
              <input class="form-control" type="text" placeholder="Type here to search">
              <div class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon"><i class="bi bi-x-lg"></i></div>
          </form>
          <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-1">
                  <img src="assets/skodash/assets/images/avatars/avatar-1.png" class="user-img" alt="">
                  <div class="user-name d-none d-sm-block">Jhon Deo</div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                        <img src="assets/skodash/assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="60" height="60">
                        <div class="ms-3">
                          <h6 class="mb-0 dropdown-user-name">Jhon Deo</h6>
                          <small class="mb-0 dropdown-user-designation text-secondary">HR Manager</small>
                        </div>
                     </div>
                   </a>
                 </li>
                 <li><hr class="dropdown-divider"></li>
                 <li>
                    <a class="dropdown-item" href="pages-user-profile.html">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                         <div class="setting-text ms-3"><span>Profile</span></div>
                       </div>
                     </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                         <div class="setting-text ms-3"><span>Setting</span></div>
                       </div>
                     </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="index2.html">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                         <div class="setting-text ms-3"><span>Dashboard</span></div>
                       </div>
                     </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-piggy-bank-fill"></i></div>
                         <div class="setting-text ms-3"><span>Earnings</span></div>
                       </div>
                     </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                         <div class="setting-icon"><i class="bi bi-cloud-arrow-down-fill"></i></div>
                         <div class="setting-text ms-3"><span>Downloads</span></div>
                       </div>
                     </a>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <a class="dropdown-item" href="authentication-signup-with-header-footer.html">
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
                 <div class="row row-cols-3 gx-2">
                    <div class="col">
                      <a href="ecommerce-orders.html">
                       <div class="apps p-2 radius-10 text-center">
                          <div class="apps-icon-box mb-1 text-white bg-primary bg-gradient">
                            <i class="bi bi-cart-plus-fill"></i>
                          </div>
                          <p class="mb-0 apps-name">Orders</p>
                       </div>
                      </a>
                    </div>
                    <div class="col">
                      <a href="javascript:;">
                      <div class="apps p-2 radius-10 text-center">
                         <div class="apps-icon-box mb-1 text-white bg-danger bg-gradient">
                           <i class="bi bi-people-fill"></i>
                         </div>
                         <p class="mb-0 apps-name">Users</p>
                      </div>
                    </a>
                   </div>
                   <div class="col">
                    <a href="ecommerce-products-grid.html">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-white bg-success bg-gradient">
                        <i class="bi bi-bank2"></i>
                       </div>
                       <p class="mb-0 apps-name">Products</p>
                    </div>
                    </a>
                  </div>
                  <div class="col">
                    <a href="component-media-object.html">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-white bg-orange bg-gradient">
                        <i class="bi bi-collection-play-fill"></i>
                       </div>
                       <p class="mb-0 apps-name">Media</p>
                    </div>
                    </a>
                  </div>
                  <div class="col">
                    <a href="pages-user-profile.html">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-white bg-purple bg-gradient">
                        <i class="bi bi-person-circle"></i>
                       </div>
                       <p class="mb-0 apps-name">Account</p>
                     </div>
                    </a>
                  </div>
                  <div class="col">
                    <a href="javascript:;">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-dark bg-info bg-gradient">
                        <i class="bi bi-file-earmark-text-fill"></i>
                       </div>
                       <p class="mb-0 apps-name">Docs</p>
                    </div>
                    </a>
                  </div>
                  <div class="col">
                    <a href="ecommerce-orders-detail.html">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-white bg-pink bg-gradient">
                        <i class="bi bi-credit-card-fill"></i>
                       </div>
                       <p class="mb-0 apps-name">Payment</p>
                    </div>
                    </a>
                  </div>
                  <div class="col">
                    <a href="javascript:;">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-white bg-bronze bg-gradient">
                        <i class="bi bi-calendar-check-fill"></i>
                       </div>
                       <p class="mb-0 apps-name">Events</p>
                    </div>
                  </a>
                  </div>
                  <div class="col">
                    <a href="javascript:;">
                    <div class="apps p-2 radius-10 text-center">
                       <div class="apps-icon-box mb-1 text-dark bg-warning bg-gradient">
                        <i class="bi bi-book-half"></i>
                       </div>
                       <p class="mb-0 apps-name">Story</p>
                      </div>
                    </a>
                  </div>
                 </div><!--end row-->
              </div>
            </li>
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">

                <div class="messages">
                  <span class="notify-badge">5</span>
                  <i class="bi bi-messenger"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end p-0">
                <div class="p-2 border-bottom m-2">
                    <h5 class="h5 mb-0">Messages</h5>
                </div>
               <div class="header-message-list p-2">
                  <div class="dropdown-item bg-light radius-10 mb-1">
                    <form class="dropdown-searchbar position-relative">
                      <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i class="bi bi-search"></i></div>
                      <input class="form-control" type="search" placeholder="Search Messages">
                    </form>
                  </div>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                        <img src="assets/skodash/assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="52" height="52">
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">Amelio Joly <span class="msg-time float-end text-secondary">1 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The standard chunk of lorem...</small>
                        </div>
                     </div>
                   </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-2.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Althea Cabardo <span class="msg-time float-end text-secondary">7 m</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Many desktop publishing</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-3.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Katherine Pechon <span class="msg-time float-end text-secondary">2 h</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Making this the first true</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-4.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Peter Costanzo <span class="msg-time float-end text-secondary">3 h</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">It was popularised in the 1960</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-5.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Thomas Wheeler <span class="msg-time float-end text-secondary">1 d</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">If you are going to use a passage</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-6.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Johnny Seitz <span class="msg-time float-end text-secondary">2 w</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">All the Lorem Ipsum generators</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                       <img src="assets/skodash/assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="52" height="52">
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Amelio Joly <span class="msg-time float-end text-secondary">1 m</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The standard chunk of lorem...</small>
                       </div>
                    </div>
                  </a>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                      <img src="assets/skodash/assets/images/avatars/avatar-2.png" alt="" class="rounded-circle" width="52" height="52">
                      <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0 dropdown-msg-user">Althea Cabardo <span class="msg-time float-end text-secondary">7 m</span></h6>
                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Many desktop publishing</small>
                      </div>
                   </div>
                 </a>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                      <img src="assets/skodash/assets/images/avatars/avatar-3.png" alt="" class="rounded-circle" width="52" height="52">
                      <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0 dropdown-msg-user">Katherine Pechon <span class="msg-time float-end text-secondary">2 h</span></h6>
                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Making this the first true</small>
                      </div>
                   </div>
                 </a>
              </div>
              <div class="p-2">
                <div><hr class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <div class="text-center">View All Messages</div>
                  </a>
              </div>
             </div>
            </li>
            <li class="nav-item dropdown dropdown-large d-none d-sm-block">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="notifications">
                  <span class="notify-badge">8</span>
                  <i class="bi bi-bell-fill"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end p-0">
                <div class="p-2 border-bottom m-2">
                    <h5 class="h5 mb-0">Notifications</h5>
                </div>
                <div class="header-notifications-list p-2">
                   <div class="dropdown-item bg-light radius-10 mb-1">
                    <form class="dropdown-searchbar position-relative">
                      <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i class="bi bi-search"></i></div>
                      <input class="form-control" type="search" placeholder="Search Messages">
                    </form>
                    </div>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex align-items-center">
                         <div class="notification-box"><i class="bi bi-basket2-fill"></i></div>
                         <div class="ms-3 flex-grow-1">
                           <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">1 m</span></h6>
                           <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new orders</small>
                         </div>
                      </div>
                    </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-people-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Customers <span class="msg-time float-end text-secondary">7 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5 new user registered</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">24 PDF File <span class="msg-time float-end text-secondary">2 h</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The pdf files generated</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-collection-play-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">Time Response  <span class="msg-time float-end text-secondary">3 h</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5.1 min avarage time response</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-cursor-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Product Approved  <span class="msg-time float-end text-secondary">1 d</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Your new product has approved</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-gift-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New Comments <span class="msg-time float-end text-secondary">2 w</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New customer comments recived</small>
                        </div>
                     </div>
                   </a>
                   <a class="dropdown-item" href="#">
                     <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-droplet-fill"></i></div>
                        <div class="ms-3 flex-grow-1">
                          <h6 class="mb-0 dropdown-msg-user">New 24 authors<span class="msg-time float-end text-secondary">1 m</span></h6>
                          <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">24 new authors joined last week</small>
                        </div>
                     </div>
                   </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-mic-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Your item is shipped <span class="msg-time float-end text-secondary">7 m</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Successfully shipped your item</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-lightbulb-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">Defense Alerts <span class="msg-time float-end text-secondary">2 h</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">45% less alerts last 4 weeks</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-bookmark-heart-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">4 New Sign Up <span class="msg-time float-end text-secondary">2 w</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New 4 user registartions</small>
                       </div>
                    </div>
                  </a>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <div class="notification-box"><i class="bi bi-briefcase-fill"></i></div>
                       <div class="ms-3 flex-grow-1">
                         <h6 class="mb-0 dropdown-msg-user">All Documents Uploaded <span class="msg-time float-end text-secondary">1 mo</span></h6>
                         <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Sussessfully uploaded all files</small>
                       </div>
                    </div>
                  </a>
               </div>
               <div class="p-2">
                 <div><hr class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">
                     <div class="text-center">View All Notifications</div>
                   </a>
               </div>
              </div>
            </li>
            </ul>
            </div>
      </nav>
    </header>
     <!--end top header-->

     <!--start navigation-->
     <div class="nav-container">
      <div class="mobile-topbar-header">
        <div>
          <img src="assets/skodash/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
          <h4 class="logo-text">Skodash</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
        </div>
      </div>
      <nav class="topbar-nav">
        <ul class="metismenu" id="menu">
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-house-door"></i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
            <ul>
              <li> <a href="index.html"><i class="bi bi-arrow-right-short"></i>eCommerce</a>
              </li>
			  <li> <a href="index2.html"><i class="bi bi-arrow-right-short"></i>Sales</a>
              </li>
              <li> <a href="index3.html"><i class="bi bi-arrow-right-short"></i>Analytics</a>
              </li>
              <li> <a href="index4.html"><i class="bi bi-arrow-right-short"></i>Project Management</a>
              </li>
              <li> <a href="index5.html"><i class="bi bi-arrow-right-short"></i>CMS Dashboard</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bi bi-grid"></i>
              </div>
              <div class="menu-title">Application</div>
            </a>
            <ul>
              <li> <a href="app-emailbox.html"><i class="bi bi-arrow-right-short"></i>Email</a>
              </li>
              <li> <a href="app-chat-box.html"><i class="bi bi-arrow-right-short"></i>Chat Box</a>
              </li>
              <li> <a href="app-file-manager.html"><i class="bi bi-arrow-right-short"></i>File Manager</a>
              </li>
              <li> <a href="app-to-do.html"><i class="bi bi-arrow-right-short"></i>Todo List</a>
              </li>
              <li> <a href="app-invoice.html"><i class="bi bi-arrow-right-short"></i>Invoice</a>
              </li>
              <li> <a href="app-fullcalender.html"><i class="bi bi-arrow-right-short"></i>Calendar</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bi bi-graph-down"></i>
              </div>
              <div class="menu-title">Charts</div>
            </a>
            <ul>
              <li> <a href="charts-apex-chart.html"><i class="bi bi-arrow-right-short"></i>Apex</a>
              </li>
              <li> <a href="charts-chartjs.html"><i class="bi bi-arrow-right-short"></i>Chartjs</a>
              </li>
              <li> <a href="charts-highcharts.html"><i class="bi bi-arrow-right-short"></i>Highcharts</a>
              </li>
            </ul>
          </li>
          <li class="">
            <a class="has-arrow" href="javascript:;" aria-expanded="false">
              <div class="parent-icon"><i class="bi bi-bookmark-star"></i>
              </div>
              <div class="menu-title">Components</div>
            </a>
            <ul>
              <li><a class="has-arrow" href="javascript:;"><i class="bi bi-arrow-right-short"></i>Widgets</a>
                <ul>
                  <li> <a href="widgets-static-widgets.html"><i class="bi bi-arrow-right-short"></i>Static Widgets</a>
                  </li>
                  <li> <a href="widgets-data-widgets.html"><i class="bi bi-arrow-right-short"></i>Data Widgets</a>
                  </li>
                </ul>
              </li>
              <li> <a href="component-alerts.html"><i class="bi bi-arrow-right-short"></i>Alerts</a>
              </li>
              <li> <a href="component-accordions.html"><i class="bi bi-arrow-right-short"></i>Accordions</a>
              </li>
              <li> <a href="component-buttons.html"><i class="bi bi-arrow-right-short"></i>Buttons</a>
              </li>
              <li> <a href="component-cards.html"><i class="bi bi-arrow-right-short"></i>Cards</a>
              </li>
              <li> <a href="component-list-groups.html"><i class="bi bi-arrow-right-short"></i>List Groups</a>
              </li>
              <li> <a href="component-media-object.html"><i class="bi bi-arrow-right-short"></i>Media Objects</a>
              </li>
              <li> <a href="component-modals.html"><i class="bi bi-arrow-right-short"></i>Modals</a>
              </li>
              <li> <a href="component-navs-tabs.html"><i class="bi bi-arrow-right-short"></i>Navs &amp; Tabs</a>
              </li>
              <li> <a href="component-navbar.html"><i class="bi bi-arrow-right-short"></i>Navbar</a>
              </li>
              <li> <a href="component-popovers-tooltips.html"><i class="bi bi-arrow-right-short"></i>Popovers &amp; Tooltips</a>
              </li>
              <li> <a href="component-progress-bars.html"><i class="bi bi-arrow-right-short"></i>Progress</a>
              </li>
              <li> <a href="component-spinners.html"><i class="bi bi-arrow-right-short"></i>Spinners</a>
              </li>
              <li> <a href="component-notifications.html"><i class="bi bi-arrow-right-short"></i>Notifications</a>
              </li>
              <li> <a href="component-avtars-chips.html"><i class="bi bi-arrow-right-short"></i>Avatrs &amp; Chips</a>
              </li>
            </ul>
          </li>
          <li class="">
            <a class="has-arrow" href="javascript:;" aria-expanded="false">
              <div class="parent-icon"><i class="bi bi-lock"></i>
              </div>
              <div class="menu-title">Authentication</div>
            </a>
            <ul>
              <li> <a href="authentication-signin.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Sign In</a>
              </li>
              <li> <a href="authentication-signup.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Sign Up</a>
              </li>
              <li> <a href="authentication-signin-with-header-footer.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Sign In with Header &amp; Footer</a>
              </li>
              <li> <a href="authentication-signup-with-header-footer.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Sign Up with Header &amp; Footer</a>
              </li>
              <li> <a href="authentication-forgot-password.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Forgot Password</a>
              </li>
              <li> <a href="authentication-reset-password.html" target="_blank"><i class="bi bi-arrow-right-short"></i>Reset Password</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;" aria-expanded="false">
              <div class="parent-icon icon-color-6"> <i class="bi bi-file-earmark-break"></i>
              </div>
              <div class="menu-title">Pages</div>
            </a>
            <ul>
              <li> <a href="pages-user-profile.html"><i class="bi bi-arrow-right-short"></i>User Profile</a>
              </li>
              <li> <a href="pages-timeline.html"><i class="bi bi-arrow-right-short"></i>Timeline</a>
              </li>
              <li> <a href="pages-pricing-tables.html"><i class="bi bi-arrow-right-short"></i>Pricing</a>
              </li>
              <li> <a class="has-arrow" href="javascript:;"><i class="bi bi-arrow-right-short"></i>Errors</a>
                <ul>
                  <li> <a href="pages-errors-404-error.html"><i class="bi bi-arrow-right-short"></i>404 Error</a>
                  </li>
                  <li> <a href="pages-errors-500-error.html"><i class="bi bi-arrow-right-short"></i>500 Error</a>
                  </li>
                  <li> <a href="pages-errors-coming-soon.html"><i class="bi bi-arrow-right-short"></i>Coming Soon</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;" aria-expanded="false">
              <div class="parent-icon"><i class="bi bi-pencil-square"></i>
              </div>
              <div class="menu-title">Forms</div>
            </a>
            <ul>
              <li> <a href="form-elements.html"><i class="bi bi-arrow-right-short"></i>Form Elements</a>
              </li>
              <li> <a href="form-input-group.html"><i class="bi bi-arrow-right-short"></i>Input Groups</a>
              </li>
              <li> <a href="form-layouts.html"><i class="bi bi-arrow-right-short"></i>Forms Layouts</a>
              </li>
              <li> <a href="form-validations.html"><i class="bi bi-arrow-right-short"></i>Form Validation</a>
              </li>
              <li> <a href="form-wizard.html"><i class="bi bi-arrow-right-short"></i>Form Wizard</a>
              </li>
              <li> <a href="form-date-time-pickes.html"><i class="bi bi-arrow-right-short"></i>Date Pickers</a>
              </li>
              <li> <a href="form-select2.html"><i class="bi bi-arrow-right-short"></i>Select2</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
    <!--end navigation-->

       <!--start content-->
       <main class="page-content">
				<div class="chat-wrapper">
					<div class="chat-sidebar">
						<div class="chat-sidebar-header">
							<div class="d-flex align-items-center">
								<div class="chat-user-online">
									<img src="assets/skodash/assets/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2">
									<p class="mb-0">Rachel Zane</p>
								</div>
								<div class="dropdown">
									<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item" href="javascript:;">Settings</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Help & Feedback</a>
										<a class="dropdown-item" href="javascript:;">Enable Split View Mode</a>
										<a class="dropdown-item" href="javascript:;">Keyboard Shortcuts</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Sign Out</a>
									</div>
								</div>
							</div>
							<div class="mb-3"></div>
							<div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
								<input type="text" class="form-control" placeholder="People, groups, & messages"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
							</div>
							<div class="chat-tab-menu mt-3">
								<ul class="nav nav-pills nav-justified">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-conversation'></i>
											</div>
											<div><small>Chats</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-phone'></i>
											</div>
											<div><small>Calls</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bxs-contact'></i>
											</div>
											<div><small>Contacts</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-bell'></i>
											</div>
											<div><small>Notifications</small>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="chat-sidebar-content">
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-Chats">
									<div class="p-3">
										<div class="meeting-button d-flex justify-content-between">
											<div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-video me-2'></i>Meet Now<i class='bx bxs-chevron-down ms-2'></i></a>
												<div class="dropdown-menu"> <a class="dropdown-item" href="#">Host a meeting</a>
													<a class="dropdown-item" href="#">Join a meeting</a>
												</div>
											</div>
											<div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static"><i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i></a>
												<div class="dropdown-menu dropdown-menu-right">	<a class="dropdown-item" href="#">New Group Chat</a>
													<a class="dropdown-item" href="#">New Moderated Group</a>
													<a class="dropdown-item" href="#">New Chat</a>
													<a class="dropdown-item" href="#">New Private Conversation</a>
												</div>
											</div>
										</div>
										<div class="dropdown mt-3"> <a href="#" class="text-uppercase text-secondary dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">Recent Chats <i class='bx bxs-chevron-down'></i></a>
											<div class="dropdown-menu">	<a class="dropdown-item" href="#">Recent Chats</a>
												<a class="dropdown-item" href="#">Hidden Chats</a>
												<div class="dropdown-divider"></div>	<a class="dropdown-item" href="#">Sort by Time</a>
												<a class="dropdown-item" href="#">Sort by Unread</a>
												<div class="dropdown-divider"></div>	<a class="dropdown-item" href="#">Show Favorites</a>
											</div>
										</div>
									</div>
									<div class="chat-list">
										<div class="list-group list-group-flush">
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-2.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Louis Litt</h6>
														<p class="mb-0 chat-msg">You just got LITT up, Mike.</p>
													</div>
													<div class="chat-time">9:51 AM</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item active">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Harvey Specter</h6>
														<p class="mb-0 chat-msg">Wrong. You take the gun....</p>
													</div>
													<div class="chat-time">4:32 PM</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-4.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Rachel Zane</h6>
														<p class="mb-0 chat-msg">I was thinking that we could...</p>
													</div>
													<div class="chat-time">Wed</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-5.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Donna Paulsen</h6>
														<p class="mb-0 chat-msg">Mike, I know everything!</p>
													</div>
													<div class="chat-time">Tue</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-6.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Jessica Pearson</h6>
														<p class="mb-0 chat-msg">Have you finished the draft...</p>
													</div>
													<div class="chat-time">9/3/2020</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-7.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Harold Gunderson</h6>
														<p class="mb-0 chat-msg">Thanks Mike! :)</p>
													</div>
													<div class="chat-time">12/3/2020</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-9.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Katrina Bennett</h6>
														<p class="mb-0 chat-msg">I've sent you the files for...</p>
													</div>
													<div class="chat-time">16/3/2020</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-10.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Charles Forstman</h6>
														<p class="mb-0 chat-msg">Mike, this isn't over.</p>
													</div>
													<div class="chat-time">18/3/2020</div>
												</div>
											</a>
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/skodash/assets/images/avatars/avatar-11.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Jonathan Sidwell</h6>
														<p class="mb-0 chat-msg">That's bullshit. This deal..</p>
													</div>
													<div class="chat-time">24/3/2020</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="chat-header d-flex align-items-center">
						<div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
						</div>
						<div>
							<h4 class="mb-1 font-weight-bold">Harvey Inspector</h4>
							<div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Gallery</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Find</a>
							</div>
						</div>
						<div class="chat-top-header-menu ms-auto"> <a href="javascript:;"><i class='bx bx-video'></i></a>
							<a href="javascript:;"><i class='bx bx-phone'></i></a>
							<a href="javascript:;"><i class='bx bx-user-plus'></i></a>
						</div>
					</div>
					<div class="chat-content">
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 2:35 PM</p>
									<p class="chat-left-msg">Hi, harvey where are you now a days?</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex ms-auto">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 2:37 PM</p>
									<p class="chat-right-msg">I am in USA</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 2:48 PM</p>
									<p class="chat-left-msg">okk, what about admin template?</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 2:49 PM</p>
									<p class="chat-right-msg">i have already purchased the admin template</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 3:12 PM</p>
									<p class="chat-left-msg">ohhk, great, which admin template you have purchased?</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 3:14 PM</p>
									<p class="chat-right-msg">i purchased dashtreme admin template from themeforest. it is very good product for web application</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 3:16 PM</p>
									<p class="chat-left-msg">who is the author of this template?</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 3:22 PM</p>
									<p class="chat-right-msg">codervent is the author of this admin template</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 3:16 PM</p>
									<p class="chat-left-msg">ohh i know about this author. he has good admin products in his portfolio.</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 3:30 PM</p>
									<p class="chat-right-msg">yes, codervent has multiple admin templates. also he is very supportive.</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/skodash/assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 3:33 PM</p>
									<p class="chat-left-msg">All the best for your target. thanks for giving your time.</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 3:35 PM</p>
									<p class="chat-right-msg">thanks Harvey</p>
								</div>
							</div>
						</div>
					</div>
					<div class="chat-footer d-flex align-items-center">
						<div class="flex-grow-1 pe-2">
							<div class="input-group">	<span class="input-group-text"><i class='bx bx-smile'></i></span>
								<input type="text" class="form-control" placeholder="Type a message">
							</div>
						</div>
						<div class="chat-footer-menu"> <a href="javascript:;"><i class='bx bx-file'></i></a>
							<a href="javascript:;"><i class='bx bxs-contact'></i></a>
							<a href="javascript:;"><i class='bx bx-microphone'></i></a>
							<a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
						</div>
					</div>
					<!--start chat overlay-->
					<div class="overlay chat-toggle-btn-mobile"></div>
					<!--end chat overlay-->
				</div>
			</main>
       <!--end page main-->


       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        
        <!--start switcher-->
       <div class="switcher-body">
        <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1" checked>
              <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
              <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
              <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
              <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
              <div class="row row-cols-auto g-3">
                <div class="col">
                  <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
       <!--end switcher-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="assets/skodash/assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="assets/skodash/assets/js/jquery.min.js"></script>
  <script src="assets/skodash/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/skodash/assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="assets/skodash/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/skodash/assets/js/pace.min.js"></script>
  <!--app-->
  <script src="assets/skodash/assets/js/app.js"></script>
  <script src="assets/skodash/assets/js/app-chat-box.js"></script>


</body>

</html>