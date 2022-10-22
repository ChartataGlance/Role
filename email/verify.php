<?php
if (isset($_GET['vkey'])) {
   $vkey = $_GET['vkey'];
   $mysqli = new mysqli('2.57.89.1', 'u333044244_chartataglance', '@Kumarji78,1', 'u333044244_chartataglance');
   $res = $mysqli->query(" SELECT verified, vkey FROM veryfiedusers where verified = 0 and vkey = '$vkey' limit 1 ");

   if ($res->num_rows == 1) {
      //validate
      $update = $mysqli->query("UPDATE veryfiedusers set verified = 1 where vkey = '$vkey' limit 1");
   } else { echo "unable to validate email"; }
   if ($update) { echo " your email verified"; } else { echo  $mysqli->error; }

} else {die("Something went wrong yuu");}
