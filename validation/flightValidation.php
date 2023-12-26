<?php
require_once("../includes/init.php");
class flightValidation extends validation
{

  private $companyName;
  private $IATACode;
  private $flightDepartment;
  private  $arival;
  private $classtype ;
  private  $delay ;
  private $durationtime;

  function __construct($companyName, $IATACode, $flightDepartment, $arival , $classtype , $delay , $durationtime)
  {
   $this->companyName = $companyName;
   $this->IATACode = $IATACode;
   $this->flightDepartment = $flightDepartment;
   $this->arival = $arival;
   $this->classtype = $classtype;
   $this->delay = $delay;
   $this->durationtime = $durationtime;

  }

  # company name validation - letters and numbers only
  public function company_name($companyName)
  {
    if (empty($companyName))
       return "Company name is empty <br />";
     
       if (strlen($companyName) <=2 )
       return "Company Name is too short ,  minimum 3 charcter <br />  ";

   
  }

  # IATA code validation - 3 letters only
  public function IATA_code($IATACode)
  {
    if (empty($IATACode))
    {
      return "IATA (flight number) is empty <br />";
    }
    if (strlen($IATACode) <3 )
      return "IATA(flight number) is too short ,  minimum 3 charcter , (eg. LY3 , MT178) <br />";
    $validation = "";
    $validation = $this->numbers_and_letters($IATACode);
    if(!empty( $validation))
    {
    return "IATA Code (flight number) ".$validation."<br />";
    }
  }

  # flight_department validation - letters only
  public function flight_department($flightDepartment)
  {
    if (empty($flightDepartment))
    {
      return "Flight Department is empty <br />";
    }
   
  }

  # departure and arivval validation - letters only
  public function arivvel_departure($ad)
  {
    if (empty($ad))
    {
      return "Arrivel departure is empty <br />";
    }
   
  }

  function delaytime($num) {
    if(!ctype_digit($num))
{
  return "Delay time is not valid only positive and integer value between 0-50 <br />";;
}
    $num = intval($num);
    if(is_numeric($num)) {
        if(is_float($num) || is_int($num)) {
            if($num >= 0 && $num <= 50) {
                return "";
            } else {
                return "Delay time is not valid only positive and integer value between 0-50 <br />";
            }
        } else {
            return "Delay time is not valid only positive and integer value between 0-50<br />";
        }
    } else {
        return "Delay time is not valid only positive and integer value between 0-50<br />";
    }
}

function durationtime($num) {
  if(!ctype_digit($num))
{
  return "Duration time of flight is not valid only positive and integer value between 0-50<br />";;
}
  $num = intval($num);
  if(is_numeric($num)) {
      if(is_float($num) || is_int($num)) {
          if($num >= 0 && $num <= 50) {
              return ""; 
          } else {
              return "Duration time is not valid only positive and integer value between 0-50 <br />";
          }
      } else {
          return "Duration time is not valid only positive and integer value between 0-50<br />";
      }
  } else {
      return "Duration time is not valid only positive and integer value between 0-50<br />";
  }



}

  public function checkall()
  {
    $error="";
    if($this->arival == $this->flightDepartment)
      {
      $error = "Arrival location can not the same like Department flight location <br />";
      }
  

  
    $error =  $error . $this->company_name($this->companyName);
    $error =$error . $this->IATA_code($this->IATACode);
    $error= $error.$this->flight_department($this->flightDepartment);
    $error= $error. $this->arivvel_departure($this->arival);
    $error= $error. $this->delaytime($this->delay);
    $error= $error. $this->durationtime($this->durationtime);
    return $error;
  }
}
?>