<?php require_once("auth.php"); 

require_once '../config.php';
$user_id = $_SESSION['user']['id'];

// SQL queries to count tickets
$query_created = "SELECT COUNT(*) FROM tiket WHERE t_users = :user_id AND t_status = 'Pending'";
$query_closed = "SELECT COUNT(*) FROM tiket WHERE t_users = :user_id AND t_status = 'Closed'";
$query_assigned = "SELECT COUNT(*) FROM tiket WHERE t_users = :user_id AND t_status = 'Assigned'";
// Count overdue tickets using date comparison
$query_overdue = "SELECT COUNT(*) FROM tiket WHERE t_users = :user_id AND (t_due_date < NOW() AND t_status != 'Closed') OR t_status = 'Overdue'";


// Count Created tickets
$created_count = $db->prepare($query_created);
$created_count->bindParam(':user_id', $user_id);
$created_count->execute();
$created_tickets = $created_count->fetchColumn();

// Count Created tickets
$closed_count = $db->prepare($query_closed);
$closed_count->bindParam(':user_id', $user_id);
$closed_count->execute();
$closed_tickets = $closed_count->fetchColumn();

// Count Created tickets
$assigned_count = $db->prepare($query_assigned);
$assigned_count->bindParam(':user_id', $user_id);
$assigned_count->execute();
$assigned_tickets = $assigned_count->fetchColumn();

// Count overdue tickets
$overdue_count = $db->prepare($query_overdue);
$overdue_count->bindParam(':user_id', $user_id);
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
               
                <?php include 'template/topbar.php'; ?>
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <form class="d-flex">
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
    <script src="../assets/js/pages/demo.dashboard.js"></script>
    <!-- end demo js-->
</body>

</html>