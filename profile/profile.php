
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		

</head>
<body>



<?php 
    require_once('../includes/init.php');
    include('../includes/header.php');



    if (!$session->signed_in){
        header('Location: ../login/login.php');
        exit;
    }


?>


<script>
            function log_out(){
                if (confirm("Are you sure to log out ?")) {
                    window.location='../logout.php';
                } 
                
            }
        </script>



<div style="text-align:center">
<div class="alert alert-primary" >

<form action="" method="GET">
<h1><img src="../images/updateuser1.png" width="80px" height="80px">My details </h1>
<?php
    
    require_once('../includes/init.php');


  
   

        if (!$database->get_connection())
        {
           
            die("Connection fails <br>");
        }
      
        if (!$session->signed_in) 
        {
       header('Location: ../index.php');
        }
        else
        {
        $iduser =  $_SESSION['user_id'];   
      //  echo($iduser);
       $users = User::find_user_by_username($iduser);
       if (isset($users)){
       echo('

       <table style="margin:auto;">
       <tr>
       <td>  <label for="username"><b> User name</b></label> </td>
       <td> <input type="text" placeholder="Enter username" readonly disabled name="username" id="username" value='.$users[0]->username.'  ></td>
      </tr>

      <tr>  
      <td> <label for="email"><b> Email</b></label></td>
      <td>  <input type="text" placeholder="Enter Email" readonly disabled name="email" id="email"  value='.$users[0]->email.'></td>
     </tr>
      <tr> 
        <td> <label for="residence"><b> Residence</b></label></td>
        <td> <input type="text" placeholder="Enter residence" readonly disabled name="residence" id="residence"  value='.$users[0]->residence.'>   </td>
      </tr>
     
      <tr>  
      <td>  <label for="birtdhday"><b> Birtdhday</b></label></td>
      <td> <input type="text" readonly placeholder="Enter birtdhday" readonly disabled name="birtdhday" id="birtdhday" value='.$users[0]->birtdhday.'></td>
    </tr>
    
   



');
       }
       
       
        else
        {
            echo 'Can not select users.  Error is:'.$database->get_connection()->error;
        }
    }


    if (!empty($_GET))
    {
        $username = $_GET["username"]; 
        $password =$_GET["password"];
        $birtdhday =$_GET["birtdhday"]; 
        $residence =$_GET["residence"]; 
        $email =$_GET["email"]; 
        

       $user = new User();
       $user->updatebyusername($username,$birtdhday,$residence , $email);
       if(!$user)
            {
                echo '<script>alert("There is a problem")</script>';
            }
       else
            {
                echo '<script>alert("success to update")</script>';
                echo "
                <script>
                window.location.replace('../profile/profile.php');
                </script>";
            }
    }








    ?>


   <tr>  
      <td> </td>
    
    </tr>
</table> 
<img src="../images/updatedetailss.png" align="left"  width="350" height="200">
</form>



</div>
</div>
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

</body>
</html>