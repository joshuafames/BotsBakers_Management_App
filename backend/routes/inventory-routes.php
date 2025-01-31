<?php
require('./controllers/inventory.php');


if($_SERVER['REQUEST_METHOD'] == "GET"){

    if($_GET['url'] == "inventory" && !isset($_GET['id'])) {
        $data = Inventory::getInventory();
        $result = [
            "code"=> 200,
            "data"=> $data
        ];
    }elseif ($_GET['url'] == "inventory" && isset($_GET['id'])){
        $data = Inventory::getInventoryById($_GET['id']);
        $result = [
            "code" => 200,
            "data" => $data
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['url'] == "add-inventory") {
    if(isset($_POST['name']) && isset($_POST['cost']) && isset($_POST['count'])){
        $data = Inventory::addInventoryItem($_POST['name'], $_POST['cost'], $_POST['count']);
        $result = [
            "code"=> $data[0],
            "message"=> $data[1]
        ];
    }else{
        $result = [
            "code"=> 400,
            "message"=>"Item Name, Cost & Count are undefined"
        ];
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == "PUT" && $_GET['url'] == "update-inventory") {
    $formData = file_get_contents("php://input");
    $formData = json_decode($formData); 

    echo($formData->id);
    if(isset($_POST['id'])){
        $product_name = null;
        $product_count = null;
        $product_cost = null;
        
        if(isset($_POST['name'])){
            $product_name = $_POST['name'];
        }
        if(isset($_POST['cost'])){
            $product_cost = $_POST['cost'];
        }
        if(isset($_POST['count'])) {
            $product_count = $_POST['count'];
        }

        $data = Inventory::updateInventoryItem($_POST['id'], $product_name, $product_cost, $product_count);
        $result = [
            "code"=> $data[0],
            "message"=> $data[1]
        ];
    }else{
        $result = [
            "code"=> 404,
            "message"=> "Product not found"
        ];
    }
}
if ($_SERVER['REQUEST_METHOD'] == "DELETE" && $_GET['url'] == "delete-product") {
    if(!isset($_POST['id'])){
        $response = Product::deleteProduct($_POST['id']);
        $result = [
            "code"=> $response[0],
            "message"=> $response[1]
        ];
    }else {
        $result = [
            "code"=> 404,
            "message"=> "ID is undefined"
        ];
    }
    
}

?>