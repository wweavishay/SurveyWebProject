

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
	<body style="padding-left: 10px;">
<?php
require_once('init.php');
include('header.php');
$error = '';

if(!isset($_SESSION['user_name'])) // user connection
{
     
      header('Location: ../includes/index.php'); // redirect
      exit;
}

// check if the user is fill part of the survey - at least 1 answer
$numofanswercomplete = $answerquestion->countcomquestnbyusername($_SESSION['user_name']); //get num of question complete 
$numofanswercomplet = $numofanswercomplete[0]->count ; 
if($numofanswercomplet>0) // the user answered at least 1 answer at all
{
	header('Location: ../profile/surveyprofile.php'); // redirect
	exit;
}


      $threetablejoin =  new Threetablejoin();
       $errorflightisntexist = $threetablejoin->find_flight_by_username($_SESSION['user_name']);
       if(!$errorflightisntexist)
       {

?>
		
		<div class="progress">
		<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
		</div>
		<br />


          <h1 style="background-color:orange; width:100%; text-align: left;"> Part 3 - Questions 7-10 </h1>	
		  <br /> <br /> 
		 
		  <form action="../includes/surveyfinish.php" method="post" id="form1" style="text-align:left;">
				<div class="paginate 3">
			     <div class="items">
				 <?php
				  for ($index = 6; $index < $_SESSION['numberofquestion']; $index++) 
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
		  
				}
				echo("</div>");
				
	

				echo( '<br /><br /><form>
				<input type="button"class="btn btn-warning" value="Go back!" onclick="history.back()" style="width:20%;height:80px">
				</form>');
                echo(' <br /> <br /><br /> <p><input type="submit" value="Save survey" name="submit" class="btn btn-success" style="width:40%;height:80px; position: absolute;left: 30%;"></p>');
	
                echo("</form>");
				
				
				
				
				
				
				?>
           

                 </div>
				 
				
        </body>
        </html>
<!--Footer -->
<?php } include('../includes/footer.php');?>
<!-- /Footer--> 


<?php

// if($status=="finish" || $status=="inproccess" )
// { 
// 	echo "<script>window.location.replace('../profile/surveyprofile.php');</script>";
// }


if(!empty($_POST))
{



for ($index =1; $index <=7 ; $index++) // first seven question 
{
	$answer="";
	if(isset( $_POST[strval("answer".$index)]))
	{
    $answer = $_POST[strval("answer".$index)]; // get answer by post method
	}

    if($answer =="" )
    {
        $checkiflabelempty = false; // one of the label is empty; 
    }
	else
	{
		$_SESSION["validationasnwerall"] = $_SESSION["validationasnwerall"]+1;
        // $_SESSION[strval("answer".$index)] = $answer; 
	}

    if(isset($_POST['answercheck'.$index])) 
    {
        $items = $_POST['answercheck'.$index];
        $arrayanswer ="";
        foreach ($items as $value){
        $arrayanswer  = $arrayanswer.",".$value;
        }
        $answer = $arrayanswer;
		// $_SESSION[strval("answer".$index)] = $answer; 
		$_SESSION["validationasnwerall"] = $_SESSION["validationasnwerall"]+1;
    } 
    // insert the survey to three database 
    $questionid = $index;
    $threetablejoin->updatesurveythreetable($_SESSION['user_name'] , $answer,$questionid , $_SESSION["FLIGHTNUM"]);
    

}

}










$error ='';
 // LOAD PAGE   
// status of user - start , inproceess , finish 
$userdetails = User::find_user_by_username($_SESSION['user_name']);
if (isset($userdetails)){
	$status  = $userdetails[0]->status ;
   }

// if($status=="finish" || $status=="inproccess" )
// { 
// 	echo "<script>window.location.replace('../profile/surveyprofile.php');</script>";
// }


?>