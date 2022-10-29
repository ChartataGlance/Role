<?php
if(isset($_POST['checkUser'])){

   $mysqli = NEW mysqli('2.57.89.1', 'u333044244_chartataglance', '@Kumarji78,1', 'u333044244_chartataglance');
   // $mysqli = NEW mysqli('127.0.0.1', 'root', '', 'automatedtrade_co_uk');

   $uname = $mysqli->real_escape_string($_POST['checkUser']);
   $result = $mysqli->query("SELECT * From veryfiedusers where name = '$uname' limit 1");

   if($result->num_rows == 0 ){ echo "$uname is available. "; } 
   else { echo " $uname not available"; }

}

?>