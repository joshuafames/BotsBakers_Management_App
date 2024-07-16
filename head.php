<head>
    <title>BotsBakers</title>
    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap/dist/css/bootstrap-utilities.css">
    <link href="../dist/css/icons/fontawesome6/css/fontawesome.css" rel="stylesheet">
    <link href="../dist/css/icons/fontawesome6/css/brands.css" rel="stylesheet">
    <link href="../dist/css/icons/fontawesome6/css/solid.css" rel="stylesheet">
    <?php
    if(isset($_GET['mode'])){
        if($_GET['mode']== "dark"){
            echo'<link rel="stylesheet" type="text/css" href="./styles/darkModeStyles.css">';
        }else{
            echo'<link rel="stylesheet" type="text/css" href="./styles/styles.css">';
        }
    }else{
        echo'<link rel="stylesheet" type="text/css" href="./styles/styles.css">';
    }
    ?>
</head>