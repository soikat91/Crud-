<?php
require_once "./inc/functions.php";
 $info='';
 $task=$_GET['task'] ?? 'ja sms dibo tai show korbe';
 $error=$_GET['error'] ?? 0;


 if('delete'==$task){
   $id=$_GET['id'];
   deleteStudent($id);
   header("location:index.php?task=report");
 }
 if('seed'==$task){
   seed();
   $info="Data load into file  successfully";
 }

 $fname='';
 $lname='';
 $roll='';
 $id='';
 if(isset($_POST['submit'])){

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $roll=$_POST['roll'];
    $id=$_POST['id'];


    if($id){
      if($fname !='' && $lname !='' && $roll !=''){
         
         $updateData=updateStudent($id,$fname,$lname, $roll);
         if($updateData){

            header("location:index.php?task=report");

         }else{
            $error='1';
         }
         
       }
   }else{
      if($fname !='' && $lname !='' && $roll !=''){
      
         $result= addStudent($fname,$lname,$roll);
         
         if($result){
            header("location:index.php?task=report");
         }else{
   
            // header('location:index.php?error=1');
            $error=1;//error sms show kore
         }
      
      
      }else{
         $error=2;
      }
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

            <h1> Duplicate roll number</h1>
         <?php

         }elseif('2'==$error){?>
         <h1> Please Fill Up all Field</h1>
         
      <?php
      }

     // if($error=='3'){ ?>


<?php
      //}
      
      ?>
  


      <?php
         
         if('report'==$task){?>

            <h4>Show All Student data</h4>
            <?php
             genarateReport();
            ?>
  
         <?php
          }

          //printArray();
      
      ?>
        
      <?php
      if('add'==$task){?>
      <form action="index.php?task=add" method="post">
          
         <label for="fname">First Name</label>
         <input type="text" name="fname" value="<?php echo $fname ?>">
         <label for="lname">Last Name</label>
         <input type="text" name="lname" value="<?php echo $lname ?>">         
         <label for="roll">Roll</label>
         <input type="number" name="roll" id="" value="<?php echo $roll?>">
         <button type="submit" name="submit" value="save">Save</button>

        
      </form>
      <?php } ?>
     
      <?php
      if('edit'==$task):
         
         $id=$_GET['id'];
         $student=getStudentData($id);
         if($student):
         ?>
      <form action="" method="post">

         <input type="hidden" name="id" value="<?php echo $id?>">
         <label for="fname">First Name</label>
         <input type="text" name="fname" value="<?php echo $student['fname'] ?>">
         <label for="lname">Last Name</label>
         <input type="text" name="lname" value="<?php echo $student['lname'] ?>">         
         <label for="roll">Roll</label>
         <input type="number" name="roll" value="<?php echo $student['roll']?>">
         <button type="submit" name="submit" value="save">Save</button>

        
      </form>
      <?php
      endif;
      endif;
         ?>
         
</body>
<script>

   //alert('hi'); 
   document.addEventListener('DOMContentLoaded',function(){
      
      console.log('loader');

      var links=document.querySelectorAll(".deleteData");
      for(i=0;i<links.length;i++){
         links[i].addEventListener('click',function(e){
            if(!confirm("Are you Sure")){

               e.preventDefault();
      
            }
         });
      }

   });

</script>
</html>