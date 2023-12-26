<?php
  
require_once('database.php');

class Question{
    private $idquestion;
    private $typequest; // radiobutton , checkbox
    private $values;
    private $question;



    public function __construct($idquestion , $typequest,$values,$question , $catagroy){
       
        $_SESSION['question'.$idquestion] =  array($idquestion,$typequest ,$values, $question,$catagroy); //fill question
    }
    
    
     
}

    
