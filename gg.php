 
<?php
include('function.php');
$row = retreive_users();
              foreach($row as $r){
                echo $r['userid'];
              }
?>