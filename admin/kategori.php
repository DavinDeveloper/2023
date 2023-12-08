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
                            <h4 class="page-title">Kategori</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <a href="javascript:void(0);" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modaldp"><i
                                                class="mdi mdi-plus-circle me-2"></i> Add Kategori</a>
                                    </div>
                                </div>
                                <table id="datatable-buttons" class="table dt-responsive ">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Nama Kategori</th>
                                            <th>Create Date</th>
                                            <th>Update Date</th>
                                            <th style="width: 100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `kategori`";
                                        $query = $db->prepare($sql);
                                        $query->execute();
                                        $rowNumber = 0; // Initialize the row number
                                
                                        while($fetch = $query->fetch()){
                                            $rowNumber++; // Increment the row number
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $rowNumber; ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['nama_kategori']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['date_created']?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['date_updated']?>
                                            </td>
                                            <td>
                                                <?php 
                                            echo '<a onclick="updateakses('.$fetch['id_kategori'].')" class="btn btn-outline-primary mdi mdi-square-edit-outline"></a>&nbsp;
                                            <a onclick="deleteusers('.$fetch['id_kategori'].')" class="btn btn-outline-danger mdi mdi-delete"></a>
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
        <div class="modal fade" id="modaldp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Insert Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namakategori" class="mb-1">Kategori : </label>
                            <input class="form-control" type="text" id="namakategori">
                        </div>
                        <input type="hidden" id="hidden_user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="dpinsert()">Submit</button>
                    </div> <!-- end modal footer -->
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->

        <!-- Modal -->
        <div class="modal fade" id="updateakses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori" class="mb-1">Kategori : </label>
                            <input class="form-control" type="text" id="kategori">
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
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <h5 style="text-align:center;">Kamu Yakin, Ingin Delete Kategori Ini ?</h5>
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
<script src="../assets/js/pages/table.desc.js"></script>
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
            url: "fungsi/cek_kategori.php",
            success: function (data) {
                var datakategori = data.nama_kategori;

                $("#kategori").val(datakategori);
                $("#updateakses").modal("show");
            }
        });
    }

    function aksesupdate() {
        // get values
        var kategori = $("#kategori").val();

        // get hidden field value
        var id = $("#hidden_user_id").val();

        $.ajax({
            type: "POST",
            timeout: 6000,
            data: {
                id: id,
                kategori: kategori
            }, // add if using post
            dataType: 'json', //text
            crossDomain: false,
            cache: false,
            async: true,
            url: "fungsi/proses_ktupdate.php",
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
        $.post("./fungsi/proses_ktdelete.php", {
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

    function dpinsert() {
    // get values
    var datatp = $("#namakategori").val();

    $.ajax({
        type: "POST",
        timeout: 6000,
        data: {
            datatp: datatp
        },
        dataType: 'json',
        crossDomain: false,
        cache: false,
        async: true,
        url: "fungsi/proses_ktinsert.php",
        success: function (data) {
            // console.log("AJAX success:", data); // Log the success response
            // alert("Data inserted successfully!"); // Show success alert

            $("#modaldp").modal("hide");
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error); // Log the error response
            alert("Data insertion failed!"); // Show error alert
        }
    });
}

</script>

</body>

</html>