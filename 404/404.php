

<!DOCTYPE html>
<html>
<head>
  <title>ERROR 404</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container1 {
      max-width:40%;
      margin: 0 auto;
      height: 100%;
    }
    h1 {
      color: blue;
      text-align: center;
    }
    h3 {
      color: orange;
      text-align: center;
    }
    .image {
      display: block;
      margin: 0 auto;
      width: 30%;
    }
  </style>
</head>
<body>
    <?php    include('../includes/header.php'); ?>

    
  <div class="container1">
    <h1>ERROR 404 - </h1>
    <h3>Page is not found or database problem </h3>
    <br />
    <img class="image" src="../images/error404.png" width="500" height="300" >
  </div>


<!--Footer -->
<?php include('../includes/footer.php');?>
<!-- /Footer--> 
</body>
</html>