<?php
require_once './database.php';
session_start();



$errors = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_cpassword = $_POST['user_cpassword'];

    $user_image = $_FILES['user_image'];
    $image_name = $user_image['name'];
    $image_tmp = $user_image['tmp_name'];
    $image_size = $user_image['size'];

    $a = explode(".", $image_name);
    $ex = strtolower(end($a));
    $extention = ['jpg', 'jpeg', 'png'];

    if (!in_array($ex, $extention)) {
        $errors[] = 'Please upload image with file extension jpg/png';
    }
    if ($image_size > 1024 * 1024 * 3) {
        $errors [] = 'you must upload 3 mb..!';
    }

    if ($name == "") {
        $errors [] = 'Name must Required...!';
       
    }
    if ($user_name == "") {
        $errors [] = 'User Name must Required...!';
    }
    if ($user_email == "") {
        $errors [] = 'Email must Required...!';
    }

    if ($user_password == "") {
        $errors [] = 'Password must Required...!';
    }
    if ($user_password != $user_cpassword) {
        $errors[] = 'your confirm password do not match..!';
    }
    $newpassword = md5($user_password);


    if (count($errors) == 0) {
        $email_check = "SELECT * FROM users WHERE user_email = '$user_email'";
        $query = mysqli_query($conn, $email_check);
        if (mysqli_num_rows($query) == 0) {
            $username_check = "SELECT * FROM users WHERE user_name = '$user_name'";
            $query = mysqli_query($conn, $username_check);
            if (mysqli_num_rows($query) == 0) {

                if (!$errors) {
                    $newimagename = $user_name . time() . uniqid() . "." . $ex;

                    $sql = "INSERT INTO users( name, user_name, user_email, user_password, user_image)
                 VALUES ('$name','$user_name','$user_email','$newpassword','$newimagename')";
                    $query = mysqli_query($conn, $sql);
                    move_uploaded_file($image_tmp, "upload/user/" . $newimagename);

                    if ($query) {

                        header("Location:r_form.php");
                        $success = 'data insert success';
                    }
                }
            } else {
                $errors[] = 'This User name Allready Exits...!';
            }
        } else {
            $errors[] = 'This Email Allready Exits...!';
        }
    }
}
?>



<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Registration Form</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Student Management System</h3>
                            <h4>Registration Form</h4>
<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        ?>
                                    <div class="alert alert-danger"><?= $error ?></div>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            if (isset($success)) {
                                ?>
                                <div class="alert alert-success"><?= $success ?></div>
                                <?php
                            }
                            ?>          
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" id="name" placeholder="Name" name="name" value="<?php if (isset($name)) {
                                echo $name;
                            } ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input class="form-control" type="text" id="user_name" placeholder="User Name" name="user_name" value="<?php if (isset($user_name)) {
                                echo $user_name;
                            } ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input class="form-control" type="email" id="user_email" placeholder="User Email" name="user_email" value="<?php if (isset($user_email)) {
                                echo $user_email;
                            } ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Password</label>
                                    <input class="form-control" type="password" id="user_password" placeholder="User Password" name="user_password" value="<?php if (isset($user_password)) {
                                echo $user_password;
                            } ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="user_cpassword">Confirm Password</label>
                                    <input class="form-control" type="password" id="user_cpassword" placeholder="Confirm Password" name="user_cpassword" value="<?php if (isset($user_cpassword)) {
                                echo $user_cpassword;
                            } ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="user_image">Image </label>
                                    <input class="form-control" type="file" id="user_image"  name="user_image" />
                                </div>
                                <div class="text-right">
                                    <a href="index.php" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-info">Submit</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="./assets/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="./assets/js/popper.min.js"></script>
        <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
    </body>
</html>