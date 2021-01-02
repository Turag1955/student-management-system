<?php 
    
    
    if(!isset($_SESSION['user_login'])){
        header("Location:dashboard.php");
    }
?>


<div class="content">
    <h1 class="text-primary"><i class="fa fa-user-plus"></i> All Student <small class="text-muted">All Student list </small></h1>
    <div class="breadcrumb">
        <a class="text-decoration-none" href="dashboard.php?page=dashboard-2">
            <li class="active"> dashboard </li>
        </a>
        <li class="active text-muted ml-3"><i class="fa fa-user-plus"></i> All Student</li>
    </div>
</div>

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
                    <a href="dashboard.php?page=updatestudent&id=<?php echo base64_encode($row['id']);?>" class="btn btn-primary">Update</a>
                    <a href="studentdelete.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>


    </tbody>
</table>