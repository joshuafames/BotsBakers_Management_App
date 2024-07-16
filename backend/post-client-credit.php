<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_GET['url'] == "post-client-credit") {
        $formData = file_get_contents("php://input");
        $formData = json_decode($formData); 

        db($conn, "UPDATE clients SET credit = credit + ? WHERE name = ?", [$formData->credit, $formData->client_name]);
        echo '{ "Success": "Credit Increased!" }';
    }
    
?>