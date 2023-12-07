<?php
    require_once '../connection.php';
    $ticket = $capsule->table('tiket')
                  ->where(
                    't_assigned',$_SESSION['user']['id']
                  )            
                  ->where(
                    'clicked_from_technician', 'N'
                  );
    $count_ticket = $ticket->count();
    $new_ticket = $ticket->orderBy('id_tiket','desc')->get();
?>
            <div class="navbar-custom">
                <ul class="list-unstyled topbar-menu float-end mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-ring-outline noti-icon"></i>
                            <?php if ($count_ticket > 0):?>
                            <span class="count-notify bg-danger text-white"><?= $count_ticket;?></span>
                            <?php endif;?>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                            <?php foreach($new_ticket as $item):?>
                                <div class="dropdown-item notify-item" style="cursor:pointer;border-bottom:1px solid #ddd;background:#f8f9fa" onclick="window.location.href='tiket.php'">
                                    <div>
                                        <span style="font-weight:bold"><?= $item->t_subject;?></span>
                                    </div>
                                    <div>
                                        <span >From <?php echo $item->n_users;?></span>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>

                    </li>


                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="../assets/images/users/avatar-6.jpg" alt="user-image" class="rounded-circle">
                            </span>
                            <span>
                                <span class="account-user-name">
                                    <?php echo $_SESSION["user"]["name"] ?>
                                </span>
                                <span class="account-position">
                                    <?php echo $_SESSION["user"]["hakakses"] ?>
                                </span>
                            </span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome
                                    <?php echo $_SESSION["user"]["hakakses"] ?>
                                    <?php echo $_SESSION["user"]["name"] ?> !
                                </h6>
                            </div>

                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="../logout.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="button-menu-mobile open-left">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="app-search dropdown d-none d-lg-block">
                    <!-- <form>
                            <div class="input-group">
                                <input type="text" class="form-control dropdown-toggle" placeholder="Search..."
                                    id="top-search">
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button class="input-group-text btn-primary" type="submit">Search</button>
                            </div>
                        </form> -->
                </div>
</div>
