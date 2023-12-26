<?php

use User as GlobalUser;

require_once('database.php');

class User{
    private $id;
    private $username;
    private $password;
    private $gender;
    private $birtdhday;
    private $residence;
    private $email;
    private $status;
    private $count ; 

    public static function fetch_users(){
        // select all user in database

        global $database;
        $result=$database->query("select * from users");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }
  
    public static function fetch_usersbyuserdetail($type , $var){
        // select all user in database

        global $database;
        $result=$database->query("select count(*) as count ,".$type."  from users
         where ".$type." ='".$var."' group by ".$type  );


        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }

    public static function find_user_by_username($username){
        // select username details by his id 

        global $database;
        $result=$database->query("select * from users where username ='".$username."'");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }

    public function fetch_userbyusername($username){
        // get username details  by username
        global $database;
        $error=null;
        $result=$database->query("select * from users where username='".$username."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
         {
             $error ='there is a exist username like this';
         }
		 
        return $error;
    }
        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
     private function  instantation($user_array){
        foreach ($user_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
    public function find_user_by_name($username,$password){
        // get user detail by password and username
        // check if user is registered 

        global $database;
        $error=null;
        $password = md5($password);
        $result=$database->query("select * from users where username='".$username."' and password='".$password."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
         {
             $error ='Can not find user , please fix and enter a correct details ';
         }
		 
        return $error;
        
    }

    public function find_user_by_id($id){
        // find user details by id 

        global $database;
        $error=null;
        $result=$database->query("select * from users where id='".$id."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
         {
             $error ='Can no find user by this name';
         }
		 
        return $error;
        
    }
    public function updatebyusername($username,$birtdhday,$residence ,$email){
        // update user details

        global $database;
        $error=null;
        $result=$database->query("UPDATE users SET birtdhday ='".$birtdhday."',residence ='".$residence."', email ='".$email."' where username='".$username."'");
		
        if (!$result)
        {
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        
        }
         else
         {
             $error ='Can no find user by this name';
         }
		 
        return $error;
        
    }


    public static function updatestatusbyusername($username, $status){
        // update status user - (onproceess, finish )
        global $database;
        $error=null;
        $result=$database->query("UPDATE users SET status ='".$status."' where username='".$username."'");
		
        if (!$result)
        {
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        
        }
         else
         {
             $error ='Can no find user by this name';
         }
		 
        return $error;
        
    }

    public static function getmaxid(){
        // get the highest id of the users

        global $database;
        $result=$database->query("SELECT (MAX(`id`)+1) AS id FROM `users`;");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        
        return $users;
    }

       
    }
    public static function add_user($id,$username,$password,$gender,$birtdhay,$residence,$email){
      // add a new user details 
      
        global $database;
        $error=null;
        $sql="Insert into users(id,username,password,gender,birtdhday,residence,email,status) values ('".$id."','".$username."','".$password."','".$gender."','".$birtdhay."','".$residence."' ,'".$email."','start' )";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add user.  Error is:'.$database->get_connection()->error;
        return $error;
        
    }
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

   public function get_username()
   {
    return $this->username;
   }
   public function get_id()
   {
    return $this->id;
   }
}

   $user = new User();

?>

