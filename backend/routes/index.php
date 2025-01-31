<?php
require('auth-routes.php');
require('product-routes.php');
require('sales-routes.php');
require('inventory-routes.php');

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['url'] == "daily-sales-summary") {
    $data = Sales::listDailySales();
    $result = [
        "code"=> 200,
        "data"=> $data
    ];
}


?>