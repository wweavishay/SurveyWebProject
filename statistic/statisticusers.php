






<?php
  
  require_once('../includes/init.php');
  include('../includes/header.php');
  class Statisticanswer
  {
    
  }
       
  $numberquestioncohesen = "";
            $variable1[0]  = "" ;
            $variable2[0]  = ""  ;
         if(!empty($_POST)) {
                   
            $var = strval($_POST['var1']);
            $userdetails = User::find_user_by_username($_SESSION['user_name']);
            if (isset($userdetails)){
                $nameofvar  = $userdetails[0]->$var ;
            }

         

            $answer= User::fetch_usersbyuserdetail ($var , $nameofvar);
            if (isset($answer)){
                for($i=1;$i<sizeof($answer)+1;$i++){
                    $variable1[$i]  = "[".$answer[$i-1] -> $var."]" ;
                    $variable2[$i] =  $answer[$i-1] -> count;
                   
                    
                  }
                
            }
        
    }
        
    
    if (!$session->signed_in) //disconnect user
    {
        // echo "<script>window.location.replace('../includes/index.php');</script>";
        header('Location: ../includes/index.php');
        exit;
    }


    //status of user - start , inproceess , finish 
    $userdetails = User::find_user_by_username($_SESSION['user_name']);
    if (isset($userdetails)){
        $status  = $userdetails[0]->status ;
    }

    if($status!="finish" ) //if the user status is not finish direct to index page
    { 
       header('Location: ../includes/index.php');
       exit;
    }
    


?>





<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body style="padding:1%">
        <div style=" float:right;">
    <img src="../images/survey1.png"  width="700" height="400">
        </div>
<form action="" method="Post">

 
<h2 class="page-header" ><u>Analytics Reports Of Users Details </u></h2>
            <br /><br /> 
          
            <h4>  In this section you can see how much people close to you:</h4>

         <br />  <br /> 
           

            <label for="var1"><h5> Choose a variable to compare to other user: </h5> </label>
            <select name="var1" id="var1" class="form-select" style="width:12%; background-color:lightblue;">
            <option value="gender">gender</option>
            <option value="birtdhday">birtdhday</option>
            <option value="residence">residence</option>
            </select>

          
        <br /> 

            <button type="submit" class="btn btn-warning" name="submit" class="form-select" style="width:12%;">search</button>

            <br />  <br />  <br /> 
            
            <?php 
               if(!empty($_POST)) 
               {
                echo'<div class="alert alert-warning" style="width: 45%;" >';
             echo("<h5> <b> Your answered are : ".$nameofvar."</b><h5>"); 
             if(( intval($answer[0]-> count)-1)!=0)
             {
             echo("<br /> There are ".( intval($answer[0]-> count)-1)." person that simmilar to you! There  ".strval($_POST['var1'])." also " .$nameofvar ); 
            }
            else
            {
                echo("<br /> There are ".( intval($answer[0]-> count)-1)." person that simmilar to you!");
            }
             echo("</div>"); 
               } ?>


 
            
            
            
            
            <br />    <br /> 






<div style="width: 350px;height:350px;text-align:center">
 <canvas  id="chartjs_bar"></canvas>      </div>    
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  
<script type="text/javascript">

      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',


                    data: {
                        labels:<?php echo json_encode($variable1); ?>,
                        datasets: [{
                            backgroundColor: [ "#5969ff","#ff407b", "#25d5f2", "#ffc750",
                                "#2ec551","#7040fa", "#ff004e"
                            ],
                            data:<?php echo json_encode($variable2); ?>,
                        }]
                    },
                    options: { legend: {display: true, position: 'top',
                         labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 22,
                            
                        }
                    },scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
      }]
            
                }
 
 
                }
                });
    </script>
</form>

<?php 
echo("**** Put the mouse over the graph to see the values ****"); 
?> 
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

    </body>
</html>







