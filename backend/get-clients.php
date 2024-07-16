<?php
    if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['url'] == "get-clients") {
        if(isset($_GET['client'])) {
            $result = db($conn, "SELECT * FROM `clients` WHERE name = ? ORDER BY id DESC", [$_GET['client']]);
        }else{
            $result = db($conn, "SELECT * FROM `clients` ORDER BY id DESC");
        }

    }
    
?>