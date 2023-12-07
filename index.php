<?php

require_once("config.php");

if (isset($_POST['login'])) {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($user) {
        // verifikasi password
        if (password_verify($password, $user["password"])) {
            if ($user["hakakses"] == "administrator") {
                // buat Session
                session_start();
                $_SESSION['level'] = $user['hakakses'];
                $_SESSION['user'] = $user;
                // login sukses, alihkan ke halaman timeline

                if ($user['status'] == 0) {
                    echo '<script language="javascript">alert("Your account is blocked"); document.location="index.php";</script>';
                } else {
                    header("location: administrator/index.php");
                }
            }else if ($user["hakakses"] == "admin") {
                // buat Session
                session_start();
                $_SESSION['level'] = $user['hakakses'];
                $_SESSION['user'] = $user;
                // login sukses, alihkan ke halaman timeline

                if ($user['status'] == 0) {
                    echo '<script language="javascript">alert("Your account is blocked"); document.location="index.php";</script>';
                } else {
                    header("location: admin/index.php");
                }
            }else if ($user["hakakses"] == "manager") {
                // buat Session
                session_start();
                $_SESSION['level'] = $user['hakakses'];
                $_SESSION['user'] = $user;
                // login sukses, alihkan ke halaman timeline

                if ($user['status'] == 0) {
                    echo '<script language="javascript">alert("Your account is blocked"); document.location="index.php";</script>';
                } else {
                    header("location: manager/index.php");
                }
            } else if ($user["hakakses"] == "member") {
                // buat Session
                session_start();
                $_SESSION['level'] = $user['hakakses'];
                $_SESSION['user'] = $user;
                // login sukses, alihkan ke halaman timeline
                if ($user['status'] == 0) {
                    echo '<script language="javascript">alert("Your account is inactive please contact Administrator"); document.location="index.php";</script>';
                } else {
                    header("location: member/index.php");
                }
            } else if ($user["hakakses"] == "teknisi") {
                // buat Session
                session_start();
                $_SESSION['level'] = $user['hakakses'];
                $_SESSION['user'] = $user;
                // login sukses, alihkan ke halaman timeline
                if ($user['status'] == 0) {
                    echo '<script language="javascript">alert("Your account is inactive please contact Administrator"); document.location="index.php";</script>';
                } else {
                    header("location: teknisi/index.php");
                }
            } else {
                echo '<script language="javascript">alert("Akun Membutuhkan Role silahkan hubungi admin"); document.location="index.php";</script>';
            }
        } else {
            echo '<script language="javascript">alert("Passowrd Wrong"); document.location="index.php";</script>';
        }
    } else {
        echo '<script language="javascript">alert("Username or Passowrd Wrong"); document.location="index.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Ticketing Sistem</title>
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header pt-1 pb-1 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="///assets/images/ines.jpg" alt="" width="50"></span>
                            </a>
                        </div>

                        <div class="card-body pb-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                <p class="text-muted mb-4">Enter your email address and password.</p>
                            </div>

                            <form action="" method="POST">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Username / Email address</label>
                                    <input class="form-control" type="text" name="username" id="emailaddress"
                                        required="" placeholder="Enter username or email">
                                </div>

                                <div class="mb-3">
                                    <!-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a> -->
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                                    checked>
                                                <label class="form-check-label" for="checkbox-signin">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="text-align:right">
                                            <a href="forgot.php">Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit" name="login" value="Masuk"> Log In
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
    </div>
    <!-- end page -->
    <footer class="footer footer-alt">
        2023 © Ticketing Sistem
    </footer>

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

</body>

</html>