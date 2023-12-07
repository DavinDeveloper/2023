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
                            <h4 class="page-title">Users Settings</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table dt-responsive ">
                                    <thead>
                                        <tr>
                                            <th>Id Users</th>
                                            <th>Username</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Departement</th>
                                            <th>Unit</th>
                                            <th>Akses</th>
                                            <th>Create Date</th>
                                            <th>Status</th>
                                            <th style="width: 100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $allowedRoles = array("teknisi", "member"); // List of allowed roles
                                            $sql = "SELECT * FROM `users` WHERE hakakses IN ('" . implode("', '", $allowedRoles) . "')";
                                            $query = $db->prepare($sql);
                                            $query->execute();
                                    
                                            while($fetch = $query->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fetch['id']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['username']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['number_phone']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['email']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['department']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['unit']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['hakakses']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['date_created']?>
                                            </td>
                                            <td>
                                                <?php 
                                            if ($fetch['status'] == 1){
                                                echo '
                                                <span class="badge badge-success-lighten">Active</span>';
                                            }else{
                                                echo '
                                                <span class="badge badge-danger-lighten">In Active</span>';
                                            }
                                                ?>
                                            </td>

                                            <td>
                                                <?php 
                                                echo '<a onclick="updateakses('.$fetch['id'].')" class="btn btn-outline-primary mdi mdi-square-edit-outline"></a>&nbsp;
                                                <a onclick="deleteusers('.$fetch['id'].')" class="btn btn-outline-danger mdi mdi-delete"></a>
                                                '
                                                ?>
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
        <!-- content -->

        <!-- Modal -->
        <div class="modal fade" id="updateakses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="hkupdate">Hak Akses : </label>
                            <select id="hkupdate" required="" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="teknisi">Teknisi</option>
                                <option value="member">Member</option>
                            </select>
                            <br>
                            <label for="statusakun">Status Akun : </label>
                            <select id="statusakun" required="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                            <br>
                            <?php

                            // Fetch data from the database
                            try {
                                $sql = "SELECT id_department, nama_department FROM `department`";
                                $stmt = $db->query($sql);
                                $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch(PDOException $e) {
                                echo 'ERROR: ' . $e->getMessage();
                            }

                            // Generate the HTML for the select options
                            foreach ($departments as $department) {
                                $selectOptions .= '<option value="' . $department['nama_department'] . '">' . $department['nama_department'] . '</option>';
                            }
                            ?>

                            <label for="department">Departement Akun : </label>
                            <select id="department" required="" class="form-control">
                                <?php echo $selectOptions; ?>
                            </select>
                            <br>

                            <?php

                            // Fetch data from the database
                            try {
                                $sql = "SELECT id_unit, singkatan_unit FROM `unit`";
                                $stmt = $db->query($sql);
                                $units = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch(PDOException $e) {
                                echo 'ERROR: ' . $e->getMessage();
                            }

                            // Generate the HTML for the select options
                            foreach ($units as $unit) {
                                $selectUnit .= '<option value="' . $unit['singkatan_unit'] . '">' . $unit['singkatan_unit'] . '</option>';
                            }
                            ?>

                            <label for="unit">Unit Akun : </label>
                            <select id="unit" required="" class="form-control">
                                <?php echo $selectUnit; ?>
                            </select>
                            
                        </div>
                        <input type="hidden" id="hidden_user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="aksesupdate()">Update</button>
                    </div> <!-- end modal footer -->
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->

        <!-- Modal -->
        <div class="modal fade" id="deleteusers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <h5 style="text-align:center;">Kamu Yakin, Ingin Delete Akun Ini ?</h5>
                        <input type="hidden" id="hidden_delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" onclick="aksesdelete()">Delete</button>
                    </div> <!-- end modal footer -->
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
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
    function updateakses(id) {
        $("#hidden_user_id").val(id);
        $.ajax({
            type: "POST",
            timeout: 6000,
            data: {
                id: id
            }, // add if using post
            dataType: 'json', //text
            crossDomain: false,
            cache: false,
            async: true,
            url: "fungsi/cek_aksesakun.php",
            success: function (data) {
                var datadepartment = data.department;
                var dataunit = data.unit;
                var datahakakses = data.hakakses;
                var datastatus = data.status;

                $("#department").val(datadepartment);
                $("#unit").val(dataunit);
                $("#hkupdate").val(datahakakses);
                $("#statusakun").val(datastatus);
                $("#updateakses").modal("show");
            }
        });
    }

    function aksesupdate() {
        // get values
        var level = $("#hkupdate").val();
        var status = $("#statusakun").val();
        var department = $("#department").val();
        var unit = $("#unit").val();

        // get hidden field value
        var id = $("#hidden_user_id").val();

        $.ajax({
            type: "POST",
            timeout: 6000,
            data: {
                id: id,
                department: department,
                unit: unit,
                level: level,
                status: status
            }, // add if using post
            dataType: 'json', //text
            crossDomain: false,
            cache: false,
            async: true,
            url: "fungsi/proses_hkupdate.php",
            success: function (data) {
                $("#updateakses").modal("hide");
                location.reload();
            }
        });
    }

    function deleteusers(id) {
        // Add User ID to the hidden field for furture usage
        $("#hidden_delete_id").val(id);
        $("#deleteusers").modal("show");
    }

    function aksesdelete() {
        // get hidden field value
        var id = $("#hidden_delete_id").val();

        // Update the details by requesting to the server using ajax
        $.post("./fungsi/proses_deleteakun.php", {
                id: id
            },
            function (data, status) {
                // hide modal popup
                $("#deleteusers").modal("hide");
                // reload Users by using readRecords();
                location.reload();
            }
        );
    }
</script>

</body>

</html>