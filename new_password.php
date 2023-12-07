<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>New password | Ticketing Sistem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading authentication-bg"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">

<?php 
 require 'connection.php';

 if(isset($_GET['token'])):
    $token = $_GET['token'];
    $data = $capsule->table('forgot_request_token')->where(['token' => $token,'expired' => '1']);
    if($data->count() > 0):
        $record = $capsule->table('forgot_request_token')
        ->where(['token' => $token])
        ->update(['expired'=> '0']);
?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header pt-1 pb-1 text-center bg-primary">
                            <!-- <a href="index.html">
                                <span><img src="///assets/images/ines.jpg" alt="" width="50"></span>
                            </a> -->
                        </div>
                        <div class="card-body pb-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Create your password</h4>
                                <p class="text-muted mb-4">Enter your new password.</p>
                            </div>

                            <form action="api/forgot_change_password.php" method="POST">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">New password</label>
                                    <input type="hidden" name="token" value="<?= $token;?>">
                                    <input class="form-control" type="text" name="password" id="password"
                                        required="" placeholder="Enter new password">
                                </div>
                                <div class="mb-1 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit" name="login" value="Submit"> Submit
                                    </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="register.php"
                                    class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
<?php
else:
    ?>;
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header pt-1 pb-1 text-center bg-primary">
                            <!-- <a href="index.html">
                                <span><img src="assets/images/ines.jpg" alt="" width="50"></span>
                            </a> -->
                        </div>
                        <div class="card-body pb-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Your token has expired</h4>
                                <p class="text-muted mb-4">Please request token again from forgot password.</p>
                            </div>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="register.php"
                                    class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    <?php
endif;
endif;
?>
    <footer class="footer footer-alt">
        2023 © Ticketing Sistem
    </footer>

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>
