<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{

    public function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","merchant_db");
        if ($conn->connect_error){
            echo "Database Connection Error";
        }
        else{
            return $conn;
        }
    }
    public function close_connection($conn){   //close database connection
        $conn->close();
    }

    // This functioon is used to search with specific  id.
     
    function searchById($tableName,$id)
    {
        $conn = self::build_connection();
        $sql = "SELECT * FROM ".$tableName ." WHERE id LIKE id='{$id}'";
        $result = $conn->query($sql) or die("SQL Query Failed.");

        if(mysqli_num_rows($result) > 0 ){
            
            $output = $result->fetch_assoc();
            return $output;
        }else{

            return json_encode(array("message"=>'No Search Found.'));
        }   
        self::close_connection($conn);
    }
    // This function is used to select user from table with the specific email.
     
    function search_by_email($tableName,$email)        // searching employee by email
    {
        $conn = self::build_connection();
        $sql = "select * from ".$tableName ." WHERE email='{$email}'";
        $result = $conn->query($sql);
        self::close_connection($conn);
        if($result->num_rows > 0){  //if value >0 true
            return true;
        }
        else{
            return false;
        }
    }

    function insert()
    {
        $conn = self::build_connection();
        $sql = "INSERT INTO merchant SET name = ?, email = ?, password = ?, profile_picture = ?";
        // $sql = "INSERT INTO merchant(name, email, password, profile_picture) 
        //  VALUES ('$name', '$email', '$password', '$profile_picture')";
        $conn->query($sql);
        self::close_connection($conn);
    }
    function mSignUp($name,$email,$password,$card_number,$profile_picture)
    {
        $conn = self::build_connection();
        $sql = "INSERT INTO merchant SET name ='$name', email ='$email', password ='$password', profile_picture ='$profile_picture'";
        $result =  mysqli_query($conn,$sql);
        $m_id = $conn->insert_id;
        $sql = "INSERT INTO credit_info SET merchant_id ='$m_id', amount ='60' ,card_number ='$card_number',address = '$address'";
        $result =  mysqli_query($conn,$sql);
        // $sql = "INSERT INTO payment SET merchant_id ='$m_id',amount ='50'";
        // $result =  mysqli_query($conn,$sql);
        self::close_connection($conn);

        

    }

    // This functioon is used to search with specific  id.

    function list($tableName)
    {
        $conn = self::build_connection();
        $sql = "SELECT * FROM ".$tableName ."";
        $result = $conn->query($sql) or die("SQL Query Failed.");

        if(mysqli_num_rows($result) > 0 ){
            
            $output = $result->fetch_all();
            // print_r($output);
            echo json_encode($output);
            return $output;
        }else{

            return json_encode(array("message"=>'No Search Recod Found.'));
        }   
        self::close_connection($conn);
        
    }
     // to create projects
  public function create_secondary(){

    $sql = "INSERT into secondary SET merchant_id = ?, name = ?, email = ?, password = ?, token = ?";
    $obj = $this->conn->prepare($sql);
    // sanitize input variables
    $name = $this->name;
    $email = $this->email; 
    $password =$this->password;
    $token =$this->token;

    // bind parameters
    $obj->bind_param("isss", $this->user_id, $name, $email, $password, $token);

    if($project_obj->execute()){
      return true;
    }

    return false;

}
}
?>