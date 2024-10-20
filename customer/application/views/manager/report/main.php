 <!-- Page Content - Only Page Elements Here-->
    <div class="page-content footer-clear">

        <!-- Page Title-->
        <div class="pt-3">
            <div class="page-title d-flex">
                <div class="align-self-center me-auto">
                    <p class="color-highlight">Hello Danesh!</p>
                    <h1 class="color-theme">Reports</h1>
                </div>
                <div class="align-self-center ms-auto">
                    
                    <!-- Page Title Dropdown Menu-->
                    <div class="dropdown-menu">
                        <div class="card card-style shadow-m mt-1 me-1">
                            <div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
                                <a href="page-wallet.html" class="list-group-item">
                                    <i class="has-bg gradient-green shadow-bg shadow-bg-xs color-white rounded-xs bi bi-credit-card"></i>
                                    <strong class="font-13">Wallet</strong>
                                </a>
                                <a href="activity.html" class="list-group-item">
                                    <i class="has-bg gradient-blue shadow-bg shadow-bg-xs color-white rounded-xs bi bi-graph-up"></i>
                                    <strong class="font-13">Activity</strong>
                                </a>
                                <a href="page-profile.html" class="list-group-item">
                                    <i class="has-bg gradient-yellow shadow-bg shadow-bg-xs color-white rounded-xs bi bi-person-circle"></i>
                                    <strong class="font-13">Account</strong>
                                </a>
                                <a href="page-signin-1.html" class="list-group-item">
                                    <i class="has-bg gradient-red shadow-bg shadow-bg-xs color-white rounded-xs bi bi-power"></i>
                                    <strong class="font-13">Log Out</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card card-style px-0">
            <div class="form-custom form-label form-border form-icon px-3 pt-1">
                <i class="bi bi-calendar font-13"></i>
                <select class="form-select rounded-xs" id="c6a">
                    <option value="0" selected>Current Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">Octomber</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="position-relative">
                <div class="position-absolute w-100" style="height:320px"><!-- same height as chart in plugins/apex/apex-call.js-->
                    <div class="card-center">
                        <h1 class="pb-5 mb-5 text-center">
                            <span class="font-25 d-block pt-4 mt-1">$25.315</span>
                            <span class="font-12 font-400 opacity-50 d-block mt-n2">Spent this Month</span>
                        </h1>
                    </div>
                </div>
                <div class="mx-auto" style="width:320px"><!-- same height as chart in plugins/apex/apex-call.js-->
                    <div class="chart mx-auto no-click" id="chart-activity"></div>
                </div>
            </div>
            <h6 class="text-center opacity-30 pb-3">Tap an Item below for More Details</h6>
                 
            <div class="content mt-0 mb-0">
                <a data-bs-toggle="offcanvas" data-bs-target="#menu-activity" href="#" class="d-flex pb-3">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-red shadow-bg shadow-bg-xs"><i class="bi bi-droplet font-18 color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1">Utilities</h5>
                        <p class="mb-0 font-11 opacity-50">12 Transactions</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-red-dark">$1530.41</h4>
                        <p class="mb-0 font-12 opacity-50">24.53%</p>
                    </div>
                </a>
                <a data-bs-toggle="offcanvas" data-bs-target="#menu-activity" href="#" class="d-flex pb-3">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-green shadow-bg shadow-bg-xs"><i class="bi bi-wallet font-18 color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1">Income</h5>
                        <p class="mb-0 font-11 opacity-50">15 Transactions</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-green-dark">$4530.55</h4>
                        <p class="mb-0 font-12 opacity-50">41.27%</p>
                    </div>
                </a>
                <a data-bs-toggle="offcanvas" data-bs-target="#menu-activity" href="#" class="d-flex pb-3">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-blue shadow-bg shadow-bg-xs"><i class="bi bi-arrow-repeat font-20 color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1">Subscriptions</h5>
                        <p class="mb-0 font-11 opacity-50">23 Transactions</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-red-dark">$340.31</h4>
                        <p class="mb-0 font-12 opacity-50">21.27%</p>
                    </div>
                </a>
                <a data-bs-toggle="offcanvas" data-bs-target="#menu-activity" href="#" class="d-flex pb-3">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-mint shadow-bg shadow-bg-xs"><i class="bi bi-plus font-24 color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1">Medical</h5>
                        <p class="mb-0 font-11 opacity-50">3 Transactions</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-red-dark">$270.31</h4>
                        <p class="mb-0 font-12 opacity-50">14.43%</p>
                    </div>
                </a>
                <a data-bs-toggle="offcanvas" data-bs-target="#menu-activity" href="#" class="d-flex pb-3">
                    <div class="align-self-center">
                        <span class="icon rounded-s me-2 gradient-magenta shadow-bg shadow-bg-xs"><i class="bi bi-heart font-16 color-white"></i></span>
                    </div>
                    <div class="align-self-center ps-1">
                        <h5 class="pt-1 mb-n1">Random</h5>
                        <p class="mb-0 font-11 opacity-50">3 Transactions</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h4 class="pt-1 mb-n1 color-red-dark">$480.31</h4>
                        <p class="mb-0 font-12 opacity-50">12.31%</p>
                    </div>
                </a>
                
            </div>
        </div>
    </div>
    <!-- End of Page Content-->