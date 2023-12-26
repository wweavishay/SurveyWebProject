<?php
require_once("../includes/init.php");
if(isset( $_POST['text']))
{
$flight =  Flight::fetch_partflightbyuserflight( trim($_POST['text']));


}


if(isset($flight ))
{

    $flightnum =$flight[0]->flightnum;
    $compname = $flight[0]->compname ;
    $classtype =$flight[0]->classtype  ;
    $landloc =$flight[0]->landloc  ;
    $takeoffloc = $flight[0]->takeoffloc ;
    $delay =$flight[0]->delay;
    $durationtime = $flight[0]->durationtime;


    echo "<b> For filght number : ".$flightnum ." this is the details:</b> <br /> ";
    echo "Company name ".$compname ." <br /> ";
    echo "Class Type ".$classtype." <br /> ";
    echo "Land location ".$landloc." <br /> ";
    echo "Take off location ".$takeoffloc." <br /> ";
    echo "Delay time ".$delay." <br /> ";
    echo "Duration time ".$durationtime." <br /> ";
}
else{
    echo " Sorry can't be able to understand you! ";
   

    echo ' <br /><br />   If you want to get your details flight  , please enter your IATA(flight number) ';
    
}

?>