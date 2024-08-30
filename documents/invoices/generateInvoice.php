<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../classes/DB.php');
include('../../classes/Login.php');

ini_set('max_execution_time', 500);

// Load the phpspreadsheet library
require '../../external-assets/phpspreadsheet/vendor/autoload.php';

//NEW INVOICE ID:
$previnvnumber = DB::query('SELECT MAX(id) AS `col` FROM `invoices`')[0]['col']+1;
$filenamei = "INV".$previnvnumber;

$BrownBread=0;
$WhiteBread=0;
$Rolls=0; 
$Softis=0;
$BurgerBuns=0;
$customerId = '';
$description = '';
$products = $_POST['product'];
for ($i=0; $i < count($products); $i++) { 
	$qty = $_POST['qty'][$i];
	if($products[$i] == "BrownBread"){
		$BrownBread = $qty;
	}elseif ($products[$i] == "WhiteBread") {
		$WhiteBread = $qty;
	}elseif ($products[$i] == "Rolls") {
		$Rolls = $qty;
	}elseif ($products[$i] == "BurgerBuns") {
		$BurgerBuns = $qty;
	}elseif ($products[$i] == "softis") {
		$Softis = $qty;
	}

	$description = $description .$_POST['qty'][$i].'x'. $products[$i];
	if ($i != count($products) - 1) {
		$description = $description.', ';
	}
}

$discount=0;

//CHECK IF CLIENT IS KNOWN
if(!DB::query('SELECT * FROM clients WHERE name = :name OR contact = :contact', array(':name'=>$_POST['client'], ':contact'=>$_POST['contact']))){
	//IF CLIENT IS NEW, ADD CLIENT TO DATABASE
 	$clientaddress = $_POST['address1'].', '.$_POST['address2'].', '.$_POST['address3'];
 	DB::query('INSERT INTO clients VALUES(\'\', :client, :contact, :address, 1, NULL, 0)', array(':client'=>$_POST['client'], ':contact'=>$_POST['contact'], ':address'=>$clientaddress));
}else{
	//IF IS RETURNING CLIENT, INCREASE NUMBER OF ORDERS FROM THIS CLIENT
 	$num_past_orders = DB::query('SELECT num_orders FROM clients WHERE `name` = :client', array(':client'=>$_POST['client']))['0']['num_orders'];
 	DB::query('UPDATE `clients` SET `num_orders` = :num WHERE `clients`.`name` = :client', array(':num'=>$num_past_orders+1 ,':client'=>$_POST['client']));
}

//INSERT ORDER INFO INTO TABLE: `ORDERS`
DB::query('INSERT INTO orders VALUES(\'\', CURRENT_DATE(), :Client, :brown, :white, :rolls, :softis, :burger, :amount, :discount, NULL, :tot, :paymethod)', array(':Client' => $_POST['client'], ':brown'=>$BrownBread, ':white'=>$WhiteBread, ':rolls'=>$Rolls, ':softis'=>$Softis, ':burger'=>$BurgerBuns, ':amount'=>$_POST['invoice-total'], ':discount'=>$discount, ':tot'=>$_POST['invoice-total'], ':paymethod'=>$filenamei));

//INSERT INVOICE INTO TABLE: `INVOICES`
DB::query('INSERT INTO invoices VALUES (\'\', :Client, :Descriptions, :Amount, :Discount, :Amount_Paid, CURRENT_DATE(), :Due_Date)', array(':Client' => $_POST['client'], ':Descriptions'=>$description, ':Amount'=>$_POST['invoice-total'], ':Discount'=>$discount, ':Amount_Paid'=>$_POST['paid'], ':Due_Date'=>$_POST['due']));

// Load the invoice template file
$template = \PhpOffice\PhpSpreadsheet\IOFactory::load("invoicetemplate.xlsx");

$template->getActiveSheet()->setCellValue('F3', date("Y-m-d"));
$template->getActiveSheet()->setCellValue('F4', $filenamei);
$template->getActiveSheet()->setCellValue('F6', $_POST['due']);
$template->getActiveSheet()->setCellValue('A10',$_POST['client']);
$template->getActiveSheet()->setCellValue('F5',$customerId);
$template->getActiveSheet()->setCellValue('A14',$_POST['contact']);
$template->getActiveSheet()->setCellValue('A11',$_POST['address1']);
$template->getActiveSheet()->setCellValue('A12',$_POST['address2']);
$template->getActiveSheet()->setCellValue('A13',$_POST['address3']);
//$template->getActiveSheet()->setCellValue('F33',$_POST['invoice-total']);

for ($i=0; $i < count($products); $i++) {
	$cellnum = 17 + $i;
	$template->getActiveSheet()->setCellValue('A'.$cellnum, $products[$i]);
	$qty = $_POST['qty'][$i];
	$template->getActiveSheet()->setCellValue('D'.$cellnum, $qty);
	$template->getActiveSheet()->setCellValue('C'.$cellnum, $_POST['unitcost'][$i]);
}

// Save the modified Excel file
$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($template, 'Xlsx');
$writer->save($filenamei.'.xlsx');

$excelFilePath = $filenamei.'.xlsx';
$pdfFilePath = $filenamei.'.pdf';

// Command to call the Python script
$command = escapeshellcmd("python excel2pdf.py $excelFilePath $pdfFilePath");

// Execute the command
$output = shell_exec($command);

// // Output the result
// echo "<pre>$output</pre> jj";

echo("200");
?>