

<?php 
include('../includes/header.php');
include('../includes/init.php');

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/flightcard.css" />
</head>

<body>
<?PHP
require_once("../includes/init.php");


if (!$session->signed_in){ // user is not connected
  header('Location: ../login/login.php');
  exit;
}



$searches = [];
if (isset($_COOKIE['searches'. $_SESSION['user_name']])) {
  $searches = json_decode($_COOKIE['searches'.$_SESSION['user_name']], true);
}

if($_GET)
{
  if(isset($_GET["savecookies"]))
  {
// Add the current search to the beginning of the array
array_unshift($searches, $_GET['flight']);
  }

if(!empty( $_GET['flight']))
{
// Keep only the three most recent searches
$searches = array_slice($searches, 0, 5);


// Save the searches back to the cookie
setcookie('searches'. $_SESSION['user_name'], json_encode($searches), time()+36000);

// Display the searches
$lastfivesearch="<b><h3> Last recent search history : </h3></b> ";
$index = 1; 
foreach ($searches as $search) {
  $lastfivesearch = $lastfivesearch . '<br>'.$index .". ". ($search) ;
  $index = $index+1;
}

echo("<div class='alert alert-success' style=' width: 60%; margin:auto'>");
echo($lastfivesearch);
echo("</div><br /> ");
}
}?>


<div class="container">

<form method="GET" action="">
  <div style="text-align:center">

    <h2> <b> Enter a flight  / company flight / city </b> </h2>
    <p>E.g :  company flight (el al , air france ) , city (london ,paris) ,flight (LY , AA) </p>
    <p><input type="text" name="flight"  value="" onkeyup="showHint(this.value)"> </p>


        <!-- ajax  -->
        <div  style="background-color: lightgreen; font-size:larger; height:20%;"> 
        <p> <b> <span id="txtsoultion"> </b> </span></p>
        </div>
        <!-- ajax  -->




    <p>choose max number of displays of flights
    <select name="solutionnumber" id="solutionnumber">
    <?php for ($i = 15; $i >= 1; $i--) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
    </select>

   


    <p><input type="submit" name="Submit1" class="btn btn-warning" value="submit"></p>
    </div>
 <div style="text-align:left">
    <input type="checkbox" id="savecookies" name="savecookies" value="savecookies" checked>
<label for="savecookies"><b> Check for Save your results (in Cookies) </b></label><br>
 </div>
</div></div>
</form>
<br />





<?php

require_once('../includes/init.php');
 //https://data.gov.il/api/3/action/datastore_search?resource_id=e83f763b-b7d7-479e-b172-ae981ddc6de5&limit=5

    $searchstring ="";
    $flightArrray ="";
    $flight="";
    $error = true;
    


    if ($_GET)
    { 

   
        $error = false;
        $searchstring = $_GET["flight"];
        if(!empty(  $searchstring))
        {

        
        $limitmax = $_GET["solutionnumber"];
        $urlContents="https://data.gov.il/api/3/action/datastore_search?resource_id=e83f763b-b7d7-479e-b172-ae981ddc6de5&limit=".$limitmax."&q=".urlencode($searchstring);
        $data = file_get_contents($urlContents);
	    	$flightArrray = json_decode($data, true);
       // print_r($flightArrray);

       if(count($flightArrray["result"]["records"]) >0 )
       {
                  for ($i = 0; $i < count($flightArrray["result"]["records"]); $i++) 
                  {
                  
                  $companyname = ($flightArrray["result"]["records"][$i]["CHOPERD"]); // company air name
                  $landedplace =($flightArrray["result"]["records"][$i]["CHLOC1T"]); // land place 
                  $date =($flightArrray["result"]["records"][$i]["CHSTOL"]); // date
                  $iata =($flightArrray["result"]["records"][$i]["CHOPER"]); // iata
                  $status = ($flightArrray["result"]["records"][$i]["CHRMINE"]); // status
                  $country = ($flightArrray["result"]["records"][$i]["CHLOCCT"]); // country 
                  $numebrofflight = ($flightArrray["result"]["records"][$i]["CHFLTN"]); // country 
                  
              
                  echo('
                  <div class="l-col-right ticket-wrap" >
                  <div class="ticket" aria-hidden="true">
                    <div class="ticket__header">
                      <div class="ticket__co">
                      <p class="ticket__route">Flight detail</p> 
                        <img src="../images/PASSPORT.png" width="250px" height="220px" style="  position: relative;right:50px ; position:center;"> 
                      </div>
                    </div>
                    <div class="ticket__body">
                      <p class="ticket__route">'.$companyname.'</p>
                      <div class="ticket__timing">
                        <p>
                          <span class="u-upper ticket__small-label">Date</span>
                          <span class="ticket__detail">'.$date.'</span>
                        </p>
                        <p>
                          <span class="u-upper ticket__small-label">Status</span>
                          <span class="ticket__detail">'.$status.'</span>
                        </p>
                        <p>
                          <span class="u-upper ticket__small-label">IATA</span>
                          <span class="ticket__detail">'.$iata." ".$numebrofflight.'</span>
                        </p>
                      </div>
                      <br />
                      <img src="../images/flight.png"   width="60px" height="50px" style="float: right;"> 
                      <p class="u-upper ticket__small-label">'.$landedplace."<br /> <br />".$country.'</p>
                      <img class="ticket__barcode" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/515428/barcode.png" alt="Fake barcode" />
                    </div>
                    <div class="ticket__header">
                      </div>
                  </div>
                </div> </div> 
                <br />     ');
                  }
          
          }
          else
            {
              echo('<div style="text-align: center;width:60%;margin: auto; color: red;font-size:25px; background-color: pink;"> 
              <i class="fa fa-exclamation-circle" style="font-size: 36px;"></i>
              There is no soultion 
              </div>');
            //  echo '<script>alert("There is no solution , please search again")</script>';
            }
         
          
         
          }
        }
       
       
       

?>



</body>


<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

 
</html>







<script>
  // Ajax script 
function showHint(str) { // ajax 
  if (str.length == 0) {
    document.getElementById("txtsoultion").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { // 4: The request is complete | 200: The request was successful
        document.getElementById("txtsoultion").innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "../Ajax/searchajax.php?q="+str, true);
    xmlhttp.send();
  }
}
</script>


