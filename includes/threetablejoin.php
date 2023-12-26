<?php
  
require_once('init.php');

class Threetablejoin{
    private $id;
    private $username;
    private $compname;
    private $classtype;
    private $landloc;
    private $takeoffloc;
    private $delay;
    private $durationtime;
    private $flightnum ;
    private $answer;
    private $questionid;
    private $count;
    private $status;


    


    public static function selectallthreetable($username){
        
        global $database;
        $result=$database->query(" SELECT  *                
        from answerquestion , flight , threetablejoin, users
        where  
        threetablejoin.username = users.username and
        threetablejoin.flightnum = 	flight.flightnum and
        users.username = answerquestion.username     and
        users.username ='".$username."'
        group by answerquestion.id
        ;
    ");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new Threetablejoin();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }


    public static function selectdetailflightfromuser($username){
        // select flight of the user
        // by join theee table 

        global $database;
        $result=$database->query(" SELECT  *                
        from  flight , threetablejoin, users
        where  
        threetablejoin.username = users.username and
        threetablejoin.flightnum = 	flight.flightnum and
        users.username ='".$username."' and
        threetablejoin.username='".$username."' 
        ;
    ");
        $threetables=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $thretable=new Threetablejoin();
                    $thretable->instantation($row);
                    $threetables[$i]=$thretable;
                    $i+=1;
                }
            }
        }
        return $threetables;
    }

    public function find_flight_by_username($username){
        // get flight detail by  username 

        global $database;
        $error=null;
        $result=$database->query("select * from threetablejoin where username='".$username."' ");
		
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
###################INSERT SURVEY ##########################################################
    public static function addsurveythreetable($username , $answer,$questionid , $flightnum){

       // insert   answer , username , flight details to 3 tables

        // //insert answer of question of survey 
        // $answerquestion = new Answerquestion();
        // $maxid = (($answerquestion->getmaxanswer()[0]->max) + 1);

    $answerquestion = new Answerquestion();
    $answerquestion->addsansquestsurvey($username, $answer,$questionid);
    
    }
    public static function threetablejoinsurvey($questionid, $username , $flightnum){
        // insert three table join of survey user input 
        global $database;
        $error=null;
        $sql="
            INSERT INTO threetablejoin (id, username ,flightnum,ideries)  
            values ('".$questionid."','".$username."','".$flightnum."',
            (SELECT MAX( ideries )+1 FROM threetablejoin cust) );";
          $result=$database->query($sql);
        if (!$result)
            $error='Can not add tranzaction. ';
        return $error;
        
    }
############################## UPDATE SURVEY ###########################################################



public static function updatesurveythreetable($username , $answer,$questionid , $flightnum){
       
    //insert answer of question of survey 
    $answerquestion = new Answerquestion();
    $answerquestion->updateansquestsurvey($username, $answer,$questionid);
    


}


   
    

#########################################################################################
    





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
    

    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

  
}


$threetablejoin = new Threetablejoin(); 

?>

