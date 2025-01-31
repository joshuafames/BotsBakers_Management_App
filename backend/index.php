<?php
    require('./header.php');
    require('./db.php'); // DEFINES FUNCTION TO CONNECT TO DATABASE
    require('./routes/index.php');

    
    // if(!Auth::isLoggedIn()) {
    //     if($_GET['url'] != "signin" && $_GET['url'] != "login" ) {
    //         $result = "Unauthenticated User";
    //     }
    // }

    if(isset($result["code"])) {
        http_response_code($result['code']);
    }
    echo json_encode($result);
?>