<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
        function login(){
            var request=new XMLHttpRequest();

            request.onreadystatechange=function(){
               if (request.readyState==4 & request.status==200)
                {
                    var myObj = JSON.parse(request.responseText);
                    if (myObj.code==1){
                        document.getElementById("info").innerHTML=myObj.message;
                        var response = confirm( "Sucess register , Do you want to pass to login page? ");
                        if (response) {
                          window.location.href = '../login/login.php'; 
                                              }
                    }
                    else{
                       document.getElementById("info").innerHTML= "<div class='alert alert-danger' role='alert'><h5 style='color:red' >"+myObj.message + "</h5> </div>"; 
                       //alert(myObj.message);
                      }
                }

            }
          

            request.open("POST",'../login/registerajax.php',true);
            request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            var data= JSON.stringify({
            name: document.getElementById("username").value,
            password:document.getElementById("password").value , 
            gender: document.getElementById("gender").value , 
            email:document.getElementById("email").value , 
            residence:document.getElementById("residence").value , 
            birtdhday:document.getElementById("birtdhday").value , 
        
        
        });

            request.send(data);
        }
    </script>
</head>
<body>

<?php
  require_once('../includes/init.php');
  include('../includes/header.php');


  if(isset($_SESSION['user_name'] )){ // VAL ERROR - if after user is login want to enter this page - 
    echo "<script>window.location.replace('../login/logout.php');</script>"; // redirect 

}




  $error='';
  $username = "" ;
  $password =""; 
  $gender ="";
  $birtdhday ="";
  $residence ="";
  $email ="";
  $status="";

  if (!empty($_GET))  // save the data in the input not refresh the page
 {
    // register redirect 
      $username = $_GET["username"]; 
      $password =$_GET["password"]; 
      $gender =$_GET["gender"]; 
      $birtdhday =$_GET["birtdhday"]; 
      $residence =$_GET["residence"]; 
      $email =$_GET["email"]; 
      $status="start";

      $user1=User::getmaxid(); // max order number 
        if (isset($user1)){
            for($i=0;$i<sizeof($user1);$i++){
               $id = $user1[0]->id;
            }
         }
         $user=new User();
         $error=$user->fetch_userbyusername( $username);

       // check if username is exist 
       if($error)  
       {

          
            // $uservalidation1 = new userValidation($username,$password,$gender, $residence, $birtdhday, $email); //validation
            // $chackvalidity = $uservalidation1->checkall();
           // $chackvalidity = trim($chackvalidity) // delete spaces

           
            $user->add_user($id,$username,md5($password),$gender,$birtdhday,$residence,$email);
            header('Location: ../login/login.php');
            exit;
           
          
           
       }
       else // usernmae is exist - problem 
       {
        $error='<B> ERROR </B> -  User is exist  please replace it ';

       }
       
 }

 
?>

 <div class="container">

 <div id="info"></div>

<form>
<img src="../images/register.png"  width="500" height="300">
  <div class="container">
    <h1>Register</h1>
    <hr>
    <table style="margin:auto;">
            <tr>
            <td> <h4> <label for="username"><b> User name</b></label></h4> </td>
            <td> <input type="text" placeholder="Enter username" name="username" id="username"  ></td>
           </tr>
   
           <tr>  
           <td> <h4><label for="email"><b> Email</b></label> </h4></td>
           <td>  <input type="text" placeholder="Enter Email" name="email" id="email" ></td>
          </tr>
           <tr>
              <td><h4> <label for="psw"><b> Password</b></label> </h4></td>
              <td><input type="password" placeholder="Enter Password" name="password" id="password" >   </td>
           </tr>
   
           <tr> 
             <td> <h4><label for="residence"><b> Residence</b></label> </h4></td>
             <td> 
             <select  class="form-select"  style="width:100%; margin:auto;background-color:lightblue;" name="residence" id="residence">
                   <option value="Israel">Israel</option>
                   <option value="Thialand">Thialand</option>
                   <option value="USA">USA</option>
                   <option value="JAPAN">JAPAN</option>
                   <option value="FRANCE">FRANCE</option>
                   <option value="CANDA">CANDA</option>
                   <option value="PERU">PERU</option>
                   <option value="Italy"> Italy</option>
                   <option value="Vietnam">Vietnam</option>
                   <option value="Australia">Australia</option>
                   <option value="Russia">Russia</option>
                   </select>
           </td>
           </tr>
           <tr>
           <td><h4><label for="Gender"><b> Gender </b></label> </h4></td>
             <td>
                <select id="gender"">  
                    <option value=""></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
               </select>
            </td>
         </tr>
           <tr>  
           <td> <h4> <label for="birtdhday"><b> Birtdhday</b></label> </h4> </td>
           <td> <input type="date" placeholder="Enter birtdhday" name="birtdhday" id="birtdhday" value="<?php echo htmlspecialchars(date("Y-m-d")); ?>"  ></td>
         </tr>
     </table>
     <br />  <br />  <br />  <br />
            <p><input id="submit" class="btn btn-primary btn-lg btn-block" type="button" value="Login" onclick='login()'></p>
            <div class="container signin">
                <h6><b>Already have an account? <a href="../includes/index.php">Sign in</a>. </b></h6>
              </div> 
    </form>
   


 </div></div>

 
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

</body>
</html>

