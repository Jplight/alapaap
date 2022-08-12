            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: var(--bs-green); position:relative;">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                        <div class="sidebar-brand-icon">
                            <img class="img-fluid d-md-none" src="assets/img/dashboard_logo.png" width="50px" alt="Image">
                            <img class="d-none d-md-block img-thumbnail" src="assets/img/ebiz-logo2.png" alt="Image">
                        </div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="navbar-nav text-dark" id="accordionSidebar">
                        <li class="nav-item ">
                            <a class="nav-link nav-link_active" href="index.php">
                                <i class="fa-fw fas fa-tachometer-alt "></i>
                                <span class="h6">Dashboard</span>
                            </a>
                        </li>
                        <?php if ($role == 2): ?>
                        <li class="nav-item ">
                            <a class="nav-link nav-link_active" href="new_users.php">
                                <i class="fa-fw fas fa-users"></i>
                                <span class="h6">New Accounts</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link_active" href="profile.php" >
                                <i class="fa-fw fas fa-user"></i>
                                <span class="h6">Accounts Settings</span>
                            </a>
                        </li>
                        <?php if ($role == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link_active" href="reports.php">
                                <i class="fa-fw fas fa-tachometer-alt"></i>
                                <span class="h6">Reports</span>
                            </a>
                        </li>
                        <?php endif; ?>
                      
                        <li class="nav-item">
                            <a class="nav-link nav-link_active" href="activity_logs.php">
                                <i class="fa-fw fas fa-history"></i>
                                <span class="h6">Activity Logs</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link nav-link_active" href="../model/logout.php">
                                <i class="fa-fw fas fa-sign-out-alt"></i>
                                <span class="h6">Log Out</span>
                            </a>
                        </li>
                    </ul>
                    <div class="text-center d-none d-md-inline">
                        <!-- <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button> -->
                    </div>
                </div>
            </nav>