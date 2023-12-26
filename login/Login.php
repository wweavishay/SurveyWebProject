
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>




<?php
    require_once('../includes/init.php');
    include('../includes/header.php');

    if(isset($_SESSION['user_name'] )){ // VAL ERROR - if after user is login want to enter this page - 
     
        echo "<script>window.location.replace('../login/logout.php');</script>"; // redirect 
       
    }


  // login redirect 
    global $session;
    $error='';
    if(isset($_POST['submit'])){ // get username and password by post method
        if (!$_POST['name']){
            $error='User is required';
        }
        else if(!$_POST['password']){
            $error='Password is required';
        }
        else{
            
            $name=$_POST['name'];
            $password=$_POST['password'];
            $user=new User();
            $error=$user->find_user_by_name($name,$password);
           


            if (!$error){ //  username is exist - correct
                $session->login($user);
                $_SESSION['user_name'] = $name; // fill session
                $_SESSION['user_id'] =  $name;
             

              
        ///////////////QUESTION session///////////////////////////////
      
        $_SESSION['numberofquestion'] = 10; // filled question with data 
        $question1 =new Question(1,"radiobutton" ,array("1","2","3","4","5"), "1.Rate your level of satisfaction with the in-flight meal","Food Question"); //question 1
        $question2 =new Question(2,"radiobutton" ,array("1","2","3","4","5"), "2.Rate your level of satisfaction with drinking on the flight" , "Food Question");//question 2
        $question3 =new Question(3,"radiobutton" ,array("1","2","3","4","5"), "3.Rate your level of satisfaction with the in-flight entertainment system" , "Entertiment Question");//question 3
        $question4 =new Question(4,"radiobutton" ,array("1","2","3","4","5"), "4.Rate your level of satisfaction with the seat on the flight:","Seats Question");
        $question5 =new Question(5,"radiobutton" ,array("1","2","3","4","5"), "5.Rate your level of satisfaction with the level of cleanliness on the plane","Clean Question");
        $question6 =new Question(6,"radiobutton" ,array("1","2","3","4","5"), "6.Rate your level of satisfaction with the service of the flight attendants" , "Service Question");
        $question7 =new Question(7,"radiobutton" ,array("1","2","3","4","5"), "7.On a scale of 1-10, how much would you recommend a friend to travel with this company?","Recommand Question");
        $question8 =new Question(8,"radiobutton" ,array("1","2","3","4","5"), "8.On a scale of 1-10, how satisfied were you with the entire travel process?","Recommand Question");
        $question9 =new Question(9,"checkbox" ,array("Tv","Newspaper","Friends","Media","None"), "9.What media source did you come to the survey?","Information Question");//question 9
        $question10 =new Question(10,"checkbox",array("food","service","cleaning" ,"none"), "10.What is the reason why you will return to this company again?","Recommand Question");//question 10



              
         //////////////////////////////////////////////////////////////////////////////

                header('Location: ../includes/index.php');
                 exit;
            }
           
    
        }
    }



  
    
?>


<body>

    <div class="container"style=" float:center;">
    <form  method="post" >

    <div class="alert alert-danger" >
        <strong> <?php echo $error  // SHOW ERROR MESSAGE // ?></strong> </div>
        
        <img src="../images/login.png"  width="500" height="300">
        <table style="margin:auto;">
         <tr>
         <td style="text-align:center" > <h4> <b> User Name: </b> </h4></td>
         <td> <input type="text" name="name"></td>  
         </tr>  
         <tr>
         <td style="text-align:center"> <h4> <b> Password: </b> </h4> </td>
         <td> <input type="password" name="password"></td>  
         </tr>
        
          <tr>
            <td> </td><td>
            <input type="submit" value="submit" name="submit" class="btn btn-primary btn-lg btn-block" width="100%">
            </td>
        </tr>
       
        <tr>
        <td> </td><td>
                <br /> 
            <h6>If you need to register click here <a href="../login/register.php">register in</a>.</h6>
            </td>
        </tr>
       
        </table>
     
    
</div> 
</form>




<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

</body>
</html>

