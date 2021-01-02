<?php

    $host = 'localhost';
    $uname = 'root';
    $upass = '';
    $dname = 'studebt_ms';
    
    $conn = mysqli_connect($host,$uname,$upass,$dname);
    
    if(!$conn){
        die('Field '.mysqli_connect_error());
    }
?>

