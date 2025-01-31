<?php
require('./controllers/products.php');


if($_SERVER['REQUEST_METHOD'] == "GET"){

    if($_GET['url'] == "products" && !isset($_GET['id'])) {
        $data = Product::listProducts();
        $result = [
            "code"=> 200,
            "data"=> $data
        ];
    }elseif ($_GET['url'] == "products" && isset($_GET['id'])){
        $data = Product::getProductById($_GET['id']);
        $result = [
            "code" => 200,
            "data" => $data
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['url'] == "add-product") {
    if(isset($_POST['name']) && isset($_POST['price'])){
        $unitcost = null;
        if(isset($_POST['cost'])){
            $unitcost = $_POST['cost'];
        }
        $data = Product::createProduct($_POST['name'], $_POST['price'], $unitcost);
        $result = [
            "code"=> $data[0],
            "message"=> $data[1]
        ];
    }else{
        $result = [
            "code"=> 400,
            "message"=>"Product Name and Price are undefined"
        ];
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == "PUT" && $_GET['url'] == "update-product") {
    $formData = file_get_contents("php://input");
    $formData = json_decode($formData); 

    echo($formData->id);
    if(isset($_POST['id'])){
        $product_name = null;
        $product_price = null;
        $product_cost = null;
        
        if(isset($_POST['name'])){
            $product_name = $_POST['name'];
        }
        if(isset($_POST['price'])){
            $product_price = $_POST['price'];
        }
        if(isset($_POST['cost'])) {
            $product_cost = $_POST['cost'];
        }

        $data = Product::updateProduct($_POST['id'], $product_name, $product_price, $product_cost);
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
    if(isset($_POST['id'])){
        $response = Product::deleteProduct($_POST['id']);
        $result = [
            "code"=> $response[0],
            "message"=> $response[1]
        ];
    }else{
        $result = [
            "code"=> 404,
            "message"=> "ID is undefined"
        ];
    }
    
}

?>