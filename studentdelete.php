<?php

require_once './database.php';

$id = base64_decode($_GET['id']);

$sql = "DELETE FROM student_info WHERE id = '$id'";
$query = mysqli_query($conn, $sql);

if($query){
    header("Location:dashboard.php?page=dashboard-2");
}


