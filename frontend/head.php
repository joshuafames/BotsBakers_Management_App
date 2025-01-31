<head>
    <title>Business Management</title>
    <link rel="stylesheet" type="text/css" href="../../external-assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../external-assets/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../external-assets/dist/css/bootstrap-utilities.css">

    <script defer type="text/javascript" src="../utilities/js/jquery-3.3.1.min.js"></script>
    <script defer type="text/javascript" src="../utilities/js/bootstrap.min.js"></script>
    <?php
    if(isset($_GET['mode'])){
        if($_GET['mode']== "dark"){
            echo'<link rel="stylesheet" type="text/css" href="../styles/darkModeStyles.css">';
        }else{
            echo'<link rel="stylesheet" type="text/css" href="../styles/styles.css">';
        }
    }else{
        echo'<link rel="stylesheet" type="text/css" href="../styles/styles.css">';
    }
    ?>
</head>