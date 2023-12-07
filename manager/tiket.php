<?php require_once("auth.php"); 
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
                                <!-- isi -->
                            </div>
                            <h4 class="page-title">Ticket List</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <form method="GET" action="tiket.php">
                                        <div class="row mb-2">
                                            <div class="col-sm-2">
                                                <input type="date" class="form-control" id="start_date" name="start_date">
                                                <label for="start_date">Start</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="date" class="form-control" id="end_date" name="end_date">
                                                <label for="end_date">End</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                                <a class="btn btn-danger" href="tiket.php?1=1">URGENT</a>
                                                <a class="btn btn-warning" href="tiket.php?1=2">SPECIAL REQUEST</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <table id="datatable-buttons" class="table dt-responsive ">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th style="width:5%">Ticket Id</th>
                                            <th style="width:15%">Date Created</th>
                                            <th style="width:17%">Due Date</th>
                                            <th style="width:15%">Update Date</th>
                                            <th>Priority</th>
                                            <th>Subject</th>
                                            <th>From</th>
                                            <th>Assigned To</th>
                                            <th>Units</th>
                                            <th>Poin</th>
                                            <th>Pengerjaan</th>
                                            <th>Status</th>
                                            <th>Topic</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $userID = $_SESSION["user"]["id"];
                                            
                                            $start_date = $_GET['start_date'] ?? null;
                                            $end_date = $_GET['end_date'] ?? null;

                                            if ($start_date && $end_date) {
                                                $start_date_formatted = date('Y-m-d H:i:s', strtotime($start_date));
                                                $end_date_formatted = date('Y-m-d H:i:s', strtotime($end_date));

                                                $sql = "SELECT * FROM `tiket` WHERE STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p') BETWEEN :start_date AND :end_date AND t_priority != 0";
                                                $query = $db->prepare($sql);
                                                $query->bindParam(':start_date', $start_date_formatted);
                                                $query->bindParam(':end_date', $end_date_formatted);
                                            } else if ($_GET['1'] == '') {
                                                $sql = "SELECT * FROM `tiket` WHERE t_priority != 0";
                                                $query = $db->prepare($sql);
                                            } else if ($_GET['1'] == 0 OR $_GET['1'] == 1 OR $_GET['1'] == 2) {
                                                $priority = $_GET['1'];
                                                $sql = "SELECT * FROM `tiket` WHERE t_priority = :priority AND t_priority != 0";
                                                $query = $db->prepare($sql);
                                                $query->bindParam(':priority', $priority, PDO::PARAM_INT);
                                            }

                                            $query->execute();
                                            while($fetch = $query->fetch()){
                                                $sql = "SELECT number_phone FROM users WHERE id = '".$fetch['t_assigned']."'";
                                                $check_user = $db->prepare($sql);
                                                $check_user->execute();
                                                $data_user = $check_user->fetch();
                                                if (!empty($fetch['t_date_start']) && !empty($fetch['t_date_end'])) {
                                                    $t_date_start = DateTime::createFromFormat('d-m-Y h:i a', $fetch['t_date_start']);
                                                    $t_date_end = DateTime::createFromFormat('d-m-Y h:i a', $fetch['t_date_end']);
                                                    
                                                    $interval = $t_date_start->diff($t_date_end);
                                                    $minutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i; // Menghitung total menit
                                            
                                                    $pengerjaan = $minutes . " menit";
                                                } else {
                                                    $pengerjaan = "-";
                                                }
                                        ?>
                                        <tr>
                                            <td>
                                                # <?php echo $fetch['id_tiket']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['t_created_date']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['t_due_date']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['t_update_date']?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if ($fetch['t_priority'] == 1){
                                                        echo '<span class="badge badge-danger-lighten">URGENT</span>';
                                                    }else if ($fetch['t_priority'] == 0){
                                                        echo '<span class="badge badge-success-lighten">NORMAL</span>';
                                                    }else if ($fetch['t_priority'] == 2){
                                                        echo '<span class="badge badge-warning-lighten">SPECIAL REQUEST</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['t_subject']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['n_users']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['n_assigned']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['n_unit']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['n_poin']?>
                                            </td>
                                            <td>
                                            <?php echo $pengerjaan?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['t_status']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['n_topic']?>
                                            </td>
                                            <td>
                                                <?php 
                                                echo '
                                                <a onclick="cektiketdata('.$fetch['id_tiket'].')" class="btn btn-outline-primary mdi mdi-eye"></a>
                                                '
                                                ?>
                                                <?php
                                                if ($fetch['t_priority'] == 1) {
                                                    $teks = "Urgent";
                                                } else if ($fetch['t_priority'] == 2) {
                                                    $teks = "Special Request";
                                                }
                                                ?>
                                                <a href="https://wa.me/<?php echo $data_user['number_phone']; ?>?text=Halo <?php echo $fetch['n_assigned']; ?>, ada tiket <?php echo $teks; ?> nih, segera di cek ya" class="btn btn-outline-primary mdi mdi-telegram"></a>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                        ?>
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->

            </div>
            <!-- container -->
        </div>

        <!--  Task details modal -->
        <div class="modal fade task-modal-content" id="cektiketdata" tabindex="-1" role="dialog"
            aria-labelledby="TaskDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <input type="hidden" id="hidden_tiket_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="TaskDetailModalLabel">Ticket # <span id="tiketid"></span> 
                        <span id="priority"></span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-2">
                            <h5 class="mt-0">Subject : <span id="subject"></span></h5>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <h5>Status</h5>
                                        <!-- <div id="t_status"></div> -->
                                        <select id="t_status" class="form-control">
                                            <option value="Pending">Pending</option>
                                            <option value="Assigned">Assigned</option>
                                            <option value="Process">Process</option>
                                            <option value="Closed">Closed</option>
                                            <option value="Overdue">Overdue</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>User</h5>
                                        <div id="n_users"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" id="tooltip-container">
                                        <h5>Email </h5>
                                        <div id="n_email"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3" id="tooltip-container">
                                        <h5>Organization </h5>
                                        <div>( <span id="n_unit"></span> )</div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row-->

                            <div class="row">
                                <div class="col-md-3">
                                <div class="mb-3">
                                    <h5>Assigned To</h5>
                                    <select id="id_assigned" class="form-control">
                                        <?php
                                        try {
                                            $sql = "SELECT `id`, `name` FROM `users` WHERE hakakses IN ('teknisi', 'admin')";
                                            $stmt = $db->query($sql);
                                            $teknisis = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($teknisis as $teknisi) {
                                                echo '<option value="' . $teknisi['id'] . '">' . $teknisi['name'] . '</option>';
                                            }
                                        } catch (PDOException $e) {
                                            echo 'ERROR: ' . $e->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>Topic</h5>
                                        <div id="n_topic"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>Departement </h5>
                                        <div id="n_department"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>Create Date </h5>
                                        <div id="t_created_date"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row-->

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>Due Date </h5>
                                        <div id="t_due_date"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <h5>Last Update</h5>
                                        <div id="t_update_date"></div>
                                </div>
                            </div>
                            <!-- end row-->

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link active">
                                        Ticket Thread
                                    </a>
                                </li>
                            </ul>

                            <div class="d-flex mt-0">
                                <div class="w-100">
                                    <h5 id="t_users_thread"></h5>
                                    <div class="com-text form-control form-control-light mb-2">
                                        <pre id="t_thread"></pre>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link active">
                                        Reply Thread
                                    </a>
                                </li>
                            </ul>
                            <input type="hidden" id="hidden_update_tiket_id"></input>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="home-b1">
                                    <div class="d-flex mt-0">
                                        <div class="w-100">
                                            <h5 id="t_assign_thread"></h5>
                                            <div class="com-text form-control form-control-light mb-2">
                                                <pre id="t_reply_thread"></pre>
                                            </div>
                                            <div class="text-end">
                                                <div class="btn-group mb-2 ms-2 d-none d-sm-inline-block">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="tiketupdate()">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .p-2 -->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <?php include 'template/footer.php'; ?>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->
<!-- bundle -->
<script src="../assets/js/vendor.min.js"></script>
<script src="../assets/js/app.min.js"></script>

<!-- dragula js-->
<script src="../assets/js/vendor/dragula.min.js"></script>

<!-- third party js -->
<script src="../assets/js/vendor/jquery.dataTables.min.js"></script>
<script src="../assets/js/vendor/dataTables.bootstrap5.js"></script>
<script src="../assets/js/vendor/dataTables.responsive.min.js"></script>
<script src="../assets/js/vendor/responsive.bootstrap5.min.js"></script>
<script src="../assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="../assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="../assets/js/vendor/buttons.html5.min.js"></script>
<script src="../assets/js/vendor/buttons.flash.min.js"></script>
<script src="../assets/js/vendor/buttons.print.min.js"></script>
<script src="../assets/js/vendor/dataTables.keyTable.min.js"></script>
<script src="../assets/js/vendor/dataTables.select.min.js"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="../assets/js/pages/demo.datatable-init.js"></script>
<script src="../assets/js/ui/component.dragula.js"></script>
<!-- end demo js-->

<script type="text/javascript">

    function cektiketdata(id) {
        $("#hidden_tiket_id").val(id);
        
        $.ajax({
            type: "POST",
            timeout: 6000,
            data: {
                id: id
            },
            dataType: 'json',
            crossDomain: false,
            cache: false,
            async: true,
            url: "fungsi/cek_tiket.php",
            success: function (data) {
                // Access the JSON properties
                var id_tiket = data.id_tiket;
                var t_subject = data.t_subject;
                var t_status = data.t_status;
                var t_users = data.t_users;
                var t_email = data.t_email;
                var t_unit = data.t_unit;
                var t_topic = data.t_topic;
                var t_department = data.t_department;
                var t_assigned = data.t_assigned;
                var t_priority = data.t_priority;

                var n_users = data.n_users;
                var n_email = data.n_email;
                var n_unit = data.n_unit;
                var n_topic = data.n_topic;
                var n_department = data.n_department;
                var n_assigned = data.n_assigned;
                
                var t_created_date = data.t_created_date;
                var t_due_date = data.t_due_date;
                var t_update_date = data.t_update_date;
                var t_thread = data.t_thread;
                var t_reply_thread = data.t_reply_thread;

                // console.log(t_status);
                // // ... and so on for other columns

                // Use the values as needed
                $("#tiketid").text(id_tiket);
                $("#subject").text(t_subject);
                $("#t_status").val(t_status);
                $("#id_assigned").val(t_assigned);
                
                // Determine the badge class based on t_priority
                var badgeClass = priority === 1 ? 'bg-danger' : 'bg-success';

                // Generate the badge HTML
                if(priority == 1){
                    var priorityBadgeHTML = '<span class="badge bg-danger ms-2"> Urgent</span>';
                }else if(priority == 0){
                    var priorityBadgeHTML = '<span class="badge bg-success ms-2"> Normal</span>';
                }else if(priority == 2){
                    var priorityBadgeHTML = '<span class="badge bg-warning ms-2"> Special Request</span>';
                }

                // // Set the badge HTML in the element
                $("#priority").html(priorityBadgeHTML);
                
                $("#n_users").html(n_users);
                $("#n_email").html(n_email);
                $("#n_unit").html(n_unit);
                $("#n_assigned").html(n_assigned);
                $("#n_topic").html(n_topic);
                $("#n_department").html(n_department);

                $("#t_users_thread").html(n_users);
                $("#t_assign_thread").html(n_assigned);
                
                $("#t_created_date").html(t_created_date);
                $("#t_due_date").html(t_due_date);
                $("#t_update_date").html(t_update_date);
                $("#t_thread").html(t_thread);
                $("#t_reply_thread").html(t_reply_thread);

                // ... and so on for other elements
                $("#cektiketdata").modal("show");
            }
        });
    }

    function tiketupdate() {
        // get values
        var id_assigned = $("#id_assigned").val();
        var update_status = $("#t_status").val();

        // get hidden field value
        var id = $("#hidden_tiket_id").val();

        $.ajax({
            type: "POST",
            timeout: 6000,
            data: {
                id: id,
                id_assigned: id_assigned,
                update_status: update_status
            }, // add if using post
            dataType: 'json', //text
            crossDomain: false,
            cache: false,
            async: true,
            url: "fungsi/proses_assigned.php",
            success: function (data) {
                $("#cektiketdata").modal("hide");
                location.reload();
            }
        });
    }

</script>
</body>

</html>