<?php
require_once './database.php';
session_start();


 if(isset($_SESSION['user_login'])){
       header("Location:dashboard.php");
   }

$errorr = [];

if (!empty($_POST)) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['User_password'];

    if ($user_name == "") {
        $errorr [] = 'User Name must Required...!';
    }
    if ($user_password == "") {
        $errorr [] = 'Password must Required...!';
    }

    if (!$errorr) {
        $sql = "SELECT * FROM users WHERE user_name = '$user_name'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($query);

        if ($row > 0) {

            $user = mysqli_fetch_assoc($query);

            if ($user['user_name'] != $user_name) {
                $errorr[] = 'your user name is worng..!';
            }
            if ($user['user_password'] != md5($user_password)) {
                $errorr[] = 'your password is worng..!';
            }

            if (count($errorr) == 0) {
                $_SESSION['user_login'] = $user_name;
                header("Location:dashboard.php");
            }
        } else {
            $errorr [] = 'No Account available';
        }
    }
}
?>


<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-image" href="./assets/images/logo.png" />
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="./assets/css/style.css" />
        <title>Login</title>
    </head>
    <body>
        <section id="login" class="mt-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="card">
                            <div class="card-header text-center">
                                <h2>Student Management System</h2>
                                <h4>Admin Login Form</h4>
                                <?php
                                if (!empty($errorr)) {
                                    foreach ($errorr as $erroe) {
                                        ?>
                                        <div class="alert alert-danger"><?= $erroe ?></div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <input class="form-control" type="text" placeholder="User Name" id="username" name="user_name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">User Password</label>
                                        <input class="form-control" type="password" placeholder="User Password" id="userpassword" name="User_password" />
                                    </div>
                                    <div class="text-right">
                                        <a href="index.php" class="btn btn-primary">Back</a>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p>if you don't registration then <a href="r_form.php">click here</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="./assets/js/jquery-3.4.1.min.js"></script>
        <script src="./assets/js/popper.min.js" ></script>
        <script src="./assets/js/bootstrap.min.js" ></script>
    </body>
</html>