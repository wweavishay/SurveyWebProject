<?php
  
  require_once('init.php');

class Flight{
    private $compname;
    private $classtype;
    private $landloc;
    private $takeoffloc;
    private $delay;
    private $durationtime;
    private $flightnum ;
    private $var1;
    private $var2;
   


    public static function fetch_flightbyargu($var1,$var2, $type ,$limit){
        // statistic design by two variable and compare betwenn them
        global $database;
        $result=$database->query("select ".$var1." ,".$type."(".$var2.") as ".$var2." from flight GROUP BY ".$var1." LIMIT ".$limit );
        $flights=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $flight=new Flight();
                    $flight->instantation($row);
                    $flights[$i]=$flight;
                    $i+=1;
                }
            }
        }
        return $flights;
    }

    public static function fetch_flight(){
        // get all flight details
        global $database;
        $result=$database->query("select * from flight");
        $flights=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $flight=new Flight();
                    $flight->instantation($row);
                    $flights[$i]=$flight;
                    $i+=1;
                }
            }
        }
        return $flights;
    }




    public static function fetch_flightbyuserflight($flightnum){
        // get flight of user
        global $database;
        $result=$database->query("select * from flight where flightnum='".$flightnum."'");
        $flights=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $flight=new Flight();
                    $flight->instantation($row);
                    $flights[$i]=$flight;
                    $i+=1;
                }
            }
        }
        return $flights;
    }




    public static function fetch_partflightbyuserflight($flightnum){
        // get flight of user
        global $database;
        $result=$database->query("select * from flight where flightnum like '%".$flightnum."%'");
        $flights=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $flight=new Flight();
                    $flight->instantation($row);
                    $flights[$i]=$flight;
                    $i+=1;
                }
            }
        }
        return $flights;
    }
    function __construct() {

    }


    public static function addnewflight($compname, $classtype ,$landloc ,$takeoffloc, $delay , $durationtime, $flightnum){
        // add new flight of user input survey 
        
        global $database;
        $error=null;
        $sql="
            INSERT INTO flight (compname, classtype ,landloc ,takeoffloc, delay , durationtime, flightnum )  
            values ('".$compname."','".$classtype."','".$landloc."','".$takeoffloc."','".$delay."','".$durationtime."' ,'".$flightnum."' );
               ";
          $result=$database->query($sql);
        if (!$result)
            $error='Can not add tranzaction. ';
        return $error;
        
    }

    public static function updateflight($compname, $classtype ,$landloc ,$takeoffloc, $delay , $durationtime, $flightnum){
        // add new flight of user input survey 
        
        global $database;
        $error=null;
        $sql="
        UPDATE  flight  
        SET compname='".$compname."', classtype='".$classtype."',landloc='".$landloc."',takeoffloc='".$takeoffloc."',delay='".$delay."',durationtime='".$durationtime."'
        WHERE flightnum ='".$flightnum."'";
 
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
   

    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

   
}

    
?>

