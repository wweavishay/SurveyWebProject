


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
	<body >

    <?php 

	require_once('init.php');
	include('header.php');




     $error = '';

   if( isset($_SESSION["errorvalidation"]))
   {
	$error =$_SESSION["errorvalidation"];
	$_SESSION["errorvalidation"] = "";
   }


     if(!isset($_SESSION['user_name'])) // redirect if user is not connect
	 {
		   header('Location: ../includes/index.php');
		   exit;
	 }
	  
		// LOAD PAGE   
		// status of user - start , inproceess , finish 
		$userdetails = User::find_user_by_username($_SESSION['user_name']);
		if (isset($userdetails)){
			$status  = $userdetails[0]->status ; // get status of user 
		}

		if($status=="finish" || $status=="inproccess" )
		{ 
			echo "<script>window.location.replace('../profile/surveyprofile.php');</script>"; // redirect 
		}


          /// session  - save the answers  - 
		$companyName=""; // company name of flight
		$IATACode=""; // unique flight number 
		$flightDepartment=""; // take off place 
		$arival="";  // land place 
		$classtype ="" ; // class type - first second business
		$delay ="" ; // delay time 
		$durationtime=""; 

		 if(isset($_SESSION["compname"]) && isset($_SESSION["flightnum"])) 
		 {
			$companyName= $_SESSION["compname"]; // company name of flight
			$IATACode= $_SESSION["flightnum"]; // unique flight number 
			$flightDepartment= $_SESSION["takeoffloc"]; // take off place 
			$arival=$_SESSION["landloc"];  // land place 
			$classtype = $_SESSION["classtype"] ; // class type - first second business
			$delay =$_SESSION["delay"] ; // delay time 
			$durationtime=$_SESSION["durationtime"]; // duration time of flight
		
		 }





	        $threetablejoin =  new Threetablejoin();
			$errorflightisntexist = $threetablejoin->find_flight_by_username($_SESSION['user_name']); // check if flight is exist to specific user
			if($errorflightisntexist)
			{
	 ?>

           
   
		<form action="../includes/survey2.php" method="GET" style="text-align:center; margin:auto">
		
		
		
		<div class="progress">
		<div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
		</div>
		<br /><br /> 
		
		<h1 style="background-color:orange; width:100% ; text-align: left; "> Part 1 - Flight details </h1>	
		<br /> <br /> <br /> 
		
		<div class="alert alert-danger" >
        <strong> <?php echo $error  // SHOW ERROR MESSAGE // ?></strong> </div>


			 <b> what is your  company name flight ?</b>
			   
			    <select  class="form-select"  style="width:50%; margin:auto;background-color:lavender;" name="compname" id="compname" >
				<option value="<?php echo($companyName) ?>"><?php echo($companyName) ?></option>
				<option value="El al">El al</option>
				<option value="American Airlines">American Airlines</option>
				<option value="Emirates Airline">Emirates Airline</option>
				<option value="Alitalia">Alitalia</option>
				<option value="Jet Airways">Jet Airways</option>
				<option value="Air France">Air France</option>
				<option value="Lufthansa">Lufthansa</option>

				</select><br / ><br / >


				<b>	what was your class type of flight ?</b>
				 <select  class="form-select"  style="width:50%; margin:auto;background-color:lavender;" name="classtype" id="classtype">
				 <option value="<?php echo($classtype) ?>"><?php echo($classtype) ?></option>
				<option value="First class">First class</option>
				<option value="Second class">Second class</option>
				<option value="Buisness class">Buisness class</option>
				</select><br / ><br / >

			
				<b>what was your landed location?(flight arival location) </b>
				<select  class="form-select"  style="width:50%; margin:auto;background-color:lavender;" name="landloc" id="landloc">
				<option value="<?php echo($arival) ?>"><?php echo($arival) ?></option>
				<option value="Paris,France">Paris,France</option>
				<option value="Rome,Italy">Rome,Italy</option>
				<option value="Tel aviv,Israel">Tel aviv,Israel</option>
				<option value="Cusco,Peru">Cusco,Peru</option>
				<option value="London,Uk">London,Uk</option>
				<option value="Bankok,Thailand">Bankok,Thailand</option>
				</select><br / ><br / >


				<b>what was your take off location? (flight Department location)</b>

				<select  class="form-select"  style="width:50%; margin:auto;background-color:lavender;" name="takeoffloc" id="takeoffloc">
				<option value="<?php echo($flightDepartment) ?>"> <?php echo($flightDepartment) ?></option>
				<option value="Paris,France">Paris,France</option>
				<option value="Rome,Italy">Rome,Italy</option>
				<option value="Tel aviv,Israel">Tel aviv,Israel</option>
				<option value="Cusco,Peru">Cusco,Peru</option>
				<option value="London,Uk">London,Uk</option>
				<option value="Bankok,Thailand">Bankok,Thailand</option>
				</select><br / ><br / >




				<b>	How long was the delay (in hours) ?  </b> <br />
				<input type="text" name="delay" value="<?php echo($delay) ?>" style="width:50%"/><br / ><br /> 
				<b>How long was the durationtime(in hours) ? </b>
				<br /><input type="text" name="durationtime" value="<?php echo($durationtime) ?>"  style="width:50%" /><br / ><br /> 
				<b>what was your flight number(IATA) ? </b> 
				<br /> <input type="text" name="flightnum" value="<?php echo($IATACode) ?>" style="width:50%"/><br / ><br /> 
			<p><input type="submit" value="submit" name="submit"   class="btn btn-warning" style="width:20%;height:80px"></p>
		   </form>
			




<?php } 
else
{
	header('Location: ../includes/survey2.php');
	exit;

}
?>
	</body>
</html>
















<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer-->


