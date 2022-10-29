<?php

 $connectionInfo = array("UID" => "chartataglance", "pwd" => "{@Kumarji78,1}", "Database" => "ChartataGlance", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
 $serverName = "tcp:chartataglance.database.windows.net,1433";
 $con = sqlsrv_connect($serverName, $connectionInfo);
 if($con == false)
 die( print_r( sqlsrv_errors(),true));
 else echo "ok";

 $sql = ( "SELECT * from dbo.members WHERE email = 'ramnltd@msn.com" );
 $result = sqlsrv_fetch($con,$sql);
 if($row = $result );
 if(count($row) > 0){
   echo $row();
 }






 ?>



