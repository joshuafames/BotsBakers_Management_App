<?php
    include('header.php');
    include('db.php');
    include('get-invoices.php');
    include('get-clients.php');
    include('post-client-credit.php');

    
    if(count($result)=== 0){
        $outp = [];
    }
    else{
        $outp = $result;
    }

    
    include('footer.php');
?>