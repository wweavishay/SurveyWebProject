<?php


require_once("../includes/init.php");

// if($status=="finish" || $status=="inproccess" ) // redirect if user has filled part of survey
// { 
// 	echo "<script>window.location.replace('../profile/surveyprofile.php');</script>";
// }


			if (!empty($_POST))
			{
			// finish to fill the survey part

			$answer="";
			$questionid="";
			$checkiflabelempty = true;
			$username = $_SESSION['user_name'];
			$flightnum=$_SESSION["flightnum"];
			// for loop on numer of question 
			// fill the database with answers for two tables - answerquestion/threetablejoin
				for ($index = 7; $index <= $_SESSION['numberofquestion']; $index++) 
				{
					$answer="";

					if(isset($_POST[strval("answer".$index)]))
					{
						$answer = $_POST[strval("answer".$index)];
						$_SESSION[strval("answer".$index)] = $answer ; 
					}
					if($answer =="" )
					{
						$checkiflabelempty = false; // one of the label is empty; 
					}
					else
					{
						$_SESSION["validationasnwerall"] = $_SESSION["validationasnwerall"]+1;
					}


					if(isset($_POST['answercheck'.$index])) 
					{
						$items = $_POST['answercheck'.$index];
						$arrayanswer ="";
						foreach ($items as $value){
						$arrayanswer  = $arrayanswer.",".$value;
						}
						$answer = $arrayanswer;
						$_SESSION[strval("answer".$index)] = $answer ; 
						$_SESSION["validationasnwerall"] = $_SESSION["validationasnwerall"]+1;
					} 
					// insert the survey to three database 
					$questionid = $index;
					$threetablejoin->updatesurveythreetable($_SESSION['user_name'] , $answer,$questionid , $_SESSION["flightnum"]);
					
				}


				//update status of user 
				$userdetail = new User();
				if($_SESSION["validationasnwerall"] == $_SESSION['numberofquestion'] ) // user answerd all question
					{
						    echo '<script>alert("Your survey is complete succefully ")</script>';
							$userdetail->updatestatusbyusername($username ,"finish"); // update status
							echo('<script> window.location="../profile/surveyprofile.php"; </script>'); // redirect to profile survey 
					}
					else
					{
						if($_SESSION["validationasnwerall"] ==0) // user not answered any question
						{
							echo '<script>alert("Your survey is empty , it doesnt save ")</script>';
							echo('<script> window.location="../includes/index.php"; </script>');// redirect to profile survey 
		
						}
						else // user  answered at least one  question
						{
							echo '<script>alert("Your survey is saved ")</script>';
							$userdetail->updatestatusbyusername($username ,"inproccess");// update status
							echo('<script> window.location="../profile/surveyprofile.php"; </script>');// redirect to profile survey 
		
						}
										}
					
				}
			

			

?>






