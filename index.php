<?php
    include('classes/DB.php');
    include('classes/Login.php');
    if (Login::isLoggedIn()) {
        header('Location: ./dashboard.php');
    }
    else {
        header('Location: ./login.php');
    }
?>