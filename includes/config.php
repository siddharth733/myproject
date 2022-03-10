<?php

    $db_conn = mysqli_connect("localhost:3307","root","","sms_project");
    if (!$db_conn) {
        echo "Connection Failed";
        exit;
    }
    session_start();
    include 'function.php';
?>