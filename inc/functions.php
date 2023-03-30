<?php
define('Db_name','data/info.txt');

function seed(){

   $data=array(

       array(
            'id'=>"1",
           'fname'=>"Soikat",
           "lname"=>"Eman",
           "roll"=>5
       ),
       array(
           'id'=>"2",
           'fname'=>"Mehfuz",
           "lname"=>"Ahmed",
           "roll"=>3
       ),
       array(
            'id'=>"3",
           'fname'=>"Rahim",
           "lname"=>"Eman",
           "roll"=>2
       ),
       array(
            'id'=>"4",
           'fname'=>"Korim",
           "lname"=>"Eman",
           "roll"=>4
       ),
       array(
            'id'=>"5",
           'fname'=>"Soikat",
           "lname"=>"Eman",
           "roll"=>8
       )
   );

$serialize=serialize($data);
file_put_contents(Db_name,$serialize,LOCK_EX);

}

function genarateReport(){
    $serialize=file_get_contents(Db_name);
    $students=unserialize($serialize);
  ?>
    <table border="1">
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll</th>
        <th>Action</th>
        </tr>
        <?php

        foreach($students as $student){
            // echo "<pre>";
            // print_r($students);
            // exit();
        ?>
        <tr>
            <td><?php echo $student['id']?></td>
            <td> <?php printf(" %s %s" ,$student['fname'] ,$student['lname']);?></td>
            <td><?php echo $student['roll']; ?></td>
            <td><a href="index.php?task=edit&id=<?php echo $student['id']?>">Edit</a> |<a class="deleteData" href="index.php?task=delete&id=<?php echo $student['id']?>">Delete</a></td>
        </tr>
        <?php
      }
        ?>
    </table>

    <?php
}

function addStudent($fname,$lname,$roll){

    $serialize=file_get_contents(Db_name);
    
    $students=unserialize($serialize);
      
    $roll_found=false;

    foreach($students as $student){
        if($student['roll']==$roll){

           $roll_found=true;
           break;
        }
      
    }

    if(!$roll_found){
        $newId=getStudentId($students);
        $student=[
            'id'=>$newId,
            'fname'=>$fname,
            'lname'=>$lname,
            'roll'=>$roll
        ];
        array_push($students,$student);
        file_put_contents(Db_name,serialize($students),LOCK_EX);
        return true;
    }
    return false;
    
     
   
}
function getStudentId($students){

    $getid=max(array_column($students,'id'));
    return $getid+1;
}


function getStudentData($id){

    $serialize=file_get_contents(Db_name);
    $students=unserialize($serialize);

    foreach($students as $student){
        
       if($student['id']==$id){

        return $student;
       }
       
    }
    return false;
}

function updateStudent($id,$fname,$lname, $roll){

    $serialize=file_get_contents(Db_name);
    $students=unserialize($serialize);
    $roll_found=false;

    foreach($students as $student){
        if($student['roll']==$roll && $student['id'] !=$id){

           $roll_found=true;
           break;
        }
      
    }

    if(!$roll_found){
        $students[$id-1]['fname']=$fname;
        $students[$id-1]['lname']=$lname;
        $students[$id-1]['roll']=$roll;
    
        file_put_contents(Db_name,serialize($students),LOCK_EX);
        return true;
    }
    return false;

   
}

function deleteStudent($id){

    $serialize=file_get_contents(Db_name);
    $students=unserialize($serialize);

    foreach($students as $offSet=>$student){
        if($student['id']==$id){
            unset($students[$offSet]);
        }
    }

   

    file_put_contents(Db_name,serialize($students),LOCK_EX);    


}

function printArray(){

    $serialize=file_get_contents(Db_name);
    $students=unserialize($serialize);

    echo "<pre>";
    print_r($students);
}