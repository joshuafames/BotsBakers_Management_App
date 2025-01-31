<?php
require('./controllers/auth.php'); //REF ROOT IS `backend`

// ==================== AUTH =======================

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['url'] == "signin") {
    $result = Auth::signin($_POST['username'], $_POST['names'], $_POST['password']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['url'] == "login") {
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(Auth::accountExists($_POST['username'])) {
            $login_output_array = Auth::login($_POST['username'], $_POST['password']);
            $result = [
                "code" => $login_output_array[0],
                "message"=> $login_output_array[1] 
            ];
        }else{
            $result = [
                "code" => 400,
                "message"=>  "Account does not exists please sign in"
            ];
        }
    }else{
        $result = [
            "code" => 400,
            "message"=>  "Missing Parameters"
        ];
    }
    
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE" && $_GET['url'] == "logout") {
    $Auth::logout();
    $result = [
        "code"=> 204,
        "message"=> "Log out successful"
    ];
}


?>