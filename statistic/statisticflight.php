

<?php
  
  require_once('../includes/init.php');
  include('../includes/header.php');


  class Statistic
  {
    

  }
       
 
   
         if(!empty($_POST)) {
            $selected1 = strval($_POST['var1']);
            $selected2 = strval($_POST['var2']);
            $type = strval($_POST['type']);
            $limit = strval($_POST['limit']);
            $variable1[0]  = "" ;
            $variable2[0]  = ""  ;
            $flights=Flight::fetch_flightbyargu($selected1 , $selected2,$type , $limit);
            if (isset($flights)){
                for($i=1;$i<sizeof($flights)+1;$i++){
                    $variable1[$i]  = $flights[$i-1] -> $selected1 ;
                    $variable2[$i] = $flights[$i-1] -> $selected2;
                    $data = json_encode($flights,true);
                    
                  }
                
            }
        
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

    <?php 
    require_once("../chatbot/chatbot.php");
    ?>

<form action="" method="Post">

    
            <h2 class="page-header" > <u > Analytics Reports of Flight details</u> </h2>
            <br />
           <h4> choose as any combintaion as you can that reprsent a correlation between two variable : <h4>
         <h5>  eg. a correclation between compnay name to count of delay time in total  </h5>
            <br /> 
            <br /> 


            <label for="var1"><h5>Choose a variable num 1 :</h5></label>
            <select name="var1" id="var1" class="form-select" style="width:30%; background-color:lightblue;"> 
            <option value="compname">Compny Name</option>
            <option value="classtype">Class type</option>
            <option value="landloc">Land location </option>
            <option value="takeoffloc">Take Off Location</option>
            </select>
            <br />  
            <label for="var2"><h5>Choose a variable num 2 : </h5></label>
            <select name="var2" id="var2" class="form-select" style="width:30%; background-color:lightblue;">
            <option value="delay">delay time </option>
            <option value="durationtime">duration time</option>
            </select>
            <br /> 
            <label for="type"><h5>Choose a method aggregiation: </h5></label>
            <select name="type" id="type" class="form-select" style="width:30%; background-color:lightblue;">
            <option value="SUM">SUM (sum of all flights)</option>
            <option value="COUNT">COUNT (count of all flights)</option>
            <option value="MAX">MAX (find max flight)</option>
            <option value="MIN">MIN (find min flight)</option>
            <option value="AVG">AVG (find the average of all flights)</option>
            </select>
            <br /> 
            
            <label for="limit"><h5> Choose a limit number: (how much variable you want to dispaly in graph?)
            eg. number 15 max display is 15 colums bar in graph </h5>   </label>
          
            <select name="limit" id="limit" class="form-select" style="width:30%; background-color:lightblue;">
            <?php for ($i = 15; $i >= 1; $i--) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>

            <br /> 
            <button type="submit" class="btn btn-warning" name="submit" style="width:30%;font-size:large" >search</button>

 <br />  <br /> <br /> 

 



<div style="width:40%;height:20%;text-align:center">
<p id="title"> 
<?php

if (!$session->signed_in) //disconnect user
{
    echo "<script>window.location.replace('../includes/index.php');</script>";

}

//status of user - start , inproceess , finish 
$userdetails = User::find_user_by_username($_SESSION['user_name']);
if (isset($userdetails)){
    $status  = $userdetails[0]->status ;
}

if($status!="finish" ) // if the user status is not finish direct to index page
{ 
    echo "<script>window.location.replace('../includes/index.php');</script>";
}








  if(!empty($_POST)) {
 $selected1 = strval($_POST['var1']);
 $selected2 = strval($_POST['var2']);
 $type = strval($_POST['type']);
 $limit = strval($_POST['limit']);
 echo("Detail about - <b>".$selected1."</b> and <b>".$selected2."</b> by <b>".$type."-</b> limit by ".$limit);
 
  }
?>
</p>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
        <?php 
echo("**** Put the mouse over the graph to see the values ****"); 
?> 

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
                    options: { legend: {display: true, position: 'bootom',
                         labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 22,
                         }
                    },
                    scales: {
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


<div style=" float:right;">
    <img src="../images/survey2.png"  width="700" height="400">
</div>





 

</body > 
<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 
</html>