<?php
$sent = @mail('ramnltd@icloud.com', 'test subject', 'test subject', 'From: admin@chartataglance.com');
if($sent){
   echo "$sent".'goodhj';
}
?>