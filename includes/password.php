<?php
  
require_once('init.php');

class Password{
    private $id;
    private $user;
    private $password;

    
        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
     private function  instantation($pass_array){
        foreach ($pass_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
    public function find_user($user,$password){
        // find specific user in login form by username and password
        global $database;
        $error=null;
        $sql="select * from passwords where user='".$user."' and password='".$password."'";
        $result=$database->query("select * from passwords where user='".$user."' and password='".$password."'");
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
           $found_user=$result->fetch_assoc();
            $this->instantation($found_user);
        }
        else
             $error="Can no find user by this name";
        return $error;
    }
   
    public function get_id(){
        return $this->id;
    }
   
   
}

    
?>

