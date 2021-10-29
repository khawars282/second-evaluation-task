<?php

use DATABASE as GlobalDATABASE;

header("Access-Control-Allow-Origin: *"); 
// allows everyone to access your rest-api

header("Access-Control-Allow-Headers: access"); 
// all header access is allowed 

header("Access-Control-Allow-Methods: GET"); 
//header used to insert data

header("Content-Type: application/json"); 
// used to return json format

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
// the names of the headers that we will be used

// include database class
include 'database.php';


class AllPayment extends Database
{
    private $table_name= "payment"; // database payment table_name

    function display_all_payment()
    {
        $db = new DATABASE;

        $conn = $db->build_connection();
        $q2 = "select * from ".$this->table_name." ";
        $result = $conn->query($q2);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $db->close_connection($conn);
        return $data;

    }
}

$pay = new AllPayment;

$db = $pay->display_all_payment();
echo json_encode($db);

?>