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