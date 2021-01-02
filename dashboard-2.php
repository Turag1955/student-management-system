<?php

        if (!isset($_SESSION['user_login'])) {
            header("Location:dashboard.php");
        }
        
        
        
        $sql = "SELECT * FROM student_info";
        $query = mysqli_query($conn, $sql);
        $total_student = mysqli_num_rows($query);

        $sql1 = "SELECT * FROM users";
        $query1 = mysqli_query($conn, $sql1);
        $total_users = mysqli_num_rows($query1);
?>




<div class="content">
    <h1 class="text-primary"><i class="fa fa-dashboard"></i> Dashboard <small class="text-muted">statistic overview</small></h1>
    <div class="breadcrumb">
        <li class="active text-muted"><i class="fa fa-dashboard"></i> dashboard</li>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card text-light">
            <div class="card-body bg-primary">
                <div class="d-inline">
                    <i class="fa fa-user-secret fa-5x"></i>
                    <h2 class="pull-right display-5 align-middle">All Student <span class="px-3"><?= $total_student ?></span></h2>

                </div>

            </div>
            <a href="dashboard.php?page=allstudent" class="text-decoration-none">
                <div class="card-footer text-muted">
                    <h4>View All Student<span class="pull-right"><i class="fa fa-arrow-circle-o-right"></i></span></h4> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card text-light">
            <div class="card-body bg-primary">
                <div class="d-inline">
                    <i class="fa fa-user-plus fa-5x"></i>
                    <h2 class="pull-right display-5 align-middle">All Users <span class="px-3"><?= $total_users ?></span></h2>

                </div>

            </div>
            <a href="dashboard.php?page=user" class="text-decoration-none">
                <div class="card-footer text-muted">
                    <h4>View All Users<span class="pull-right"><i class="fa fa-arrow-circle-o-right"></i></span></h4> 
                </div>
            </a>
        </div>
    </div>

    <div class="col-12">
        <hr />
        <h2>New Student</h2>
        <table id="table" class="table table-bordered table-striped table-hover mb-5 table-responsives">
            <?php
            $sql = "SELECT * FROM student_info";
            $query = mysqli_query($conn, $sql);
            ?>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Email</th>
                    <th>Mobile No. </th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?php echo ucfirst($row['id']); ?></td>
                        <td><?php echo ucfirst($row['student_name']); ?></td>
                        <td><?php echo ucfirst($row['student_roll']); ?></td>
                        <td><?php echo ucfirst($row['student_class']); ?></td>
                        <td><?php echo ucfirst($row['student_email']); ?></td>
                        <td><?php echo ucfirst($row['student_number']); ?></td>
                        <td><img src="upload/user/<?php echo ucfirst($row['student_image']); ?>" style="width: 50px" alt="" /></td>
                        <td>
                            <a href="dashboard.php?page=updatestudent&id=<?php echo base64_encode($row['id']); ?>" class="btn btn-primary">Update</a>
                            <a href="studentdelete.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>


            </tbody>
        </table>
    </div>
</div>