
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/footer.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src='https://kitw.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


</head>
<body>
   
  
 <header>

<?php

require_once("../includes/init.php");


echo(' <div class"container" id="abc"> <div class="image">   	<p class="header"> ');


if (!$session->signed_in) //disconnect of the
{
  
 
    echo(' <nav > <div  style=" position: absolute;left: 80%;" >
    <button type="button" style="border-radius: 50px;
    background: rgb(2,0,36);background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(13,153,36,1) 0%, rgba(226,226,226,1) 0%, rgba(27,22,123,1) 0%, rgba(255,76,0,1) 100%);
    class="btn btn-danger">  ');
    echo("<h5> Hi guest</h5> ");
    echo('</button><img src="../images/guesticon.png" width="70px" height="70px"></i>');
    echo('</button></div>');
    echo('<ul>
  <li> <a   href="../includes/index.php"><i class="fa fa-home"></i>Home</a></li>
      </ul> </nav>


      <div style="background-color: rgba(255, 255, 255, 0.01);; width:100%; height: 520px;z-index: 1; 
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    " >
      
      <img src="../images/airportavatar.png"  width="55%" height="100%" style="z-index: -1;float: right; border-radius: 0; padding-right: 10%; "> 
  
   
      <b> <H1 style=" color:white;  position: absolute; left: 10%;  padding-top: 5% ;  font-size: 200%; text-align:center;  font-family: "Varela Round; ", sans-serif;">   
      WELCOME TO FLIGHT SURVEY WEBSITE <i class="fa fa-plane" aria-hidden="true"></i> </H1></b>
      </div> 
     
     



      ');
}

else  //user connect
{
    echo('  <nav> <div  style=" position: absolute;left: 80%;" >
    <button type="button" style="background: rgb(2,0,36); border-radius: 50px;
      data-toggle="dropdown" >             ');
    echo("<h5 > Hi ".$_SESSION['user_name']);
    echo('</h5></button><img src="../images/usericon.png" width="70px" height="70px"></i>');
    echo('</button>
    <button class="btn btn-danger" onclick="log_out()">log out </button> </a></li>

  
    <div class="dropdown-menu" >
    <ul>
   <li> <a href="../profile/profile.php" style="background-color:rgba(0, 0, 0, 0.5);">view/edit my profile</a></li>
   <li> <a href="../profile/surveyprofile.php" style="background-color:rgba(0, 0, 0, 0.5);" >view/edit my survey</a></li>
    </div> </div></ul>  ');

   
    echo('  <ul>


    <li><img src="../images/logo.png" width="80px" height="80px"> </li> 
    <li><a   href="../includes/index.php"><i class="fa fa-home"></i>Home</a></li>
    <li><a  href="../API/flight.php">api flights</a></li>');

      //status of user - start , inproceess , finish 
      $userdetails = User::find_user_by_username( $_SESSION['user_id']);
      if (isset($userdetails)){
          $status  = $userdetails[0]->status ;
      }

      if($status == "finish")  // finish state vible to see statistic 
      {
    echo('<li style="background:#ec50bb"><a  href="../statistic/statisticflight.php">view statistic flight</a></li>
      <li style="background:#ec50bb"><a  href="../statistic/statisticanswer.php">view statistic answer</a></li>
      <li style="background:#ec50bb"><a href="../statistic/statisticusers.php">view statistic users</a></li> ');
      }

      echo('<li style="background:#ec50f1"> <a   href="../profile/profile.php"> My profile</a></li>
      <li style="background:#ec50f1"><a  href="../includes/survey.php">My survey</a></li> </ul> 
    </nav>


   <div style="background-color: rgba(255, 255, 255, 0.01);; width:100%; height: 520px;z-index: 1; 
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    " >
      
      <img src="../images/airportavatar.png"  width="55%" height="90%" style="z-index: -1;float: right; border-radius: 0; padding-right: 20% "> 
  
   
      <b> <H1 style=" color:white;  position: absolute; left: 10%;  padding-top: 5% ;  font-size: 200%; text-align:center;  font-family: "Varela Round; ", sans-serif;">   
      WELCOME TO FLIGHT SURVEY WEBSITE <i class="fa fa-plane" aria-hidden="true"></i> </H1></b>
      </div> 
   

   
  


    ');          
    }

   

        ?>
        
        
      
</header>




<br /> <br /> 




</body>
</html>
<script>
            function log_out(){
                if (confirm("Are you sure to log out ?")) {
                    window.location='../login/logout.php';
                } 
                
            }
        </script>