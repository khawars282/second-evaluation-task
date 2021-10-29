<?php

use DATABASE as GlobalDATABASE;

header("Access-Control-Allow-Origin: *"); 
// allows everyone to access your rest-api

header("Access-Control-Allow-Headers: access"); 
// all header access is allowed 

header("Access-Control-Allow-Methods: POST"); 
//header used to insert data

header("Content-Type: application/json"); 
// used to return json format

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
// the names of the headers that we will be used

// include database class
include 'database.php';


class ProfileMerchant extends Database
{
    // private $table_name = "merchant"; // database Merchant table_name

    function display_profile()
    {
        $table_name = "merchant";
        $data = json_decode(file_get_contents("php://input"), true);
        

        // store secondary decoded data in respective variables
        $id = $data['id'];
        // creating object of class database
        $database = new DATABASE(); 
        // build database connection
        $database->build_connection() or die("no connection");
        
        // echo json_encode($database);
        echo "<pre>";
        
        echo "profile merchant";
        
        $data = $database->searchById($table_name,$id);
        
        return $data;

    }
}



$pf = new ProfileMerchant;

$db = $pf->display_profile();
echo print_r($db);

?>