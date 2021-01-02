<?php

session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location:login.php");
}


if (isset($id)) {
    session_destroy();
    header("Location:login.php");
} else if (isset($_SESSION['user_login'])) {
    header("Location:dashboard.php");
}
?>


