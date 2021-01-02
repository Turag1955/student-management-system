<?php
if (!isset($_SESSION['user_login'])) {
    header("Location:dashboard.php");
}


$user_profile = $_SESSION['user_login'];

$sql = "SELECT * FROM users WHERE user_name = '$user_profile'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

$errors = [];
if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];



    $b = explode(".", $image);
    $bx = strtolower(end($b));

    $newofimagename = $image . time() . $bx;

    $sql = "UPDATE users SET 
                              user_image = '$newofimagename'
                                WHERE 
                                user_name = $user_profile
                                ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/user/" . $newofimagename);
    }
} else {
    $errors [] = 'You do not selected Photo';
}
?>



<div class="content">
    <h1 class="text-primary"><i class="fa fa-user"></i> <?= ucfirst($row['name']) ?><small class="text-muted">  Profile </small></h1>
    <div class="breadcrumb">
        <a class="text-decoration-none" href="dashboard.php?page=dashboard-2">
            <li class="active"> Dashboard </li>
        </a>
        <li class="active text-muted ml-3"><i class="fa fa-user-plus"></i> Profile</li>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <table class="table table-bordered table-striped table-hover">

            <tr>
                <td>Name</td>
                <td><?= ucfirst($row['name']) ?></td>
            </tr>
            <tr>
                <td>User Name</td>
                <td><?= ucfirst($row['user_name']) ?></td>
            </tr>
            <tr>
                <td>User Email</td>
                <td><?= ucfirst($row['user_email']) ?></td>
            </tr>
            <tr>
                <td>User Status</td>
                <td><?= ucfirst($row['user_status']) ?></td>
            </tr> 
            <tr>
                <td>Sing Up Date</td>
                <td><?= ucfirst($row['user_insert_date']) ?></td>
            </tr>


        </table>
    </div>
    <div class="col-6">
        <img class="img-fluid rounded" style="width: 200px;height: 200px;border: 2px solid #ddd;" src="upload/user/<?= $row['user_image'] ?>" alt="" />
        <form class="mt-5" action="" method="POST" enctype="multipart/data-form">
            <label for="image">Profile picture Change</label>
            <input type="file" id="image" name="image" class="form-control w-50" />
            <div class="mt-3">
                <input type="submit" value="Submit" class="btn btn-primary" name="submit" />
            </div>
        </form>
    </div>
</div>