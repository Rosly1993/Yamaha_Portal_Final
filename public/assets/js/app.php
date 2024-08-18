<?

error_reporting(1);
$page = "dashboard";
if (isset($_GET['route'])) {
    $page = $_GET['route'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head >
    <meta charset="utf-8" />
    <title>DND Web App - Yahama Motor Philippines Inc.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Yamaha 3S E-Learning and Maintenance Online Request System" name="description" />
    <meta content="Yahama Motor Philippines Inc." name="author" />
    <?include "links.php";?>
</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Menu ========== -->
        <div class="app-menu">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.html" class="logo-light">
                    <img src="assets/images/logos/logo-light.png" alt="logo" class="logo-lg">
                    <img src="assets/images/logos/logo-sm.png" alt="small logo" class="logo-sm">
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <img src="assets/images/logos/logo-dark.png" alt="dark logo" class="logo-lg">
                    <img src="assets/images/logos/logo-sm.png" alt="small logo" class="logo-sm">
                </a>
            </div>

            <!-- menu-left -->
            <div class="scrollbar">

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="page_controller?action=avatar1&sid=<?= Date("YmdHis") ?>" alt="user-img" title="<?= $_SESSION['account_fname'] . " " . $_SESSION['account_lname'] ?>" class="rounded-circle avatar-md">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown"><?= $_SESSION['account_fname'] . " " . $_SESSION['account_lname'] ?></a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </div>
                    <p class="text-muted mb-0"><?= $_SESSION['designation'] ?></p>
                </div>
                <? include('sidebar.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left menu End ========== -->





        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <? include('content.php'); ?>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end right-bar" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center w-100 p-0 offcanvas-header">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified w-100" role="tablist">
                <li class="nav-item">
                    <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                        <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="offcanvas-body p-3 h-100" data-simplebar>
            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <div class="tab-pane active" id="settings-tab" role="tabpanel">

                    <div class="mt-n3">
                        <h6 class="fw-medium py-2 px-3 font-13 text-uppercase bg-light mx-n3 mt-n3 mb-3">
                            <span class="d-block py-1">Theme Settings</span>
                        </h6>
                    </div>

                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h5>

                    <div class="colorscheme-cardradio">
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                                <label class="form-check-label" for="layout-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                                <label class="form-check-label" for="layout-color-dark">Dark</label>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Content Width</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-layout-width" id="layout-width-default" value="default">
                            <label class="form-check-label" for="layout-width-default">Fluid (Default)</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-layout-width" id="layout-width-boxed" value="boxed">
                            <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                        </div>
                    </div>

                    <div id="layout-mode">
                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Layout Mode</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-default" value="default">
                                <label class="form-check-label" for="layout-mode-default">Default</label>
                            </div>


                            <div id="layout-detached">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-detached" value="detached">
                                    <label class="form-check-label" for="layout-mode-detached">Detached</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar Color</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                            <label class="form-check-label" for="topbar-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                            <label class="form-check-label" for="topbar-color-dark">Dark</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-brand" value="brand">
                            <label class="form-check-label" for="topbar-color-brand">Brand</label>
                        </div>
                    </div>

                    <div>
                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-brand" value="brand">
                                <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-gradient" value="gradient">
                                <label class="form-check-label" for="leftbar-color-gradient">Gradient</label>
                            </div>
                        </div>
                    </div>

                    <div id="menu-icon-color">
                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Icon Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-light" value="light">
                                <label class="form-check-label" for="twocolumn-menu-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-dark" value="dark">
                                <label class="form-check-label" for="twocolumn-menu-color-dark">Dark</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-brand" value="brand">
                                <label class="form-check-label" for="twocolumn-menu-color-brand">Brand</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-gradient" value="gradient">
                                <label class="form-check-label" for="twocolumn-menu-color-gradient">Gradient</label>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar Size</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">Default</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">Compact (Medium Width)</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">Condensed (Icon View)</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-fullscreen" value="fullscreen">
                                <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h5>

                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="data-sidebar-user" id="sidebaruser-check">
                            <label class="form-check-label" for="sidebaruser-check">Enable</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="offcanvas-footer border-top py-2 px-2 text-center">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-light w-50" id="reset-layout">Reset</button>
            </div>
        </div>
    </div>
    <div id="modal-append"></div>
    <div id="modal2-append"></div>
    <div id="data-append"></div>
</body>
<!-- App js -->
<script src="assets/js/app.js"></script>
<!-- Plugins js-->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/libs/selectize/js/standalone/selectize.min.js"></script>
<script src="assets/js/dnd_foot.js"></script>
<script src="assets/libs/fullcalendar/main.min.js"></script>
<script src="assets/js/DNDWebMaintenanceCalendar.js"></script>

</html>