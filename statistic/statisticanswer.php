<?php
  
  require_once('../includes/init.php');
  include('../includes/header.php');
 
       
  $numberquestioncohesen = "";
         if(!empty($_POST)) {
         
            $numquestion = strval($_POST['question']);

            $numberquestioncohesen = "Question Num.  ". ( $_SESSION['question'.( $numquestion)][3]) ;
            $variable1[0]  = "-" ;
            $variable2[0]  = "-"  ;
            $answer=Answerquestion::fetch_answerquestionbyquestnum($numquestion );
            if (isset($answer)){
                for($i=1;$i<sizeof($answer)+1;$i++){
                    $variable1[$i]  = "[".$answer[$i-1] -> answer." points]" ;
                    $variable2[$i] = $answer[$i-1] -> count;
                   
                    
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
       // echo "<script>window.location.replace('../includes/index.php');</script>";
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

    
            <h2 class="page-header" ><u style="text-align:center"> Analytics Reports Of Questions Of All Users</u> </h2>
            <br /> 
            <h5> In this section you can see a group by of all answers of users </h5>
            <br />

            <?php
         if(!empty($_POST)) 
         {
          echo '<div class="alert alert-warning" style="width: 65%;" > <h4>'.$numberquestioncohesen.' </h4></strong> </div>';
         }
?>


            <label for="question">Choose a number of question  :</label>

    
            <select name="question" id="question" class="form-select" style="width:20%; background-color:lightblue;">
            <option value="1">question 1</option>
            <option value="2">question 2</option>
            <option value="3">question 3</option>
            <option value="4">question 4</option>
            <option value="5">question 5</option>
            <option value="6">question 6</option>
            <option value="7">question 7</option>
            <option value="8">question 8</option>
            <option value="9">question 9</option>
            <option value="10">question 10</option>
            </select>

<br /> 
        

            <label for="charttype">Choose a chart type:</label>
            <select name="charttype" id="charttype" class="form-select" style="width:20%; background-color:lightblue;">
            <option value="doughnut">doughnut chart</option>
            <option value="bar">bar</option>
            <option value="pie">pie</option>
            <option value="area">area</option>
            <option value="line">line</option>
            </select>
            <br /><br />
            <button type="submit" class="btn btn-warning" name="submit" style="width:20%;" >search</button>

           


 

<br /> 

<div style="width: 20%;height:350px;text-align:center">

            <canvas  id="chartjs_bar"></canvas> 
        </div>    

  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



  
<script type="text/javascript">

      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: '<?php  if(!empty($_POST)) {  echo( strval($_POST['charttype'])); }   else{  echo("bar");  } ?>',
                   

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
                    }, }
                });
    </script>
</form>



<?php 
require_once("../includes/init.php");
if(!empty($_POST)) {
$numquestion = strval($_POST['question']);

$answerquestion =  Answerquestion::fetch_answerquestionbyquestnumandusername($numquestion ,  $_SESSION['user_name']);

echo('<br /> <br /><div class="alert alert-success" style="width: 20%;" >
<br />
<h5> Your answer is :  '.str_replace(",", "", $answerquestion[0]->answer).' points <h5> </div>');

}
?>


<?php 
echo("**** Put the mouse over the graph to see the values ****"); 
?> 

<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 

    </body>
</html>







