<?php 
require_once("../includes/init.php");
class validation 
{
    function __construct(){

    }

     # validation for only numbers and letters in string
     public function numbers_and_letters ($text)
     {
       if (!preg_match("#^[a-zA-Z0-9]+$#", $text))
               return "contain not a letter or number char <br />";
      
     }

   # validation for only letters in string
   public function letters_only ($text)
     {
       if (!preg_match ("/^[a-zA-Z\s]+$/",$text))
               return "contain not a letter char <br />";
           
             
     }
}
?>

