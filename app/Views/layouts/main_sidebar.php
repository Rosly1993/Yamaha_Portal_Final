<?php include('add_script.php');?>

      <!-- Begin page -->
        <div id="wrapper">

            
            <!-- ========== Menu ========== -->
            <div class="app-menu">  

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="" class="logo-light">
                    <img src="<?= base_url('public/assets/images/YamahaLogo.png') ?>" alt="dark logo" class="logo-lg" height="100">
                    <img src="<?= base_url('public/assets/images/YamahaLogo.png') ?>" alt="small logo" class="logo-sm" height="50">&nbsp;<b>Yamaha</b>
                    </a>

                    <!-- Brand Logo Dark -->
                   <!-- Brand Logo Dark -->
                    <a href="" class="logo-dark">
                        <img src="<?= base_url('public/assets/images/YamahaLogo.png') ?>" alt="dark logo" class="logo-lg" height="100">
                        <img src="<?= base_url('public/assets/images/YamahaLogo.png') ?>" alt="small logo" class="logo-sm" height="50">&nbsp;<b>Yamaha</b>
                    </a>
                </div>

                <!-- menu-left -->
                <div class="scrollbar">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="<?= base_url('public/assets/images/' . $session->get('login_profile'))?>" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown"><?= $session->get('login_firstname') ?> <?= $session->get('login_lastname') ?></a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a> -->


                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a>


                            </div>
                        </div>
                        <!-- <p class="text-muted mb-0">Admin Head</p> -->
                    </div>

                    <!--- Menu -->
                    <ul class="menu">

                        <li class="menu-title">Navigation</li>
                        <li class="menu-item">
                            <a href="<?= base_url('Main') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                                <span class="menu-text"> Landing Page </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('Main') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                                <span class="menu-text"> Dashboard </span>
                            </a>
                        </li>

                        <!-- <li class="menu-item">
                            <a href="#menuDashboards" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                                <span class="menu-text"> Dashboard </span>
                               
                            </a> -->
                            <!-- <div class="collapse" id="menuDashboards">
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="<?= base_url('Main') ?>" class="menu-link">
                                            <span class="menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                  
                                </ul>
                            </div>
                        </li> -->

                        <li class="menu-title">Main Pages</li>
                        <?php if ($is_view_motorcyclelist == 1): ?>
                        <li class="menu-item">
                            <a href="<?= base_url('Motorcyclelist') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-star-outline"></i></span>
                                <span class="menu-text"> Motorcycle List </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($is_view_3s_branchlist == 1): ?>
                        <li class="menu-item">
                            <a href="<?= base_url('Branchlist') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-star-outline"></i></span>
                                <span class="menu-text"> 3s Branch List </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($is_view_Service_manual == 1): ?>
                        <li class="menu-item">
                            <a href="<?= base_url('Servicemanuals') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-star-outline"></i></span>
                                <span class="menu-text"> Service Manuals </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($is_view_Service_bulletin == 1): ?>
                        <li class="menu-item">
                            <a href="<?= base_url('Servicebulletins') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-star-outline"></i></span>
                                <span class="menu-text"> Service Bulletins </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <!-- <li class="menu-title">System Maintenance</li> -->

                      

                        <li class="menu-item">
                            <a href="#menuTables" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-table"></i></span>
                                <span class="menu-text"> System Maintenance </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="menuTables">
                                <ul class="sub-menu">
                                <?php if ($is_view_Motorcycle_category == 1): ?>
                                    <li class="menu-item">
                                        <a href="<?= base_url('Motorcyclecategory') ?>" class="menu-link">
                                            <span class="menu-text">Motorcycle Category</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if ($is_view_Location == 1): ?>
                                    <li class="menu-item">
                                        <a href="<?= base_url('Location') ?>" class="menu-link">
                                            <span class="menu-text">Location</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if ($is_view_Users == 1): ?>
                                    <li class="menu-item">
                                        <a href="<?= base_url('Table') ?>" class="menu-link">
                                            <span class="menu-text">Users Information</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                  
                                    <?php if ($is_view_Roles_permission == 1): ?>
                                    <li class="menu-item">
                                        <a href="<?= base_url('Rolespermission') ?>" class="menu-link">
                                            <span class="menu-text">Roles & Permission</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-item">
                            <a href="<?= base_url('Activitylogs') ?>" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-star-outline"></i></span>
                                <span class="menu-text"> Activity Logs </span>
                            </a>
                        </li>

                    </ul>
                    <!--- End Menu -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- ========== Left menu End ========== -->

            <div class="content-page">

<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.html" class="logo-light">
                    <!-- <img src="" alt="logo" class="logo-lg">
                    <img src="" alt="small logo" class="logo-sm"> -->
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <!-- <img src="" alt="dark logo" class="logo-lg">
                    <img src="" alt="small logo" class="logo-sm"> -->
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

         

            <!-- Mega Menu Dropdown -->
            <div class="dropdown dropdown-mega d-none d-xl-block">
               
                <div class="dropdown-menu dropdown-megamenu">
                    <div class="row">
                        
                        <div class="col-sm-4">
                            <div class="text-center mt-3">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="topbar-menu d-flex align-items-center">
            <!-- Topbar Search Form -->
            <li class="app-search dropdown me-3 d-none d-lg-block">
                <form>
                    <!-- <input type="search" class="form-control rounded-pill" placeholder="Search..." id="top-search">
                    <span class="fe-search search-icon font-22"></span> -->
                </form>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                     
                    </div>

                    <!-- item-->
                    <div class="dropdown-header noti-title">
                   
                    </div>

                    <div class="notification-list">
                        <!-- item-->
                       
                    </div>
                </div>
            </li>
            <?php
            // Calculate the remaining days as before
            $lastUpdateDate = $session->get('login_last_update_date');
            $lastUpdateDateTime = new DateTime($lastUpdateDate);
            $expiryDate = clone $lastUpdateDateTime;
            $expiryDate->modify('+90 days');
            $today = new DateTime();

            // Calculate the interval
            $interval = $today->diff($expiryDate);

            // Determine the number of days remaining
            $daysRemaining = $today > $expiryDate ? -$interval->days : $interval->days;

            // Determine the color class based on the number of days remaining
            $colorClass = '';
            if ($daysRemaining < 10) {
                $colorClass = 'text-danger'; // Red
            } elseif ($daysRemaining <= 20) {
                $colorClass = 'text-warning'; // Yellow
            } else {
                $colorClass = 'text-success'; // Green
            }
            ?>

            <li class="d-none d-sm-inline-block">
                Password expires in &nbsp;<span style="font-size: 20px;font-weight:bolder" class="<?= $colorClass ?>"><?= $daysRemaining ?></span>&nbsp;days.
            </li>



            <!-- Fullscreen Button -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                    <i class="fe-maximize font-22"></i>
                </a>
            </li>

            <!-- Search Dropdown (for Mobile/Tablet) -->
            <li class="dropdown d-lg-none">
                <!-- <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line font-22"></i>
                </a> -->
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <!-- <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form> -->
                </div>
            </li>
       
            <!-- App Dropdown -->
            <li class="dropdown d-none d-md-inline-block">
              
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                  
                       
                </div>
            </li>
       
            <!-- Language flag dropdown  -->
            <li class="dropdown d-none d-md-inline-block">
              
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

              

                </div>
            </li>
          
            <!-- Light/Darj Mode Toggle Button -->
            <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="dropdown"> 
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('public/assets/images/' . $session->get('login_profile'))?>" alt="user-image" class="rounded-circle">
                    <span class="ms-1 d-none d-md-inline-block">
                    <?= $session->get('login_firstname') ?> <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="<?= base_url('Profile') ?>" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a> -->

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a> -->

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="#" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fe-log-out me-1"></i>
                    <span>Logout</span>
                    </a>



                </div>
            </li>

            <!-- Right Bar offcanvas button (Theme Customization Panel) -->
            <li>
                <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="fe-settings font-22"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->