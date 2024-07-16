<?php
include('./classes/DB.php');

print_r($_POST);
$_POST['Buns'] += $_POST['BrownBuns'];
// DB::query('INSERT INTO orders VALUES(\'\', CURRENT_DATE(), NULL, :brown, :white, :rolls, :softis, :burger, :amount, NULL, NULL, :tot, :paymethod)', array(':brown'=>$_POST['BrownBread'], ':white'=>$_POST['WhiteBread'], ':rolls'=>$_POST['Rolls'], ':softis'=>$_POST['Softis'], ':burger'=>$_POST['Buns'], ':amount'=>$_POST['bill-total'], ':tot'=>$_POST['bill-total'], ':paymethod'=>$_POST['paidby']));

if(DB::query('SELECT * FROM `orders` WHERE `Date`= :todaydate AND Client = "POS"', array(':todaydate'=>date("Y-m-d")))){
    $prevData = DB::query('SELECT `BrownBread`,`WhiteBread`,`Rolls`,`Softis`,`BurgerBuns`,`Amount` FROM `orders` WHERE`Date`= :todaydate AND Client = "POS"', array(':todaydate'=>date("Y-m-d")))[0];
    ///BUNS IN APP == BURGERBUNS IN DATABASE
    $_POST['BrownBread'] += $prevData['BrownBread'];
    $_POST['WhiteBread'] += $prevData['WhiteBread'];
    $_POST['Rolls'] += $prevData['Rolls'];
    $_POST['Softis'] += $prevData['Softis'];
    $_POST['Buns'] += $prevData['BurgerBuns'];
    $_POST['bill-total'] += $prevData['Amount'];

    print_r($_POST);

}else{
    DB::query('INSERT INTO orders VALUES(\'\', CURRENT_DATE(), :naam, :brown, :white, :rolls, :softis, :burger, :amount, NULL, NULL, :tot, :paymethod)', array(':naam'=>"POS", ':brown'=>$_POST['BrownBread'], ':white'=>$_POST['WhiteBread'], ':rolls'=>$_POST['Rolls'], ':softis'=>$_POST['Softis'], ':burger'=>$_POST['Buns'], ':amount'=>$_POST['bill-total'], ':tot'=>$_POST['bill-total'], ':paymethod'=>$_POST['paidby']));
}
?>