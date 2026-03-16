<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">


            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-blog"></i>
                    <span>Blog</span>
                </a>
            </li>
            <hr class="sidebar-divider">


            <?php
            // admin and co-admin
             if(isset($_SESSION['user_data'])){
                $role = $_SESSION['user_data']['role'];     
            }
            if($role==1){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-fw fa-palette"></i>
                    <span>Categories</span>
                </a>
            </li>
            <hr class="sidebar-divider">


            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <?php
            }
            // end 
            ?>


        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <!-- seacrh work  -->
                            <?php
                            if(isset($_GET['search'])){
                                $search = $_GET['search'];
                            }else{
                                $search = "";
                            }
                            ?>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form action="search.php" method="GET" class="navbar-search">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control bg-light border-1 small"
                                            placeholder="What do you want to look for?" aria-label="Search"
                                            aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end  -->
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    <!-- for loggedin user -->
                                    <?php
                                    if(isset($_SESSION['user_data'])){
                                    echo $_SESSION['user_data']['user_name'];
                                }
                                ?>
                                    <!-- end  -->

                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <!-- logout   -->
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <!-- logout end  -->
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelLogout">Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-dismiss="modal">Cancel</button>
                                <a href="logout.php" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal logout end  -->

                <!-- show message for error and success  -->
                <?php
                    if(isset($_SESSION['msg'])){
                        $message = $_SESSION['msg']['0'];           
                        $background_class = $_SESSION['msg']['1'];           
                    
                        ?>
                <div class="alert <?php echo $background_class ?> alert-dismissible col-6 mx-auto" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo $message ?>
                </div>
                <?php
                        unset($_SESSION['msg']);
                    }
          ?>
                <!-- show message end  -->