<?php
require './database.php';
session_start();

if (isset($_SESSION['user_login'])) {
    header("Location:dashboard.php");
}

?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-image" href="assets/images/logo.png" />
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="./assets/css/style.css" />

        <title>Student Management System</title>
    </head>
    <body>
        <section id="show_info" class="py-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="login.php" class="btn btn-primary pull-right">Login Account</a>
                        <h1 class="my-5 text-muted">Welcome To Student Management System</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <form action="" method="POST">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td colspan="2"><h4>Student Information</h4></td>
                                </tr>
                                <tr>
                                    <td><label for="chose_class">Choose Class</label></td>
                                    <td>
                                        <select class="form-control" name="chose_class" id="chose_class">
                                            <option value="one">One</option>
                                            <option value="two">Two</option>
                                            <option value="three">Three</option>
                                            <option value="four">Four</option>
                                            <option value="five">Five</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="roll">Roll</label></td>
                                    <td><input class="form-control" pattern="[0-9]{6}" type="text" placeholder="Roll" name="roll" id="roll" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2"> <button type="submit" class="btn btn-primary">Show Info</button></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

                <?php
                if (!empty($_POST)) {
                    $choose_class = $_POST['chose_class'];
                    $roll = $_POST['roll'];

                    $sql = "SELECT * FROM `student_info` WHERE `student_class`='$choose_class' and `student_roll`='$roll'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($query);
                    $user = mysqli_fetch_assoc($query);

                    if ($row > 0) {
                        ?>
                        <div class="row">
                            <div class="col-6 offset-3">
                                <table class="table table-bordered table-striped table-hover text-left">
                                    <tr>
                                        <td>Name</td>
                                        <td><?= ucfirst($user['student_name']) ?></td>

                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td><?= ucfirst($user['student_class']) ?></td>

                                    </tr>
                                    <tr>
                                        <td>Roll</td>
                                        <td><?= ucfirst($user['student_roll']) ?></td>

                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= ucfirst($user['student_email']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No.</td>
                                        <td><?= ucfirst($user['student_number']) ?></td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript">
                            alert("Data Not Found");
                        </script>
                        <?php
                    }
                }
                ?>


            </div>
        </section>

        <script src="./assets/js/jquery-3.4.1.min.js"></script>
        <script src="./assets/js/popper.min.js" ></script>
        <script src="./assets/js/bootstrap.min.js" ></script>
    </body>
</html>
