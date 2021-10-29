<?php
ini_set('display_errors', 1);
require_once('database.php');
require_once('mail_chatcher.php');
class mSignUp
{
    
      public function signUp($name,$email,$password,$card_number,$profile_picture)
      {
        $tableName = "merchant";
        $db=new Database();

            $response=$db->search_by_email($tableName,$email);
            echo $response;
            if (!$response)
            {
                return json_encode(array("message"=>'Email Already Exist'));
               
            }
            $signup_response=$db->mSignUp($name,$email,md5($password),$card_number,$profile_picture);
            
            $mail_response=smtp_mailer($email,"Weclome!",'Congrats! You have credit $60');
            if($mail_response)
            {
            return json_encode(array(
                "status" => 'valid',
                "key" => '400',
                "message"=>'Signup Successfully.',
                "description" => 'Now you can access'));
            }
            else
            {
            
            return json_encode(array(
                "status" => 'invalid',
                "key" => '400',
                "message"=>'Signup Failed.',
                "description" => 'Try again'));
            }
            
            
           
        
        
        
        
        
      }
}

$inputArr=['name','email','password','card_number','profile_picture'];

if (isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['name']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $card_number=$_POST['card_number'];
    $profile_picture=$_POST['profile_picture'];
    $merchant_class=new mSignUp();
    $merchant_class->signUp($name,$email,$password,$card_number,$profile_picture);
}
?>