<?php
  
require_once('init.php');

class Session{
    private $signed_in;
    private $user_id;
    private $user_name;
    
   
    public function __construct(){
        session_start();
        $this->check_login();
    }
    
     private function check_login(){
        // checl login of user 
        if (isset($_SESSION['user_id'])){
            $this->user_id=$_SESSION['user_id'];
            $this->user_name =  $_SESSION['user_name'];
            $this->signed_in=true;
        }
        else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }
    
    public function login($user){
        // insert user detail to session

        if($user){
            $this->user_id=$user->get_id();
            $_SESSION['user_id']=$user->get_id();
            $_SESSION['user_name'] = $user->get_username();
            $this->signed_in=true;
        }
    }
    
       
    public function logout(){
        // delete user detail from session
        echo 'logout';
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($this->user_id);
        $this->signed_in=false;
        
    }
    
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }
     
}
$session=new Session();


    
?>

