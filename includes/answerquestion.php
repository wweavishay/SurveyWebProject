<?php
  
require_once('database.php');

class Answerquestion{
    private $id;
    private $answer;
    private $questionid;
    private $count;
   
    public static function fetch_answerquestion(){
        // get all anwer and question
        global $database;
        $result=$database->query("select * from answerquestion");
        $answerquestions=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $answerquest=new Answerquestion();
                    $answerquest->instantation($row);
                    $answerquestions[$i]=$answerquest;
                    $i+=1;
                }
            }
        }
        return $answerquestions;
    }
    public static function fetch_answerquestionbyquestnum($questionnum){
        // count answer and question - group by answer
        global $database;
        $result=$database->query("select COUNT(answer) AS count ,answer from answerquestion where questionid='".$questionnum."' GROUP BY answer ");
        $answerquestions=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $answerquest=new Answerquestion();
                    $answerquest->instantation($row);
                    $answerquestions[$i]=$answerquest;
                    $i+=1;
                }
            }
        }
        return $answerquestions;
    }



    public static function fetch_answerquestionbyquestnumandusername($questionnum , $username){
        // count answer and question - group by answer
        global $database;
        $result=$database->query("select answer 
        from answerquestion
        where questionid='".$questionnum."' and username='". $username."'");
        $answerquestions=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $answerquest=new Answerquestion();
                    $answerquest->instantation($row);
                    $answerquestions[$i]=$answerquest;
                    $i+=1;
                }
            }
        }
        return $answerquestions;
    }
   
    public static function countcomquestnbyusername($username){
        // count question that filled by speific username 
        global $database;
        $result=$database->query("select COUNT(answer) AS count ,answer from answerquestion where username='".$username."' and answer!='' 	 ");
        $answerquestions=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $answerquest=new Answerquestion();
                    $answerquest->instantation($row);
                    $answerquestions[$i]=$answerquest;
                    $i+=1;
                }
            }
        }
        return $answerquestions;
    }   
########  INSERT  #################################

    // public static function addsansquestsurvey( $id , $username , $answer,$questionid){
    //     // add question of survey 
  
    //       global $database;
    //       $error=null;
    //       $sql="INSERT INTO answerquestion (id,answer , questionid , username) 
    //           values ('".$id."' ,'".$answer."','".$questionid."','".$username."' );";
    //         $result=$database->query($sql);
    //       if (!$result)
    //           $error='Can not add tranzaction. ';
    //       return $error;
          
    //   }
    

    public  function addsansquestsurvey( $username , $answer,$questionid){
        // add question of survey 
  
          global $database;
          $error=null;
          $sql="INSERT INTO answerquestion (id,answer , questionid , username) 
              values ((SELECT MAX( id )+1 FROM answerquestion cust) ,'".$answer."','".$questionid."','".$username."' );";
            $result=$database->query($sql);
          if (!$result)
              $error='Can not add tranzaction. ';
          return $error;
          
      }



      public static function getmaxanswer(){
        // get all anwer and question
        global $database;
        $result=$database->query("
        select id from answerquestion order by id desc limit 1;   ");
        $answerquestions=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $answerquest=new Answerquestion();
                    $answerquest->instantation($row);
                    $answerquestions[$i]=$answerquest;
                    $i+=1;
                }
            }
        }
        return $answerquestions;
    }
########  UPDATE #################################

      public static function updateansquestsurvey( $username ,$answer,$questionid){
        // add question of survey 
  
          global $database;
          $error=null;
          $sql="
          UPDATE  answerquestion  
          SET answer='".$answer."'
          WHERE questionid ='".$questionid."' and username ='".$username."'";
              
            $result=$database->query($sql);
          if (!$result)
              $error='Can not add tranzaction. ';
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
    public  function find_answers_by_name($username){
        // find answer the the username filled
        global $database;  //// neeed to work on this
        $error=null;
        $result=$database->query("select *  from answerquestion where username='".$username."' ");
		
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
   
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

  
}

$answerquestion = new Answerquestion();



    
?>

