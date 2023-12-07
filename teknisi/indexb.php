<?php require_once("auth.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Helpdesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/ines.jpg"> *untuk logo diatas dashboar*

    <!-- third party css -->
    <link href="../assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->

    <!-- App css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <!-- LOGO -->
            <center>
                <h2>IT HELPDESK </h2>
            </center>

            </a>
            <!--- Sidemenu -->
            <ul class="side-nav">
                <a href="index.html" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
                </l>
                <ul class="side-nav">
                    <a href="ticket-activity.html" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> ticket-activity</span>
                    </a>
                    </l>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarticket" aria-expanded="false"
                            aria-controls="sidebarticket" class="side-nav-link">
                            <i class="uil-store"></i>
                            <span> Ticket </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarticket">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="ticket.html">Ticket</a>
                                </li>
                                <li>
                                    <a href="apps-details-ticket.html">Details Ticket</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <ul class="side-nav">
                        <a href="user.html" class="side-nav-link">
                            <i class="uil-table"></i>
                            <span> User </span>
                        </a>
                        </l>
                        <ul class="side-nav">
                            <a href="apps-kanban.html" class="side-nav-link">
                                <i class="uil-clipboard-alt"></i>
                                <span> Knowledgebase</span>
                            </a>
                            </l>


                            <li class="side-nav-item">
                                <a href="apps-file-manager.html" class="side-nav-link">
                                    <i class="uil-folder-plus"></i>
                                    <span> File Manager </span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false"
                                    aria-controls="sidebarLayouts" class="side-nav-link">
                                    <i class="uil-window"></i>
                                    <span> Layouts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
                                    <ul class="side-nav-second-level">
                                        <li>
                                            <a href="layouts-horizontal.html">Horizontal</a>
                                        </li>
                                        <li>
                                            <a href="layouts-detached.html">Detached</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarForms" aria-expanded="false"
                                    aria-controls="sidebarForms" class="side-nav-link">
                                    <i class="uil-document-layout-center"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="side-nav-second-level">
                                        <li>
                                            <a href="form-penilaian.html">Form Survei Karyawan</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- End Sidebar -->

                            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topbar-menu float-end mb-0">
                    <li class="dropdown notification-list d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">
                            <div style="max-height: 230px;" data-simplebar="">
                            </div>
                    </li>
                    <li class="dropdown notification-list d-none d-sm-inline-block">

                    <li class="notification-list">
                        <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                            <i class="dripicons-gear noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="../assets/images/ines.jpg" alt="user-image" class="rounded-circle">
                            </span>
                            <span>
                                <span class="account-user-name">Admin</span>

                            </span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-edit me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-lifebuoy me-1"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-lock-outline me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="../logout.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="button-menu-mobile open-left">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="app-search dropdown d-none d-lg-block">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control dropdown-toggle" placeholder="Search..."
                                id="top-search">
                            <span class="mdi mdi-magnify search-icon"></span>
                            <button class="input-group-text btn-primary" type="submit">Search</button>
                        </div>
                    </form>

                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">

                    </div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-6">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-account-multiple widget-icon"></i>
                                        </div>

                                        <center>
                                            <h3><a href="ticket-created.html">Created</a> <i class="uil-home-alt"></i>
                                                <h4 class="mt-3 mb-3">25</h4>
                                                <center>
                                            </h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-lg-3">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-cart-plus widget-icon"></i>
                                        </div>
                                        <center>
                                            <h3> <a href="ticket-closed.html">Closed</a>
                                                <h4 class="mt-3 mb-3">15</h4>
                                                <center>
                                            </h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <!-- end row -->

                            <!--div class="row"-->
                            <div class="col-lg-3">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-currency-usd widget-icon"></i>
                                        </div>
                                        <center>
                                            <h3> <a href="ticket.html">Assigned</a>
                                                <h4 class="mt-3 mb-3">5</h4>
                                                <center>
                                            </h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-lg-3">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <i class="mdi mdi-pulse widget-icon"></i>
                                        </div>
                                        <center>
                                            <h3> <a href="ticket.html">Overdue</a>
                                                <h4 class="mt-3 mb-3">10</h4>
                                                <center>
                                            </h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end col -->

                    <div class="col-xl-12 col-lg-6">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                </div>
                                <h4 class="header-title mb-3">Ticket Activity</h4>

                                <div dir="ltr">
                                    <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#e3eaef">
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <h4 class="header-title mb-3">Revenue</h4>

                                <div class="chart-content-bg">
                                    <div class="row text-center">
                                        <div class="col-md-6">
                                            <p class="text-muted mb-0 mt-3">Current Week</p>
                                            <h2 class="fw-normal mb-3">
                                                <small
                                                    class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                                <span>$58,254</span>
                                            </h2>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted mb-0 mt-3">Previous Week</p>
                                            <h2 class="fw-normal mb-3">
                                                <small
                                                    class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                                <span>$69,524</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                                    <h5>Today's Earning: $2,562.30</h5>
                                    <p class="text-muted font-13 mb-3 mt-2">Etiam ultricies nisi vel augue. Curabitur
                                        ullamcorper ultricies nisi. Nam eget dui.
                                        Etiam rhoncus...</p>
                                    <a href="javascript: void(0);" class="btn btn-outline-primary">View Statements
                                        <i class="mdi mdi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <div dir="ltr">
                                    <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97">
                                    </div>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->


                    <div class="row">
                        <div class="col-xl-30 col-lg-12 order-lg-2 order-xl-1">
                            <div class="card">
                                <div class="card-body">
                                    <a href="" class="btn btn-sm btn-link float-end">Export
                                        <i class="mdi mdi-download ms-1"></i>
                                    </a>
                                    <h4 class="header-title mt-2 mb-2">Statistics</h4>
                                    <h5 class="title mt-4 mb-2"> Statistics of tickets organized by department, help
                                        topic, and agent </h5>


                                    <div class="table-nowrap">
                                        <table class="table table-centered table-nowrap table-hover mb-0">

                                            </tbody>
                                            <tr>
                                                <th>
                                                    <h4>Departement</h4>
                                                </th>
                                                <th>
                                                    <h4>Opened </h4>
                                                </th>
                                                <th>
                                                    <h4>Assigned</h4>
                                                </th>
                                                <th>
                                                    <h4>Closed </h4>
                                                </th>
                                                <th>
                                                    <h4>Reopened</h4>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>Support</td>
                                                <td>1</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Development</td>
                                                <td>1</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>HRD</td>
                                                <td>1</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Land Management</td>
                                                <td>1</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Finance</td>
                                                <td>1</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Helpdesk-2023
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="end-bar">

        <div class="rightbar-title">
            <a href="javascript:void(0);" class="end-bar-toggle float-end">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <div class="rightbar-content h-100" data-simplebar="">

            <div class="p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <!-- Settings -->
                <!-- Layouts -->

                <h5 class="mt-3">Custome Layouts</h5>
                <hr class="mt-1">

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="layouts-horizontal" value="Layouts"
                        id="layouts-horizontal" checked="">
                    <label class="form-check-label" for="layouts-horizontal">Horizontal</label>
                </div>
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="layouts-detached" value=""
                        id="layouts-detached" checked="">
                    <label class="form-check-label" for="layouts-detached">Detached</label>
                </div>

                <h5 class="mt-3">Color Scheme</h5>
                <hr class="mt-1">

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light"
                        id="light-mode-check" checked="">
                    <label class="form-check-label" for="light-mode-check">Light Mode</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark"
                        id="dark-mode-check">
                    <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                </div>


                <!-- Width -->
                <h5 class="mt-4">Width</h5>
                <hr class="mt-1">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check"
                        checked="">
                    <label class="form-check-label" for="fluid-check">Fluid</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                    <label class="form-check-label" for="boxed-check">Boxed</label>
                </div>


                <!-- Left Sidebar-->
                <h5 class="mt-4">Left Sidebar</h5>
                <hr class="mt-1">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                    <label class="form-check-label" for="default-check">Default</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check"
                        checked="">
                    <label class="form-check-label" for="light-check">Light</label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                    <label class="form-check-label" for="dark-check">Dark</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check"
                        checked="">
                    <label class="form-check-label" for="fixed-check">Fixed</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="condensed"
                        id="condensed-check">
                    <label class="form-check-label" for="condensed-check">Condensed</label>
                </div>

                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="compact" value="scrollable"
                        id="scrollable-check">
                    <label class="form-check-label" for="scrollable-check">Scrollable</label>
                </div>

                <div class="d-grid mt-4">
                    <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                </div>
            </div> <!-- end padding-->

        </div>
    </div>

    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- bundle -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="../assets/js/vendor/apexcharts.min.js"></script>
    <script src="../assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
    <script></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="../assets/js/pages/demo.dashboard.js"></script>
    <!-- end demo js-->
</body>

</html>