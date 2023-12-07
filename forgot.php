<?php

require_once("config.php");

date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $newPassword = $_POST['password'];

    if (!empty($email) && !empty($phone) && !empty($name) && !empty($newPassword)) {
        $sql = "SELECT * FROM users WHERE email = :email AND number_phone = :phone AND name = :name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateSql = "UPDATE users SET password = :password WHERE id = :userId";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->bindParam(':password', $hashedPassword);
            $updateStmt->bindParam(':userId', $user['id']);
            $updateStmt->execute();

            $success = "Password successfully updated!";
        } else {
            $error = "Invalid credentials. Please check your details.";
        }
    } else {
        $error = "Please fill in all the fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Forgot your password | Ticketing Sistem</title>
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
                            <!-- <a href="index.html">
                                <span><img src="///assets/images/ines.jpg" alt="" width="50"></span>
                            </a> -->
                        </div>
                        <div class="card-body pb-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Forgot your password</h4>
                                <p class="text-muted mb-4">Enter your email address.</p>
                            </div>

                            <form method="POST">
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email address</label>
                <input class="form-control" type="text" name="email" id="emailaddress" required="" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input class="form-control" type="text" name="phone" id="phone" required="" placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" name="name" id="name" required="" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input class="form-control" type="password" name="password" id="password" required="" placeholder="Enter new password">
            </div>
            <div class="mb-1 mb-0 text-center">
                <button class="btn btn-primary" type="submit" name="login" value="Submit"> Submit </button>
            </div>
            <?php
            if (isset($error)) {
                echo '<div class="text-center text-danger mt-3">' . $error . '</div>';
            } elseif (isset($success)) {
                echo '<div class="text-center text-success mt-3">' . $success . '</div>';
            }
            ?>
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