<?php
require_once("auth.php");
require_once '../config.php';

// Calculate the start date for the last 7 days
$start_date = date('Y-m-d', strtotime('-7 days'));

// SQL queries to count tickets within the last 7 days
$query_created = "SELECT COUNT(*) FROM tiket WHERE t_status = 'Pending' AND DATE(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p')) BETWEEN '$start_date' AND NOW()";
$query_closed = "SELECT COUNT(*) FROM tiket WHERE t_status = 'Closed' AND DATE(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p')) BETWEEN '$start_date' AND NOW()";
$query_assigned = "SELECT COUNT(*) FROM tiket WHERE t_status = 'Assigned' AND DATE(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p')) BETWEEN '$start_date' AND NOW()";
$query_overdue = "SELECT COUNT(*) FROM tiket WHERE (t_due_date < NOW() AND t_status != 'Closed' AND DATE(STR_TO_DATE(t_due_date, '%d-%m-%Y %h:%i %p')) BETWEEN '$start_date' 
                                                                                                                  AND NOW()) OR (t_status = 'Overdue' AND DATE(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p')) BETWEEN '$start_date' AND NOW())";

// Create an array of dates for the desired date range (e.g., last 7 days)
$dateRange = [];
$endDate = new DateTime(); // Current date

for ($i = 6; $i >= 0; $i--) {
    $dateRange[] = $endDate->format('Y-m-d');
    $endDate->modify('-1 day');
}

// Initialize arrays to store the data for different ticket statuses
$pendingTicketData = [];
$assignedTicketData = [];
$closedTicketData = [];
$overdueTicketData = [];
$dateData = []; // Common date data array

// Loop through the date range
foreach ($dateRange as $date) {
    // Fetch ticket creation data for "Pending" tickets for each date
    $query_pending_created = "SELECT COUNT(*) AS created_count FROM tiket
                           WHERE t_status = 'Pending'
                           AND DATE_FORMAT(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p'), '%Y-%m-%d') = :date";
    
    $stmt_pending = $db->prepare($query_pending_created);
    $stmt_pending->bindParam(':date', $date);
    $stmt_pending->execute();
    
    $row_pending = $stmt_pending->fetch(PDO::FETCH_ASSOC);
    
    // Store the data in the arrays for "Pending" tickets
    $pendingTicketData[] = (int)$row_pending['created_count'];
    
    // Fetch ticket creation data for "Assigned" tickets for each date
    $query_assigned_created = "SELECT COUNT(*) AS created_count FROM tiket
                           WHERE t_status = 'Assigned'
                           AND DATE_FORMAT(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p'), '%Y-%m-%d') = :date";
    
    $stmt_assigned = $db->prepare($query_assigned_created);
    $stmt_assigned->bindParam(':date', $date);
    $stmt_assigned->execute();
    
    $row_assigned = $stmt_assigned->fetch(PDO::FETCH_ASSOC);
    
    // Store the data in the arrays for "Assigned" tickets
    $assignedTicketData[] = (int)$row_assigned['created_count'];
    
    // Fetch ticket creation data for "Closed" tickets for each date
    $query_closed_created = "SELECT COUNT(*) AS created_count FROM tiket
                           WHERE t_status = 'Closed'
                           AND DATE_FORMAT(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p'), '%Y-%m-%d') = :date";
    
    $stmt_closed = $db->prepare($query_closed_created);
    $stmt_closed->bindParam(':date', $date);
    $stmt_closed->execute();
    
    $row_closed = $stmt_closed->fetch(PDO::FETCH_ASSOC);
    
    // Store the data in the arrays for "Closed" tickets
    $closedTicketData[] = (int)$row_closed['created_count'];
    
    // Fetch ticket creation data for "Overdue" tickets for each date
    $query_overdue_created = "SELECT COUNT(*) AS created_count FROM tiket
                            WHERE t_status = 'Overdue'
                            AND DATE_FORMAT(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p'), '%Y-%m-%d') = :date";
    
    $stmt_overdue = $db->prepare($query_overdue_created);
    $stmt_overdue->bindParam(':date', $date);
    $stmt_overdue->execute();
    
    $row_overdue = $stmt_overdue->fetch(PDO::FETCH_ASSOC);
    
    // Store the data in the arrays for "Overdue" tickets
    $overdueTicketData[] = (int)$row_overdue['created_count'];
    
    // Store the date in the common date data array
    $dateData[] = $date;
}



// Count Created tickets
$created_count = $db->prepare($query_created);
$created_count->execute();
$created_tickets = $created_count->fetchColumn();

// Count Created tickets
$closed_count = $db->prepare($query_closed);
$closed_count->execute();
$closed_tickets = $closed_count->fetchColumn();

// Count Created tickets
$assigned_count = $db->prepare($query_assigned);
$assigned_count->execute();
$assigned_tickets = $assigned_count->fetchColumn();

// Count overdue tickets
$overdue_count = $db->prepare($query_overdue);
$overdue_count->execute();
$overdue_tickets = $overdue_count->fetchColumn();

?>
<!-- Begin page -->

    <?php include 'template/header.php'; ?>
    
    <div class="wrapper">
        <?php include 'template/sidebar.php'; ?>
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="../assets/images/users/avatar-6.jpg" alt="user-image" class="rounded-circle">
                                </span>
                                <span>
                                    <span class="account-user-name"><?php echo $_SESSION["user"]["name"] ?></span>
                                    <span class="account-position"><?php echo $_SESSION["user"]["hakakses"] ?></span>
                                </span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome <?php echo $_SESSION["user"]["hakakses"] ?> <?php echo $_SESSION["user"]["name"] ?> !</h6>
                                </div>

                                <!-- item-->
                                <a href="profile.php" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
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
                        <!-- <form>
                            <div class="input-group">
                                <input type="text" class="form-control dropdown-toggle" placeholder="Search..."
                                    id="top-search">
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button class="input-group-text btn-primary" type="submit">Search</button>
                            </div>
                        </form> -->
                    </div>
                </div>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <form class="d-flex">
                                        <!-- <h5 class="mx-1">Timeframe:</h5>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control" id="dash-daterange-to" readonly>
                                            <span class="input-group-text bg-primary border-primary text-white">
                                                <i class="mdi mdi-calendar-range font-13"></i>
                                            </span>
                                        </div> -->
                                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                            <i class="mdi mdi-autorenew"></i>
                                        </a>
                                    </form>
                                </div>
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text fw-normal mt-0" style="color:#0000ff;">Created</h5>
                                    <h3 class="mt-2 mb-2"><?php echo $created_tickets; ?></h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text fw-normal mt-0" title="Number of Orders" style="color:#00e600;">Closed</h5>
                                    <h3 class="mt-2 mb-2" ><?php echo $closed_tickets; ?></h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text fw-normal mt-0" style="color:#ff0000;">Assigned</h5>
                                    <h3 class="mt-2 mb-2"><?php echo $assigned_tickets; ?></h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-3">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <h5 class="text fw-normal mt-0" style="color:#e6e600;">Overdue</h5>
                                    <h3 class="mt-2 mb-2"><?php echo $overdue_tickets; ?></h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title mb-3">Ticket Activity</h4>

                                    <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                                        
                                    </div>
                                    <div dir="ltr">
                                        <div id="revenue-chart" class="apex-charts mt-3" >
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container -->

            </div>
            <!-- content -->
            <?php include 'template/footer.php'; ?>
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <!-- bundle -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="../assets/js/vendor/apexcharts.min.js"></script>
    <script src="../assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script>
    var pendingTicketData = <?php echo json_encode($pendingTicketData); ?>;
    var assignedTicketData = <?php echo json_encode($assignedTicketData); ?>;
    var closedTicketData = <?php echo json_encode($closedTicketData); ?>;
    var overdueTicketData = <?php echo json_encode($overdueTicketData); ?>;
    var dateData = <?php echo json_encode($dateData); ?>;

    !function(o) {
        "use strict";

        function e() {
            this.$body = o("body"), this.charts = []
        }
        e.prototype.initCharts = function() {
            window.Apex = {
                chart: {
                    parentHeightOffset: 0,
                    toolbar: {
                        show: !1
                    }
                },
                grid: {
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                colors: ["#0000ff", "#00e600", "#ff0000", "#e6e600"]
            };

            var e = o("#revenue-chart").data("colors");
            var t = e ? e.split(",") : ["#0000ff", "#00e600", "#ff0000", "#e6e600"];

            var r = {
                chart: {
                    height: 364,
                    type: "line",
                    dropShadow: {
                        enabled: !0,
                        opacity: .2,
                        blur: 7,
                        left: -7,
                        top: 7
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                markers: {
                    size: 5,
                },
                stroke: {
                    curve: "straight",
                    width: 2
                },
                series: [{
                    name: "Pending",
                    data: pendingTicketData
                }, {
                    name: "Assigned",
                    data: assignedTicketData
                }, {
                    name: "Closed",
                    data: closedTicketData
                }, {
                    name: "Overdue",
                    data: overdueTicketData
                }],
                colors: t,
                zoom: {
                    enabled: !1
                },
                xaxis: {
                    type: "datetime",
                    categories: dateData,
                    labels: {
                        format: 'dd/MM/yyyy',
                    },
                    tooltip: {
                        enabled: true
                    },
                    axisBorder: {
                        show: true
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(e) {
                            return parseInt(e, 10);
                        },
                        offsetX: -15
                    }
                }
            };
            new ApexCharts(document.querySelector("#revenue-chart"), r).render();
        };
        e.prototype.init = function() {
            this.initCharts();
        };
        o.Dashboard = new e, o.Dashboard.Constructor = e
    }(window.jQuery);

    (function(t) {
        "use strict";
        t(document).ready(function(e) {
            t.Dashboard.init()
        })
    })(window.jQuery);
</script>


    <!-- end demo js-->
</body>

</html>