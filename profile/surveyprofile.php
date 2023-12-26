<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" type="text/css" href="../css/paging.css">
   <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="../js/paginga.jquery.js"></script>
    <script src="../js/paginga.jquery.min.js"></script>
    <script src="../paginga.jquery.js"></script>

    <style>
fieldset {
background-image: linear-gradient(#FF8489 , #7F53AC);
  width: 80%;
  text-align: center;
  left: 10%;
  position: relative;
}

legend {

    background: linear-gradient(palegreen , palegreen);
    width: 80%;
  text-align: left;
  left: 10%;
  position: relative;

}


</style>
</head>

<body style="background-color:lightblue">

    <?php

    require_once('../includes/init.php');
    include('../includes/header.php');

  

    if (!$session->signed_in){
        header('Location: ../login/login.php');
        exit;
    }
    ?>


<div style="text-align:center ; margin:auto">
        <form action="" method="POST" >
    
                <h1><img src="../images/updateuser1.png" width="80px" height="80px">Survey details </h1>
                <hr>

                <?php

                if (!$database->get_connection()) {
                    die(" Connection fails <br>");
                }
            
            
                $username = $_SESSION['user_name'];
                $users = Threetablejoin::selectallthreetable($username);
                if (isset($users)) {


                    //status of user - start , inproceess , finish 
                    $userdetails = User::find_user_by_username( $_SESSION['user_id']);
                    if (isset($userdetails)){
                        $state  = $userdetails[0]->status ;
                    }

                 
      
    //////////////////////////////////////// progress bar///////////////////////////////////
    
    $numofanswercomplete = $answerquestion->countcomquestnbyusername($_SESSION['user_name']); //get num of question complete 
    $numberofquestion = $_SESSION['numberofquestion'];
    echo ("<div style='background-color:aliceblue;padding:5px;text-align: left;'> 
    Progrss Chart <h4> status " . $users[0]->status . "</h4>");
    echo("Complete ".$numofanswercomplete[0]->count." from  ".$numberofquestion." answers  <br />");
    $numofanswercomplete =  intval($numofanswercomplete[0]->count);
    $percentageprogress = (100*($numofanswercomplete )/$numberofquestion);
    echo('<div class="progress" style="height: 25px;  font-size: large;">
   <div class="progress-bar progress-bar-striped" role="progressbar" style="width:'.$percentageprogress.'%;" aria-valuenow="'.$percentageprogress.'" ;  
   aria-valuemin="0" aria-valuemax="100">'.$percentageprogress.'%</div>
 </div>');



    $status = $users[0]->status;
    $n = 60;

    echo (' </div>   <br /> ');



      /// display flight details  ////////////////////////////////////////
                
      $flight = Threetablejoin::selectdetailflightfromuser($_SESSION['user_name']);  
      echo('<input style=" background-color: gold; width:95%; font-size:25px;" type="text"  value="Part 1 - " readonly><br />');
      echo(" <br /><legend> Flight details </legend> <fieldset>    ")      ;                               
      echo ('<div><br /><b> Compny name flight  </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="compname" name="compname" value="'. $flight[0]->compname . ' " readonly ></div> ');
      echo ('<div><b>class type  </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="classtype" name="classtype" value="'. $flight[0]->classtype . ' " readonly></div> ');
      echo ('<div><b>Land location flight  </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="landloc" name="landloc" value="'. $flight[0]->landloc . ' " readonly ></div> ');
      echo ('<div><b>Take off flight location  </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="delay" name="takeoffloc" value="'. $flight[0]->takeoffloc . ' "  readonly></div> ');
      echo ('<div><b>Delay time in flight  </b><input type="text" id="delay" style=" background-color: rgba(255,255,255, 0.3); width:20%" name="delay" value="'. $flight[0]->delay . ' " readonly ></div> ');
      echo ('<div><b>Duratio time of flight: </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="durationtime" name="durationtime" value="'. $flight[0]->durationtime . ' " readonly ></div> ');
      echo ('<div><b>Flight number  </b><input type="text" style=" background-color: rgba(255,255,255, 0.3); width:20%" id="flightnum" name="flightnum" value="'. $flight[0]->flightnum . ' " readonly ></div> ');
      echo("</fieldset> <br /><br />");
      ///////////////////////////////////////////////////////////////////



    //////////////////////////////////////// progress bar///////////////////////////////////


  


    echo ('<div class="paginate 2" > <div   >'); // paging page
                 // get the answer to the survey 
                for ($index = 0; $index < sizeof($users); $index++) 
                {
                  
                if($index == 0) //title of  part 2 of survey 
                {
                    echo('<input style=" background-color: gold; width:95%; font-size:25px;" type="text"  value="Part 2 - " readonly><br />');

                }
                if($index == 5)// title of part 3 of survey 
                {
                    echo('<input style=" background-color: gold; width:95%; font-size:25px;" type="text"  value="Part 3 -  " readonly><br />');
                   
                }
              
                
                    echo("<br />");

                      if($state == "finish")  //readonly state - finish status of user
                        {
                        
                            // echo ('  <div  id=' . ($index + 1) . '>  <br />');
                            // echo('<input style=" background-color: palegreen; width:80%" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly> <br />');
                            // ECHO('<input style=" background-color: white; width:60%" type="text" id="answer'.($index + 1).'" name="answer'.($index + 1).'" value='. $users[$index]->answer . ' " readonly>
                            // </div> ');
                            echo('<input style="background: linear-gradient(#FF8489 , #7F53AC); width:80%; font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][4]) . ' " readonly><br />');

                                        ///////////////////////CHECKBOX//////////////////////////////////////////////////////
                                        if( $_SESSION['question'.($index+1)][1] =="checkbox" ) //type of question checkbox
                                        {
                                           // list of checkbox  list from user input database
                                            $answerlist = explode(',', $users[$index]->answer);

                                            echo("<div id=' . ($index + 1) . ' > ");
                                            
                                            echo('<input style=" background-color: palegreen;font-size: 22px; width:80%;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            
                                                
                                                    for ($x = 0; $x < count($_SESSION['question'.($index+1)][2]); $x++) 
                                                    {
                                             
                                              
                                                if(in_array(($_SESSION['question'.($index+1)][2][$x]) ,  $answerlist ))
                                                {
                                                  
                                                echo('<input disabled readonly checked type="checkbox" class="form-check-input" name="answercheck'.($index+1).'[]" value="'.  $_SESSION['question'.($index+1)][2][$x] .'"
                                                <label  for="'. $_SESSION['question'.($index+1)][2][$x].'"> <a style="color:blue;font-size: 23px; ">' .$_SESSION['question'.($index+1)][2][$x].'</a></label><br />');
                                              
                                                }
                                                else
                                                { 
                                                    echo('<input disabled readonly type="checkbox" class="form-check-input" name="answercheck'.($index+1).'[]" value="'.  $_SESSION['question'.($index+1)][2][$x] .'"
                                                    <label  for="'.$_SESSION['question'.($index+1)][2][$x].'"><a style="color:blue;font-size: 23px; ">'.$_SESSION['question'.($index+1)][2][$x].'</a></label><br>');
                                                   
                                                }
                                                
                                            
                                            }
                                            echo("</div>");
                                        
                                           
                                        }
                                        else
                                        {
                                           
                                            ///////////////////////RADIO BUTTON//////////////////////////////////////////////////////

                                        if( $_SESSION['question'.($index+1)][1] =="radiobutton" ) //type of question radio
                                        {
                                       
                                            echo("<div id=' . ($index + 1) . '>");
                                            echo('<input style=" background-color: palegreen; font-size: 22px; width:80%; " type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            for ($x = 0; $x < count($_SESSION['question'.($index+1)][2]); $x++) 
                                            {
                                               
                                            
                                                if(strcasecmp( trim($_SESSION['question'.($index+1)][2][$x]),  trim($users[$index]->answer)) == 0 )
                                                {
                                                    
                                                echo('<input checked disabled readonly   type="radio" class="form-check-input" name="answer'.($index + 1).'"  value="'.  $_SESSION['question'.($index+1)][2][$x] .'">
                                                <label  style=" font-size: 23px; color:blue; " for="'. $_SESSION['question'.($index+1)][2][$x].'">' .$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                                
                                            }
                                                else
                                                {
                                                    
                                                   
                                                    echo('<input type="radio" class="form-check-input" disabled readonly name="answer'.($index + 1).'"  value="'. $users[$index]->answer . '">
                                                    <label for="'.$_SESSION['question'.($index+1)][2][$x].'">'.$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                                    
                                                }
                                            }
                                            echo("</div>");
                                          
                                        }
                                        }




                                    }
                           
                            
                            
                        

                        else
                            {
                              
                                echo('<input style=" background-image: linear-gradient(#FF8489 , #7F53AC); width:80%; font-size:25px;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][4]) . ' " readonly><br />');

                                if(($users[$index]->answer)!="") // answer is answered by user 
                                    {
                                  ///////////////////////RADIO BUTTON//////////////////////////////////////////////////////

                                        if( $_SESSION['question'.($index+1)][1] =="radiobutton" ) //type of question radio
                                        {
                                       
                                            echo("<div id=' . ($index + 1) . '>");
                                            echo('<input style="   background: linear-gradient(lightgray , #7F53AC); width:80%;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            for ($x = 0; $x < count($_SESSION['question'.($index+1)][2]); $x++) 
                                            {
                                               
                                                if(strcasecmp( trim($_SESSION['question'.($index+1)][2][$x]),  trim($users[$index]->answer)) == 0 )
                                                {
                                                
                                                echo('<input checked type="radio" class="form-check-input"  name="answer'.($index + 1).'" value="'. $_SESSION['question'.($index+1)][2][$x] . '">');
                                                echo(' <label style=" font-size: 23px; color:blue; " for="'.$_SESSION['question'.($index+1)][2][$x].'">'.$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                            

                                                 }
                                                else
                                                {
                                                  
                                                   
                                                    echo('<input type="radio" class="form-check-input" name="answer'.($index + 1).'"  value="'. $_SESSION['question'.($index+1)][2][$x] . '">');
                                                    echo(' <label for="'.$_SESSION['question'.($index+1)][2][$x].'">'.$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                                    
                                                }
                                            }

                                            echo("</div>");
                                          
                                        }

                                        ///////////////////////CHECKBOX BUTTON//////////////////////////////////////////////////////
                                        if( $_SESSION['question'.($index+1)][1] =="checkbox" ) //type of question checkbox
                                        {
                                            
                                           // list of checkbox  list from user input database
                                            $answerlist = explode(',', $users[$index]->answer);
                                            echo("<div id=' . ($index + 1) . '>");
                                            echo('<input style="   background: linear-gradient(lightgray , #7F53AC); width:80%" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            
                                                
                                                    for ($x = 0; $x < count($_SESSION['question'.($index+1)][2]); $x++) 
                                                    {
                                             
                                              
                                                if(in_array(($_SESSION['question'.($index+1)][2][$x]) ,  $answerlist ))
                                                {
                                                  
                                                echo('<input checked type="checkbox" class="form-check-input" name="answercheck'.($index+1).'[]" value="'.  $_SESSION['question'.($index+1)][2][$x] .'"
                                                <label   for="'. $_SESSION['question'.($index+1)][2][$x].'">' .$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                              
                                                }
                                                else
                                                { 
                                                    echo('<input type="checkbox" class="form-check-input" name="answercheck'.($index+1).'[]" value="'.  $_SESSION['question'.($index+1)][2][$x] .'"
                                                    <label for="'.$_SESSION['question'.($index+1)][2][$x].'">'.$_SESSION['question'.($index+1)][2][$x].'</label><br>');
                                                   
                                                }
                                                
                                            
                                                     }
                                            echo("</div>");
                                        
                                           
                                        }




                                    }
                                
                                else
                                { 
                                    // not answered question by user 
                                
                                   /////////////////////RADIO //////////////////////////////////////////////
                                    if( $_SESSION['question'.($index+1)][1] =="radiobutton")
                                        {
                                            echo("<div id=' . ($index + 1) . '>");
                                            echo('<input style="   background: linear-gradient(lightgray , #7F53AC); width:80%;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            foreach ($_SESSION['question'.($index+1)][2] as $value)
                                            {  
                                        echo('<input  type="radio" class="form-check-input" id="answer'.($index + 1).'" name="answer'.($index + 1).'"  value="'.$value.' ">
                                        <label for="'.$value.'">'.$value.'</label><br>');
                                            }
                                            echo("</div>");
                                        }
                                   /////////////////////CHECK  BOX  //////////////////////////////////////////////

                                        if( $_SESSION['question'.($index+1)][1] =="checkbox")
                                        {
                                            echo("<div id=' . ($index + 1) . '>");
                                            echo('<input style="   background: linear-gradient(lightgray , #7F53AC); width:80%;" type="text" id="title'.($index + 1).'" name="title'.($index + 1).'" value="'.  ( $_SESSION['question'.($index+1)][3]) . ' " readonly><br />');
                                            foreach ($_SESSION['question'.($index+1)][2] as $value)
                                            {
                                                echo('<input type="checkbox" class="form-check-input" name="answercheck'.($index+1).'[]" value="'.$value .'"
                                                <label for="'.$value.'">'.$value.'</label><br>');
                                            }
                                            echo("</div>");
                                        }
                                }
                                echo(" <br />");
                }
                }
               echo (' </div> 
               <div class="pager">  <?php  /// paging /////// ?>
             <button class="previousPage" type="button" style="width:30%;  background-color: red; " >previous Page </button>
               <button type="button"  class="nextPage" style="width:30% ; background-color: blue; " >next page  </button>
                 </div> <br /><br />   ');
                                         
            if($state!="finish")
            {
                echo('
                <hr><button type="submit" style="width: 50%;font-size:25px"  class="btn btn-warning">Save Survey</button>
                </form> </div>');
            }
               
            } 
            
            else {
                echo 'there is no answer to any question of the survey <br />
                 please go to survey page
                 <a href="../includes/survey.php">survey page </a>        
                
                 ';
            }
            ?>
     


  



<?php

//submit button 
//update the survey data of user 
if (!empty($_POST))
{   

    $compname= $_POST["compname"];
	$classtype = $_POST["classtype"];
	$landloc = $_POST["landloc"];
	$takeoffloc= $_POST["takeoffloc"];
	$delay = $_POST["delay"];
	$durationtime= $_POST["durationtime"];
	$flightnum= $_POST["flightnum"];


    // //update flight detail of survey 
    $flight = new Flight();
    $flight->updateflight($compname, $classtype ,$landloc ,$takeoffloc, $delay , $durationtime, $flightnum); // update flight details



    $username = $_SESSION['user_name']; // get from session not from survey
	$answer="";
	$questionid="";
    $checkiflabelempty = 0; // counter check if one the label is empty
   // for loop on numer of question 
   // fill the database with answers for two tables - answerquestion/threetablejoin
    for ($index = 1; $index <= 10; $index++) 
	{
        $checkiflabelempty1 = true;
        $checkiflabelempty2 = true;
        $answer ="";
        if(isset( $_POST[strval("answer".$index)])) // get radio button value
        {
		$answer = $_POST[strval("answer".$index)];
        $checkiflabelempty = $checkiflabelempty+1;
        }
	  

		if(isset($_POST['answercheck'.$index])) //get check button value
		{
			$items = $_POST['answercheck'.$index];
			$arrayanswer ="";
			foreach ($items as $value){
			$arrayanswer  = $arrayanswer.",".$value;
			}
			$answer = $arrayanswer;
            $checkiflabelempty = $checkiflabelempty+1;
           
		} 
     
       
		// insert the survey to three database 
		$questionid = $index;
		$threetablejoin->updatesurveythreetable($_SESSION['user_name'] , $answer,$questionid , $_SESSION["FLIGHTNUM"]);
		
	}

	// update status of user 
	 $userdetail = new User();
     if($checkiflabelempty == $_SESSION['numberofquestion'] ) //counter check equal to number of question
		{
				$userdetail->updatestatusbyusername($username ,"finish"); // update status to finish
                
		}
		else
		{
				$userdetail->updatestatusbyusername($username ,"inproccess");// update status to inprocess
		}
       


// finish to fill the survey 
// header('Location: ../profile/surveyprofile.php');
// exit;
echo("<script>window.location.replace('../profile/surveyprofile.php'); </script>");

}

?>

</form>
    </div>




  



<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 
</body>
</html>