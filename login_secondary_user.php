<?php
ini_set('display_errors', 1);
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

class Secondary extends Database
{
    
    private $table_name = "secondary"; // database secondary table_name

    function validation($semail1,$spassword1) // check the validation of secondary credentials
    {
        $t1 = $t2 = true;
        if(!filter_var($semail1, FILTER_VALIDATE_EMAIL))
        {
            //status code 422 because secondary enter invalid email pattern;
            $display_message = array("Status_code"=>422, "Message"=>'Invalid Email Pattern');
            print_r(json_encode($display_message));
            $t1 = false;
            echo $t1;
        }
        if(strlen($spassword1) < 5)
        {
            //status code 422 because secondary password length is less than 10 digits / characters.
            $display_message = array("Status_code"=>422, "Message"=>'Your password must be at least of 5 digits/characters!');
            print_r(json_encode($display_message));
            $t2 = false;
        }
        if(!$t1 == false && !$t2 == false)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

    function login($semail1,$spassword1) // secondary login function
    {


        $db = new DATABASE;
        $conn = $db->build_connection();

        // sql query to check if email and password of secondary exists or not in DB.

        $q1 = "select * from ".$this->table_name ." WHERE password ='{$spassword1}'";
        //print_r ($query);

        $result1 = mysqli_query($conn, $q1);

        $t1 = 0;

        if (mysqli_num_rows($result1) > 0) 
        {
            //echo ("<br>"."90 haq");
           $t1 = 1;
        }
        else
        {
            //echo ("<br>"."nothing");
            $t1 = 0;
        }

        $q2 = "select * from ".$this->table_name ." WHERE email ='{$semail1}'";

        $result2 = mysqli_query($conn, $q2);

        $t2 = 0;

        if (mysqli_num_rows($result2) > 0) 
        {
            //echo ("<br>"."90 haq");
           $t2 = 1;
        }
        else
        {
            //echo ("<br>"."nothing");
            $t2 = 0;
        }

        if($t1 == 1 && $t2 == 1)
        {
            //echo "good";
            return 1;
        }
        else
        {
            //echo "not good";
            return 0;
        }
    }
}

//decode input request parameters and store them in an array.
$data = json_decode(file_get_contents("php://input"), true);

//Check if request method is not $_POST send error message and terminate program.
if($_SERVER["REQUEST_METHOD"] != "POST")
{
    //status code 404 because request method is wrong
    $message_display=array("Status_code"=>404,"Message"=>'Page not found');
    print_r(json_encode($message_display));
    exit();
}

// store secondary decoded data in respective variables
$semail = $data['email'];

// store secondary decoded data in respective variables
$spassword = $data['password'];
//echo $upassword;


// creating object of class database
$database = new DATABASE(); 
// build database connection
$database->build_connection() or die("no connection");

// creating object of the class secondary
$system = new Secondary(); 


// check validations on secondary given inputs
$check = $system->validation($semail,$spassword) or die("no valdation");

// weather $check i empty or not
//echo $check;

if($check == 0) 
{
    // if function validate returns false value close the execution
    echo ("<br>"."zero"."<br>");
    exit();
}
else if($check == 1) 
{
    // if function validate returns true the proceed 
    echo ("<br>"."Check is true for validation"."<br>");
    // calling login function to check secondary login credentials
    $flag = $system->login($semail,$spassword); 
}


if($flag == 1)
{
    //if password and email are matched display this message
    $display_message = array("Status_code"=>200,"Message"=>"Successfully Login!","email"=>"$semail");
    print_r(json_encode($display_message));

    
}
else if($flag == 0)
{

    //if password and email are matched display this message
    $display_message = array("Status_code"=>400,"Message"=>"Something went wrong!","email"=>"$semail","password"=>"$spassword");
    print_r(json_encode($display_message));
}

?>
