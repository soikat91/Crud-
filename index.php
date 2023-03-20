<?php
require_once "./inc/functions.php";
 $info='';
 $task=$_GET['task']?? 'report';
 if('seed'==$task){
   seed();
   $info="All Done Complete";
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Project</title>
</head>
<body>
      <h1>Simple Crud Project</h1>
      <p>A simple project to perform Crud Operation using plain file and Php</p>
      
      <?php include_once "./inc/nav.php" ?>

      <?php
        if($info !=""){
            echo "<p>{$info}</p>";
        }
      ?>
</body>
</html>