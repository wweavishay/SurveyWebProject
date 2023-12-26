<?php
require_once("../includes/init.php");
class userValidation extends validation
{


   private $userName  ;
   private $password; 
   private $gender ;
   private $birtdhday ;
   private $residence ;
   private $email ;

  function __construct ($userName, $password,$gender ,  $residence, $birtdhday, $email)
  {
    
    $this->userName = $userName;
    $this->password = $password;
    $this->residence = $residence;
    $this->birtdhday = $birtdhday;
    $this->email = $email;
    $this->gender = $gender;

  }

  # Min 4 signs and only letters and numbers are allowed
  public function checkuser_name($userName)
  {
    
    if (empty($userName))
    {
      return "User Name is empty <br />";
    }

      $validation = " ";
      if (strlen($userName) < 4)
         return "User Name must contain 4 letter in minimum <br />";
      $validation = $this->numbers_and_letters($userName);
      return $validation;

  }

  # Min 6 signs and only letters are not allowed - and one capital and speicel char
  public function checkpassword ($password)
  {
    if (empty($password))
    {
      return "Password is empty <br />";
    }

      if (strlen($password) < 6)
         return "Password must contain 6 letters in minimum <br />";

         $uppercase = preg_match('@[A-Z]@', $password);
         $specialChars = preg_match('@[^\w]@', $password);
         if(!$uppercase || !$specialChars) {
             return "Password must contain at least one <b > Speicel character </b> e.g: '!@#$%^&*()'
             and one <b> Capital letter </b> eg. 'ABCEFG...'<br />  ";
         } else {
             return "";
         }


  }



  # year of birth validation - born between 1900 - 2020
  public function checkyear_of_birth ($birtdhday)
  {
    $birtdhday = date('Y', strtotime($birtdhday));
    
    $birtdhday = intval($birtdhday);
    if (empty($birtdhday))
    {
      return "Year of birth(birthday) date is empty <br />";
    }

      if (!is_numeric($birtdhday))
          return "Year of birth (birthday) is not a number<br />";
      if (strlen($birtdhday) != 4)
          return "Year of birth (birthday) is not correct<br />";
      if ($birtdhday< 1900 || $birtdhday > 2020)
          return "Year of birth (birthday) should be between 1900 to 2020<br />" ;
     

  }
  
   # validation for email structre number and letters only
   function checkemail_sturct($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
      return "This is not valid Email (eg . a@gmail.com) <br />";
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
       if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
        return "This is not valid Email (eg . a@gmail.com)<br />";
      }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
      $domain_array = explode(".", $email_array[1]);
      if (sizeof($domain_array) < 2) {
          return "this is not valid Email (eg . a@gmail.com)<br />"; // Not enough parts to domain
      }
      for ($i = 0; $i < sizeof($domain_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
          return "this is not valid Email (eg . a@gmail.com)<br />";
        }
      }
    }
    
  }
   
   
   
 // check all other function validation 
public function checkall()
{
    $error = "";
    if (empty($this->gender))
    {
        $error =  $error."Gender is not chosen <br />";
    }
    if (empty($this->residence))
    {
        $error =  $error."Residence place is not chosen <br />";
    }
    
    $error =  $error .$this->checkuser_name($this->userName);
    $error =  $error .$this->checkpassword($this->password);
    $error =  $error .$this->checkyear_of_birth($this->birtdhday);
    $error =  $error .$this->checkemail_sturct($this->email);
    return $error;
}
}
?>