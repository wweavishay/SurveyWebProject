<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body >

<?php
   require_once('../includes/init.php');
   include('../includes/header.php');
  
   if (!$session->signed_in){
       header('Location: ../login/login.php');
       exit;
   }

   $user_id=$session->user_id;
   $user=new User();
   $user->find_user_by_id($user_id);
   // echo '<h1>Hello '.$user->username.'</h1><br>';
    

 
 ?>

        
<div style="text-align:center; height: 200px;">

<div class="alert alert-primary" role="alert" style=" height: 400px;font-size:larger">
<br /> <br /> <br /> <br /> 

<?php
$status="";
if(isset($_SESSION['user_name']))
{
$userdetails = User::find_user_by_username($_SESSION['user_name']);
if (isset($userdetails)){
	$status  = $userdetails[0]->status ;
   }
}

?>

<?php 
if($status =="start") 
{ 
    echo('<h4> Welcome to our survey !! </h4> ');
}
if($status =="inproccess") 
{
    echo('<h4> Thanks for filling our survey !! <br /> We remember that you have to fill more details </h4> ');
}
if($status =="finish") 
{
    echo('<h4> Thanks for filling our survey !! </h4> ');
}

?>

We appreciate your opinion and would love to hear your thoughts on our products and services. <br />
 The survey should only take a few minutes to complete, and your feedback will help us to improve and better serve our customers. <br />
  Thank you for taking the time to participate in our survey. <br />
 Your input is greatly appreciated !!😊 😊 😊



</div></div>






<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />  <br /> <br /> <br />  <br /> <br /> <br /> 
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

    </body>
</html>





		

    
