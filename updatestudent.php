<?php
if (!isset($_SESSION['user_login'])) {
    header("Location:dashboard.php");
}

require_once './database.php';
$id = base64_decode($_GET['id']);

$sql = "SELECT * FROM student_info WHERE id='$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);


$errors = [];
if (!empty($_POST)) {
    $student_name = $_POST['student_name'];
    $student_roll = $_POST['student_roll'];
    $student_class = $_POST['student_class'];
    $student_email = $_POST['student_email'];
    $student_number = $_POST['student_number'];



    /*
      $image_name = $student_photo['name'];
      $image_tmp = $student_photo['tmp_name'];
      $image_size = $student_photo['size'];

      $a = explode(".", $image_name);
      $ex = strtolower(end($a));

      $extention = ['jpg', 'jpeg', 'png'];

      if (!in_array($ex, $extention)) {
      $errors [] = 'Please upload image with file extension jpg/png';
      }
      if ($image_size > 1024 * 1024 * 3) {
      $errors [] = 'you must upload 3 mb..!';
      }
     *   $newimagename = $student_name . '-' . time() . '.' . $ex;
     */






    if (empty($student_name)) {
        $errors [] = 'Name must Required...!';
    }
    if (empty($student_roll)) {
        $errors [] = 'Roll must Required...!';
    }
    if (empty($student_class)) {
        $errors [] = 'Class must Required...!';
    }
    if (empty($student_email)) {
        $errors [] = 'Email must Required...!';
    }
    if (empty($student_number)) {
        $errors [] = 'Mobile No. must Required...!';
    }
    if (!$errors) {
        $sql = "UPDATE student_info SET 
                                        student_name = '$student_name',
                                        student_roll = '$student_roll',
                                        student_class = '$student_class',
                                        student_email = '$student_email',
                                        student_number = '$student_number'
                                         WHERE 
                                         id = $id
                                          ";





        $query = mysqli_query($conn, $sql);
        if ($query) {
            header("Location:dashboard.php?page=allstudent");
        }
    }
}
?>







<div class="content">
    <h1 class="text-primary"><i class="fa fa-pencil-square"></i> Update Student </h1>
    <div class="breadcrumb">
        <a class="text-decoration-none" href="dashboard.php?page = dashboard-2">
            <li class="active"><i class="fa fa-dashboard"></i> Dashboard </li>
        </a>
        <a href="dashboard.php?page = allstudent" class="text-decoration-none">
            <li class="active ml-3"><i class="fa fa-user-plus"></i> All Student</li>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-8">
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
        <form action = "" method = "POST" enctype = "multipart/data-form">
            <div class = "form-group">
                <label for = "name">Name</label>
                <input class = "form-control" type = "text" id = "name" placeholder = "Name" name = "student_name" value = "<?php echo $row['student_name'];
        ?>" />
            </div>
            <div class = "form-group">
                <label for = "roll">Roll</label>
                <input class = "form-control" type = "text" id = "roll" placeholder = "Roll" name = "student_roll" value = "<?php echo $row['student_roll']; ?>" />
            </div>
            <div class = "form-group">
                <label for = "class">Class</label>
                <select class = "form-control" name = "student_class" id = "class">
                    <option <?php
        if ($row['student_class'] == '') {
            echo 'selected';
        }
        ?> value = "">Select</option>
                    <option <?php
                    if ($row['student_class'] == 'One') {
                        echo 'selected';
                    }
        ?> value = "one">One</option>
                    <option <?php
                    if ($row['student_class'] == 'Two') {
                        echo 'selected';
                    }
        ?> value = "Two">Two</option>
                    <option <?php
                    if ($row['student_class'] == 'Three') {
                        echo 'selected';
                    }
        ?> value = "three">Three</option>
                    <option <?php
                    if ($row['student_class'] == 'Four') {
                        echo 'selected';
                    }
        ?> value = "four">Four</option>
                    <option <?php
                    if ($row['student_class'] == 'Five') {
                        echo 'selected';
                    }
        ?> value = "five">Five</option>
                </select>
            </div>
            <div class = "form-group">
                <label for = "email">Email</label>
                <input class = "form-control" type = "email" id = "name" placeholder = "Email" name = "student_email" value = "<?php echo $row['student_email']; ?>" />
            </div>
            <div class = "form-group">
                <label for = "number">Mobile No.</label>
                <input class = "form-control" type = "text" id = "number" placeholder = "01*********" name = "student_number" pattern = "01[8|7|9|3|6][0-9]{8}" value = "<?php echo $row['student_number']; ?>" />
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
    </div>
</div>