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
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="../assets/images/users/avatar-6.jpg"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                                <h4 class="mb-0 mt-2"><?php echo $_SESSION["user"]["name"]?></h4>
                                <p class="text-muted font-14"><?php echo $_SESSION["user"]["hakakses"]?></p>

                                <div class="text-start mt-3">
                                    <p class="text-muted mb-2 font-13"><strong>Username :</strong> <span
                                            class="ms-2"><?php echo $_SESSION["user"]["username"]?></span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span
                                            class="ms-2"><?php echo $_SESSION["user"]["name"]?></span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Phone :</strong><span class="ms-2">
                                            <?php echo $_SESSION["user"]["number_phone"]?></span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                            class="ms-2 "><?php echo $_SESSION["user"]["email"]?></span></p>
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <form id="updateAkun">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Personal Info</h5>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" placeholder=""
                                                    value="<?php echo $_SESSION["user"]["username"]?>" readonly>
                                                <span class="form-text text-muted"><small>Username cannot be changed
                                                </span>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="fullname"
                                                    placeholder="Enter new full name">
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumber" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" id="phonenumber"
                                                    placeholder="Enter new phone number">
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email
                                                    Address</label>
                                                <input type="email" class="form-control" id="useremail"
                                                    placeholder="Enter new email">
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success mt-2"><i
                                                class="mdi mdi-content-save"></i> Personal Update</button>
                                    </div>
                                </form>
                                <form id="passwordUpdate">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Change
                                        Password</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="newpassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="newpassword"
                                                    placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmpassword"
                                                    placeholder="Re-enter new password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success mt-2"><i
                                                class="mdi mdi-content-save"></i> Password Update</button>
                                    </div>
                                </form>

                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row-->
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
<script type="text/javascript">
    $("#updateAkun").submit(function (event) {
        event.preventDefault();

        var formData = {
            fullname: $("#fullname").val(),
            phonenumber: $("#phonenumber").val(),
            useremail: $("#useremail").val(),
            userId: <?php echo $_SESSION["user"]["id"]; ?>
        };

        $.ajax({
            type: "POST",
            url: "fungsi/update_user.php", // Replace with your PHP script's path
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Handle success, maybe show a message
                    // console.log("Update successful");
                    alert("Update successful, Re-Login for show new data updated");
                    window.location.reload();
                } else {
                    // Handle error, maybe show an error message
                    // console.error("Update failed");
                    alert("Update failed");
                    window.location.reload();
                }
            }
        });
    });

    $("#passwordUpdate").submit(function(event) {
        event.preventDefault();

        var newPassword = $("#newpassword").val();
        var confirmPassword = $("#confirmpassword").val();
        var userId = <?php echo $_SESSION["user"]["id"]; ?>
        

        // Check if passwords match
        if (newPassword !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "fungsi/update_password.php", // Replace with your PHP script's path
            data: { newPassword: newPassword,
                    userId: userId
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#newpassword").val(""); // Clear the password fields
                    $("#confirmpassword").val("");
                    alert("Update successful, Re-Login for show new data updated");
                    window.location.reload();
                } else {
                    $("#newpassword").val(""); // Clear the password fields
                    $("#confirmpassword").val("");
                    alert("Password update failed.");
                    window.location.reload();
                }
            }
        });
    });
</script>
</body>

</html>