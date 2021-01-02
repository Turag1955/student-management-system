<?php
        if (!isset($_SESSION['user_login'])) {
            header("Location:dashboard.php");
        }
?>

<div class="content">
    <h1 class="text-primary"><i class="fa fa-user-plus"></i> All User <small class="text-muted">All User list </small></h1>
    <div class="breadcrumb">
        <a class="text-decoration-none" href="dashboard.php?page=dashboard-2">
            <li class="active"> dashboard </li>
        </a>
        <li class="active text-muted ml-3"><i class="fa fa-user-plus"></i> All User</li>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table id="table" class="table table-bordered table-striped table-hover">
            <?php
            $sql = "SELECT * FROM users";
            $query = mysqli_query($conn, $sql);
            ?>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Status</th>
                    <th>User Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?php echo ucfirst($row['name']); ?></td>
                        <td><?php echo ucfirst($row['user_name']); ?></td>
                        <td><?php echo ucfirst($row['user_email']); ?></td>
                        <td><?php echo ucfirst($row['user_status']); ?></td>

                        <td><img src="upload/user/<?php echo ucfirst($row['user_image']); ?>" style="width: 50px" alt="" /></td>

                    </tr>
                    <?php
                }
                ?>


            </tbody>
        </table>
    </div>

</div>