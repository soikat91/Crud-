<?php
define('Db_name','data/info.txt');

function seed(){

   $data=array(

       array(
           'fname'=>"Soikat",
           "lname"=>"Eman",
           "roll"=>5
       ),
       array(
           'fname'=>"Mehfuz",
           "lname"=>"Ahmed",
           "roll"=>3
       ),
       array(
           'fname'=>"Rahim",
           "lname"=>"Eman",
           "roll"=>2
       ),
       array(
           'fname'=>"Korim",
           "lname"=>"Eman",
           "roll"=>4
       ),
       array(
           'fname'=>"Soikat",
           "lname"=>"Eman",
           "roll"=>5
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
        <th>Name</th>
        <th>Roll</th>
        <th>Action</th>
        </tr>
        <?php

        foreach($students as $student){
        ?>
        <tr>
            <td> <?php printf(" %s %s" ,$student['fname'] ,$student['lname']);?></td>
            <td><?php echo $student['roll']; ?></td>
            <td><a href="<?php echo $student['roll']?>">Edit</a> |<a href="">Delete</a></td>
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
        $student=[

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