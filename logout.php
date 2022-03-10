<?php
    session_start();
    session_destroy();

    header('Location:index.php ',$_SERVER['HTTP_REFERER']);
?>