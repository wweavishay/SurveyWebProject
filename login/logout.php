
<html>


<body>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php
  require_once('../includes/init.php');
  include('../includes/header.php');

  global $session;
  


  unset($_SESSION['user_name']);
  unset($_SESSION['user_id']);
  unset($_SESSION['validationasnwerall']);
  unset($_SESSION['answer']);
  unset($_SESSION["compname"]); // company name of flight
  unset( $_SESSION["flightnum"]); // unique flight number 
  unset( $_SESSION["takeoffloc"]); // take off place 
  unset($_SESSION["landloc"]);  // land place 
  unset( $_SESSION["classtype"] ); // class type - first second business
  unset($_SESSION["delay"] ); // delay time 
  unset($_SESSION["durationtime"]); // duration time of flight

  session_destroy();
  $session->logout();
    header('Location: ../login/login.php');

?>


