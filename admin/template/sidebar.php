<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.php" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.php" class="logo text-center logo-dark p-2">
        <span class="logo-lg">
            <h3>IT Helpdesk</h3>
        </span>
        <span class="logo-sm">
            <h3>IT</h3>
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="index.php" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">Apps</li>
            <?php
            $today = date('d-m-Y');
            $sql = "SELECT COUNT(*) as ticket_count FROM `tiket` WHERE DATE_FORMAT(STR_TO_DATE(t_created_date, '%d-%m-%Y %h:%i %p'), '%d-%m-%Y') = :today";
            $query = $db->prepare($sql);
            $query->bindParam(':today', $today);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $ticket_count = $result['ticket_count'];
            ?>
            <li class="side-nav-item">
                <a href="tiket.php" class="side-nav-link">
                    <i class="uil-ticket"></i>
                    <span> Ticket <?php if ($ticket_count > 0): ?><button class="btn btn-primary btn-sm"><?php echo $ticket_count; ?></button><?php endif; ?></span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarOrganized" aria-expanded="false" aria-controls="sidebarEmail"
                    class="side-nav-link">
                    <i class="uil-postcard"></i>
                    <span> Organized </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarOrganized">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="department.php">Department</a>
                        </li>
                        <li>
                            <a href="topic.php">Topic</a>
                        </li>
                        <li>
                            <a href="unit.php">Unit</a>
                        </li>
                    </ul>
                </div>
            </li>
<!-- 
            <li class="side-nav-item">
                <a href="survei.php" class="side-nav-link">
                    <i class="uil-chat-bubble-user"></i>
                    <span> Survei Karyawan </span>
                </a>
            </li> -->

            <li class="side-nav-title side-nav-item">Settings Account</li>

            <li class="side-nav-item">
                <a href="usersetting.php" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span>Users Account</span>
                </a>
            </li>
        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-left">
            <h5>Need Help ? <br><br>Phone : 0822 1100 2001</h5>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->