<?php
    require_once('../includes/init.php');
    require_once("../validation/userValidation.php");
    require_once("../validation/validation.php");

    global $session;
    $info='';

    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

  
    $username = $urlaray['name'];
    $password = $urlaray['password'];
    $gender = $urlaray['gender'];
    $email = $urlaray['email'];
    $residence = $urlaray['residence'];
    $birtdhday = $urlaray['birtdhday'];


   $user1=User::getmaxid(); // max order number 
   if (isset($user1)){
       for($i=0;$i<sizeof($user1);$i++){
          $id = $user1[0]->id;
       }
    }
    $user=new User();
    $error=$user->fetch_userbyusername( $username);

    
    $uservalidation1 = new userValidation($username, $password,$gender, $residence, $birtdhday, $email);

  // check if username is exist 
  if($error)  // username and password is exist 
  {

        // validation //////////
       
       $errortext = $uservalidation1->checkall();
       if(strlen(trim($errortext))==0)
       {
        $user->add_user($id,$username,md5($password),$gender,$birtdhday,$residence,$email);
        $post_data = array('code'=>1,'message'=>"success to register" ); // suceess message 
       }
       else
       {
        $post_data = array('code'=>0,'message'=>$errortext ); // failed message 
       }
      

      
      
  }
  else // usernmae is exist - problem 
  {
  $post_data=array('code'=>0,'message'=>' Error  -   User Name is exist, please replace it ');// failed message 
  }
  

   $info = json_encode($post_data);
    echo $info;
    
 



?>


