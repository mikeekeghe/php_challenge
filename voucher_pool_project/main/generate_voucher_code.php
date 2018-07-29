<?php
/**
 * Created by PhpStorm.
 * User: MIKE
 * Date: 7/28/2018
 * Time: 6:51 AM
 */

include('connection.php');
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbName);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$special_offer=$_GET["special_offer"];
$expiry_date=$_GET["expiry_date"];
$percentage_discount=$_GET["percentage_discount"];

// generate 16 digit random no.
$random1 = rand(1111, 9999);
$random2 = rand(1111, 9999);
$random3 = rand(1111, 9999);
$random4 = rand(1111, 9999);
$voucher_code = ($random1."-".$random2."-".$random3."-".$random4);

//inserting voucher code to table
$today = date("Y-m-d");
$use_once = "yes";

$sql1 = "INSERT INTO  voucher_code_tbl (
		expiry_date,
		use_once,
		percentage_discount,
		date_created,
		voucher_code
	) 
	VALUES (
		'$expiry_date',
		'$use_once',
		'$percentage_discount',
		'$today',
		'$voucher_code'
	)";

mysqli_query($con,$sql1);

//inserting special offer to table

$sql2 = "INSERT INTO  special_offer_tbl (
		offer_name,
		voucher_id,
		discount_percent
	) 
	VALUES (
		'$special_offer',
		'$voucher_code',
		'$percentage_discount'
	)";

mysqli_query($con,$sql2);

$response["success"]=$voucher_code;
die(json_encode($response));
