<?php
    if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['url'] == "get-invoices") {
        if(isset($_GET['client'])) {
            $result = db($conn, "SELECT * FROM `invoices` WHERE  Client = ? ORDER BY id DESC", [$_GET['client']]);
        }else{
            $result = db($conn, "SELECT * FROM `invoices` ORDER BY id DESC");
        }
    }
    
?>