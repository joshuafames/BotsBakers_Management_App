<?php
require('./controllers/sales.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if($_GET['url'] == "daily-sales") {
        $data = SalesRecord::getDailySales();
        $result = [
            "code"=> 200,
            "data"=> $data
        ];
        return $result;
    }
    if($_GET['url'] == "product-sales") {
        $data = SalesRecord::getProductSales();
        $result = [
            "code"=> 200,
            "data"=> $data
        ];
        return $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if ($_GET['url'] == "add-sales") {
        SalesRecord::createDailySalesEntry("28-01-2025", 
        [
            [
                "product_id" => 1001,
                "amount" => 5000.22, 
            ],
            [
                "product_id" => 10002,
                "amount" => 99999.11, 
            ]
        ]
        );
    }elseif ($_GET['url'] == "sales") {
        $data = SalesRecord::createSalesEntry("28-01-2025", $_POST);
        $result = [
            "code"=> 200,
            "data"=> $data
        ];
        return $result;
    }
}
?>