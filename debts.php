<?php
include('classes/DB.php');
include('classes/Login.php');

$previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col']+1;
$filenamei = "INV".$previnvnumber;
echo($filenamei);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="debts" method="post">
        <h1>Debts</h1>
        <input type="text" name="company" placeholder="company">
        <input type="text" name="description" placeholder="description">
        <input type="number" name="amount" placeholder="amount">
        <input type="date" placeholder="Due">
        <input type="submit" placeholder="submit">
    </form>
</body>
</html>