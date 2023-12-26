
<!DOCTYPE html>
<html>
	<head>
		<title>paginga &mdash; jQuery Pagination Plugin</title>
	
        <link rel="stylesheet" type="text/css" href="../css/paging.css">
		<link rel="stylesheet" type="text/css" href="../css/progreessbar.css">
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="../js/paginga.jquery.js"></script>
        <script src="../js/paginga.jquery.min.js"></script>
		<script src="../js/paginga.jquery.js"></script>
		
		
	</head>

</style>
	<body style="padding:1%">
<?php
require_once('init.php');
include('header.php');
$error = '';

if(!isset($_SESSION['user_name'])) // user connection 
{   
      header('Location: ../includes/index.php');
      exit;
}


// // check if the user is fill part of the survey 
// $numofanswercomplete = $answerquestion->countcomquestnbyusername($_SESSION['user_name']); //get num of question complete 
// $numofanswercomplet = $numofanswercomplete[0]->count ; 
// if($numofanswercomplet>0) // the user answered at least 1 answer at all
// {
// 	header('Location: ../profile/surveyprofile.php');
// 	exit;
// }





$error ='';
 // LOAD PAGE   
// status of user - start , inproceess , finish 
$userdetails = User::find_user_by_username($_SESSION['user_name']);
if (isset($userdetails)){
	$status  = $userdetails[0]->status ;
   }


if($status=="finish" || $status=="inproccess" )
{ 
	echo "<script>window.location.replace('../profile/surveyprofile.php');</script>";
}



$username = $_SESSION['user_name'];
$users = Threetablejoin::selectallthreetable($username);
?>

        <div class="progress">
		<div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">66%</div>
		</div>
		<br />

 	      <h1 style="background-color:orange; width:100%; text-align: left;"> Part 2 - Questions 1-6 </h1>	
		   <br /> <br /> 
		 
		  <form action="../includes/survey3.php" method="post" id="form1" style="text-align:left;">
				<div class="paginate 3">
			     <div class="items">
				 <?php
				  for ($index = 0; $index < 6; $index++) 
				  {
					
				  /////////////////////RADIO //////////////////////////////////////////////
				  if( $_SESSION['question'.($index+1)][1] =="radiobutton")
				  {
					
					  echo("<div id=' . ($index + 1) . '>");
					  echo('<input style=" background-color: lightblue; width:80%; font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][4]) . ' " readonly><br />');
					  echo('<input style=" background-color: lightgray; width:80%; font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
					  foreach ($_SESSION['question'.($index+1)][2] as $value)
					  {  
				  echo('<input  type="radio" id="answer'.($index + 1).'" name="answer'.($index + 1).'"  value="'.$value.' ">
				  <label for="'.$value.'">'.$value.'</label><br>');
					  }
					  echo("</div>");
				  }
			 /////////////////////CHECK  BOX  //////////////////////////////////////////////

				  if( $_SESSION['question'.($index+1)][1] =="checkbox")
				  {
					  echo("<div id=' . ($index + 1) . '>");
					  echo('<input style=" background-color: lightblue; width:80%; font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][4]) . ' " readonly><br />');
					  echo('<input style=" background-color: lightgray; width:80%;font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
					  foreach ($_SESSION['question'.($index+1)][2] as $value)
					  {
						  echo('<input type="checkbox" name="answercheck'.($index+1).'[]" value="'.$value .'"
						  <label for="'.$value.'">'.$value.'</label><br>');
					  }
					  echo("</div>");
				  }
				  echo("</div>");
				}


				
				
				  echo(' <p><input type="submit" value="Next page" name="submit" class="btn btn-warning" style="width:20%;height:80px"></p>');
				
				  echo("</form>  <br />  <br /> ");
                 
				
				?>
            





<?php
// GET 

require_once("../includes/init.php");







if(!empty($_GET))
{

	$error ='';
	$username = $_SESSION['user_name']; // get from session not from survey

	/////////// flight data of user survey ////////////////////////

	$_SESSION["compname"]=$_GET["compname"];
	$_SESSION["classtype"] = $_GET["classtype"];
	$_SESSION["landloc"] = $_GET["landloc"];
	$_SESSION["takeoffloc"]= $_GET["takeoffloc"];
	$_SESSION["delay"] = $_GET["delay"];
	$_SESSION["durationtime"]= $_GET["durationtime"];
	$_SESSION["flightnum"]= $_GET["flightnum"];
	$flightnum =$_GET["flightnum"];
	

//////////////////////////////////////////////////////////////////////////
   


   $flightcheck =  Flight::fetch_flightbyuserflight($flightnum);


   if(isset($flightcheck))// check if flight is exist in database - ERROR
   {
	$_SESSION["errorvalidation"] ="ERROR - Flight number is exist, please enter your correct flight number in database" ;
    //  $error = "ERROR - Flight number is exist, please enter your correct flight number in database";
	//   echo '<script>alert("'.$error.'")</script>';
	  echo('<script> window.location="../includes/survey.php"; </script>');
   }
   else // flight number isnt exist in data
   {

	 $compname = $_SESSION["compname"]; // company name of flight
	$classtype = $_SESSION["classtype"] ; // class type - first second business
	 $landloc = $_SESSION["landloc"];  // land place 
	 $takeoffloc = $_SESSION["takeoffloc"]; // take off place 
	$flightnum = $_SESSION["flightnum"]; // unique flight number 
	
	$companyName= $_SESSION["compname"]; // company name of flight
	$IATACode= $_SESSION["flightnum"]; // unique flight number 
	$flightDepartment= $_SESSION["takeoffloc"]; // take off place 
	$arival=$_SESSION["landloc"];  // land place 
	$classtype = $_SESSION["classtype"] ; // class type - first second business
	$delay =$_SESSION["delay"] ; // delay time 
	$durationtime=$_SESSION["durationtime"]; // duration time of flight


	$flightvalidation1 = new flightValidation($companyName, $IATACode, $flightDepartment, $arival , $classtype , $delay , $durationtime);
    $errortext =  $flightvalidation1->checkall();
    $_SESSION["errorvalidation"] = $errortext ;
					if(strlen(trim($errortext))==0)
					{
							//add flight of survey 
							$flight = new Flight();
							$flight->addnewflight($compname, $classtype ,$flightDepartment ,$arival, $delay , $durationtime, $flightnum);

							// finish to fill the flight part 
							// add empty survey to database
									
									$answer="";
									$questionid="";
									$checkiflabelempty = true;
									$flightnum= $_GET["flightnum"];
										for ($index = 1; $index <= 10; $index++) 
										{
											$answer = NULL;
									
											// insert the survey to three database 
											$questionid = $index;
											$threetablejoin->addsurveythreetable($_SESSION['user_name'] , "",$questionid , $flightnum);
										
									
										}
										//insert three table join of survey
										$threetablejoin = new Threetablejoin();
										$threetablejoin->threetablejoinsurvey($questionid, $username,$flightnum);
								
						}	
						else
						{
							
							
								echo('<script> window.location="../includes/survey.php"; </script>');
						}
						
						
						
						
}
					
					
        }

?>
 </div>


        </body>
        </html>
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 





