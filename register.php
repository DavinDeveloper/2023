<?php

require_once("config.php");

// include Database connection file
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['register'])){
    $currentDate = date("d-m-Y"); // Change format to match MySQL date format

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $checkSql = "SELECT username FROM users WHERE username = :username";
    $checkStmt = $db->prepare($checkSql);
    
    $checkParams = array(
        ":username" => $username
    );

    $checkStmt->execute($checkParams);
    
    $existingUsername = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUsername) {
        echo '<script language="javascript">alert("Username already exists. Please choose a different username."); document.location="register.php";</script>';
        exit; // Stop the script execution
    }else{
        // menyiapkan query
        try {
            $sql = "INSERT INTO users (name, username, email, password, hakakses, date_created, status, department, number_phone, unit) 
            VALUES (:name, :username, :email, :password, :hakakses, :currentDate, :status, :department, :number_phone, :unit)";
            $stmt = $db->prepare($sql);

            // bind parameter ke query
            $params = array(
                ":name" => $name,
                ":username" => $username,
                ":password" => $password,
                ":email" => $email,
                ":hakakses" => "member",
                ":department" => '',
                ":unit" => '',
                ":number_phone" => '',
                ":currentDate" => $currentDate,
                ":status" => 0
            );

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($params);

            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved) header("Location: index.php");
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
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
    <meta content="" name="author" />
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
                                <span><img src="" alt="" width="50"></span>
                            </a>
                        </div>

                        <div class="card-body pb-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign Up</h4>
                                <p class="text-muted mb-4">Enter your username, email address and password.</p>
                            </div>

                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="Nama Lengkap" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        required="" placeholder="Enter full name">
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        required="" placeholder="Enter username">
                                </div>

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress"
                                        required="" placeholder="Enter email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-1 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit" name="register" value="Daftar"> Sign Up 
                                    </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">You have an account? <a href="index.php"
                                    class="text-muted ms-1"><b>Log In</b></a></p>
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