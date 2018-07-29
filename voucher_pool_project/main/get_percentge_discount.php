<?php
/**
 * Created by PhpStorm.
 * User: MIKE
 * Date: 7/28/2018
 * Time: 7:09 AM
 */
include('connection.php');
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbName);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$voucher_code=$_GET["voucher_code"];
$email=$_GET["email"];
//check if voucher exists
$sql1 = "SELECT voucher_code
				FROM voucher_code_tbl WHERE voucher_code ='" . $voucher_code  ."'";
$result1 = mysqli_query($con,$sql1) or die("Error querying DB");
if($result1->num_rows == 0) {
    // row not found, do nothing...
    $json_output["percentage_discount"]='{"percentage_discount":';
    $json_output["percentage_discount"] .= json_encode("No Record found");
    $json_output["percentage_discount"] .="}";
    echo $json_output["percentage_discount"];
} else {
    //fetching percentage_discount part
    $sql2 = "SELECT  percentage_discount
				FROM voucher_code_tbl WHERE voucher_code ='" . $voucher_code  ."'";
    $result = mysqli_query($con,$sql2) or die("Error querying DB");

    while ($row = mysqli_fetch_array($result)) {
        $results = $row;
    }
    $json_output["percentage_discount"] = json_encode($results);

    //insert date of usage
    $today = date("Y-m-d");
    $sql3 = "UPDATE  voucher_code_tbl SET date_used = '".$today."',recipient_id = '"
        .$email."' WHERE voucher_code ='"
	 . $voucher_code  ."'";
    mysqli_query($con,$sql3);

    //insert recipient
    $sql4 = "INSERT INTO  recipient_tbl (
		email,
		voucher_id
	) 
	VALUES (
		'$email',
		'$voucher_code'
		}";

    mysqli_query($con,$sql4);

    //output Json
   echo $json_output["percentage_discount"];
}

mysqli_close($con);