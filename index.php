<?php
require_once "./inc/functions.php";
 $info='';
 $task=$_GET['task'] ?? 'ja sms dibo tai show korbe';
 $error=$_GET['error'] ?? 0;
 if('seed'==$task){
   seed();
   $info="Data load into file  successfully";
 }

 if(isset($_POST['submit'])){

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $roll=$_POST['roll'];

    if($fname !='' && $lname !='' && $roll !=''){
      
      $result= addStudent($fname,$lname,$roll);
      
      if($result){
         header("location:index.php?task=report");
      }else{

         header('location:index.php?error=1');
      }
     
    
   }else{
      echo "Please input data";
    }


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
      //$info!= "" if e ei condition add kora jay
        if(!empty($info)){
            echo "<p>{$info}</p>";
        }
      ?>

      <?php
         
         if('1'==$error){?>

            <h1> duplicate roll number</h1>
         <?php

         }
      
      ?>
  


      <?php
         
         if('report'==$task){?>

            <h4>Show All Student data</h4>
            <?php
             genarateReport();
            ?>
  
         <?php
          }
      
      ?>
      <?php
      if('add'==$task){?>
      <form action="index.php?report" method="post">
          
         <label for="fname">First Name</label>
         <input type="text" name="fname">
         <label for="lname">Last Name</label>
         <input type="text" name="lname">         
         <label for="roll">Roll</label>
         <input type="number" name="roll" id="">
         <button type="submit" name="submit" value="save">Save</button>

        
      </form>
      <?php } ?>
</body>
</html>