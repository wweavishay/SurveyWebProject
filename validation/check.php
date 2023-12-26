

<?php
require_once('../includes/init.php');





$companyName="aaa";
$IATACode="laa4";
$flightDepartment="london,uk";
$arival="london, uk";
$classtype ="first ";
$delay ="100";
$durationtime="10";
$flightvalidation1 = new flightValidation($companyName, $IATACode, $flightDepartment, $arival , $classtype , $delay , $durationtime);
// echo($flightvalidation1->checkall());



$userName="aa12";
$password="sdsdaa@A";
$residence="a";
$birtdhday="'2018-09-01'";
$email ="firs@tgmail.com";
$gender="male";
$uservalidation1 = new userValidation($userName, $password,$gender, $residence, $birtdhday, $email);
// echo($uservalidation1->checkall());





?>