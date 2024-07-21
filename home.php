<?php
    include('classes/DB.php');
    include('classes/Login.php');

    $showTimeline = False;
    if (Login::isLoggedIn()) {
            $userid = Login::isLoggedIn();
            $showTimeline = True;

            $myusername = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))['0']['username'];
            $prevData = DB::query('SELECT `BrownBread`,`WhiteBread`,`Rolls`,`Softis`,`BurgerBuns`,`Amount`,`Total_Amount` FROM `orders` WHERE`Date`= :todaydate AND Client = "POS"', array(':todaydate'=>date("Y-m-d")))[0];
            echo("<pre>");
            print_r($prevData);
            echo("<pre/>");

            // $mydata = array(1,2,3,4,5);
            // $mydata2 = array(2,3,4,5,6);
            // for ($i=0; $i < count($mydata); $i++) { 
            //     echo $i."th index = ".$mydata[$i] + $mydata2[$i]; 
            //     echo("<br/>");
            // }
    }else{
        header('Location: ./login.php');

    }
?>

<html>
<head>
    <title>BotsBakers - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
</head>
<body>
    <form method="post" action="./home.php" name="order" class="hide">
        <input type="text" name="clientname" placeholder="Client Name">
        <p>Items:</p>
            <input type="radio" name="item" value="Brown Bread" id="brownbread">
            <label for="brownbread">Brown Bread</label>
            <input type="radio" name="item" value="White Bread" id="whitebread">
            <label for="whitebread">White Bread</label>
            <input type="radio" name="item" value="Long Rolls" id="longrolls">
            <label for="longrolls">Long Rolls</label>
            <input type="radio" name="item" value="Burger Buns" id="burgerbuns">
            <label for="burgerbuns">Burger Buns</label><br>
        <input type="checkbox" name="Sliced">Sliced <br>
        <input type="text" name="quantity" placeholder="how many">
        <input type="submit" name="order" class="btn-primary">

    </form>
    <div class="left-menu">
        <h3 class="p-4">BotsBakers</h3>
        <ul class="left-menu-nav px-2">
            <li><a href="./dashboard.php"><i class="mdi mdi-chart-line"></i> Dashboard</a></li>
            <li><a class="active" href="#"><i class="mdi mdi-cart"></i> Orders</a></li>
            <li><a href="./invoicepage.php"><i class="mdi mdi-cash-multiple"></i> Invoices</a></li>
            <li><a href="#"><i class="mdi mdi-receipt"></i> Expenses</a></li>
            <li><a href="#"><i class="mdi mdi-account-card-details"></i> Human Resourses</a></li>
        </ul>
    </div>
    <div class="container main-body p-4">
        <div class="header-sec">
            <h1>Orders</h1>
        </div>
        <p class="hanging-description">Add description</p>
        <div class="nav-section table-nav pb-4">
            <nav class="nav-bar nav">
                <ul>
                    <li class="nav-item"><a class="nav-link active greytext" href="">All</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Pending</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Completed</a></li>
                    <li class="nav-item"><a class="nav-link greytext" href="">Quick Overview</a></li>
                </ul>
            </nav>
        </div>

        

        <div class="action-bar nav mb-4">
            <button class="btn-primary btn me-2"><i class="mdi mdi-plus me-1" ></i>New</button>
            <button class="btn greytext me-2"><i class="mdi mdi-magnify me-1"></i>Search</button>
            <button class="btn greytext me-2"><i class="mdi mdi-filter-outline me-1"></i>filter</button>
            <button class="btn greytext me-2"><i class="fa fa-sort me-1"></i>sort</button>
        </div>

        <div class="table container mb-4">
            <div class="table-head-row row">
                <div class="col-1"><p>#</p></div>
                <div class="col-2"><p>Order Name</p></div>
                <div class="col-1"><p>Brown Bread</p></div>
                <div class="col-1"><p>White Bread</p></div>
                <div class="col-1"><p>Rolls</p></div>
                <div class="col-1"><p>Softis</p></div>
                <div class="col-1"><p>Burger Buns</p></div>
                <div class="col-1"><p>Value</p></div>
                <div class="col-1"><p>Payment Method</p></div>
                <div class="col-1"><p>Priority</p></div>
                <div class="col-1"><p>ETC</p></div><!--- ESTIMATED TIME OF COLLECTION -->
            </div>
            <div class="single-table-row row">
                <div class="col-1"><p>1</p></div>
                <div class="col-2"><p>Tlotlanang School</p></div>
                <div class="col-1"><p>12</p></div>
                <div class="col-1"><p>2</p></div>
                <div class="col-1"><p>5</p></div>
                <div class="col-1"><p>3</p></div>
                <div class="col-1"><p>3</p></div>
                <div class="col-1"><p>R350</p></div>
                <div class="col-1"><p>Paid</p></div><!--- ESTIMATED TIME OF COLLECTION -->
                <div class="col-1 priority-high"><p>High</p></div>
                <div class="col-1"><p class="order-status done">Paid</p></div>
            </div>
            <div class="single-table-row row">
                <div class="col-1"><p>2</p></div>
                <div class="col-2"><p>Mochina</p></div>
                <div class="col-1"><p>12</p></div>
                <div class="col-1"><p>2</p></div>
                <div class="col-1"><p>5</p></div>
                <div class="col-1"><p>3</p></div>
                <div class="col-1"><p>3</p></div>
                <div class="col-1"><p>R500</p></div>
                <div class="col-1"><p class="pending">Pending</p></div>
                <div class="col-1 priority-low"><p>Low</p></div>
                <!--- ESTIMATED TIME OF COLLECTION -->
                <div class="col-1"><p class="order-status">nt</p></div>
            </div>   
        </div>
    </div>
        
</body>
</html>