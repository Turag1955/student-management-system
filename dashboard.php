<?php
require_once './database.php';
session_start();



if (!isset($_SESSION['user_login'])) {
    header("Location:login.php");
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-image" href="assets/images/logo.png" />
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />

        <title>Student Management System</title>
    </head>
    <body>
        <!--nav-->
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid">
                <a href="dashboard.php" class="navbar-brand">Student Management System</a>
                <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-terget="#navbarnav"><span class="navbar-toggler-icon"></span></button>
                <div id="navbarnav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href=""><i class=""></i> Welcome  <?php echo $_SESSION['user_login']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?page=profile"><i class=""></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="r_form.php"><i class=""></i> Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php?id=<?php $logout = '123'; ?>"><i class=""></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--dashboard-->
        <section id="dashboard" class="mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-primary list-group-item-action active" href="dashboard.php?page=dashboard-2">Dashboard</a>
                            <a class="list-group-item  list-group-item-action " href="dashboard.php?page=studentAdd">Add Student</a>
                            <a class="list-group-item  list-group-item-action " href="dashboard.php?page=allstudent">All Student</a>
                            <a class="list-group-item  list-group-item-action " href="dashboard.php?page=user">All Users</a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <?php
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'] . '.php';
                        } else {
                            $page = 'dashboard-2.php';
                        }

                        if (file_exists($page)) {
                            require_once $page;
                        } else {
                            require_once '404.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!--footer-->
        <footer id="" class="text-center bg-primary py-3 mt-5 text-light">
            <p class="lead">Copyright &COPY; 2020 Student Management System All Rights are Reserved</p>
        </footer>



        <script src="./assets/js/jquery-3.4.1.min.js"></script>
        <script src="./assets/js/popper.min.js" ></script>
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
        <script src="./assets/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </body>
</html>


