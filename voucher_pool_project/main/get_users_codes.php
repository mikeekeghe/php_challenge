<?php
/**
 * Created by PhpStorm.
 * User: MIKE
 * Date: 7/28/2018
 * Time: 10:57 AM
 */

include('connection.php');
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbName);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$email=$_GET["email"];


$success=0;
$status="Active";
$sql = "SELECT s.offer_name, v.voucher_code
				FROM special_offer_tbl s, voucher_code_tbl v
				WHERE v.recipient_id ='" . $email . "'";

$result = mysqli_query($con,$sql) or die("Error querying DB");

while ($row = mysqli_fetch_array($result)) {
    // All results onto a single array
    $results = $row;
}
// Supply header for JSON mime type
//header("Content-type: application/json");

$json_output["results"] = json_encode($results);


//echo $sql;

echo $json_output["results"];
mysqli_close($con);