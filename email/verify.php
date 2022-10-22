<?php
if(isset($_GET['vkey'])){
   $vkey = $_GET['vkey'];
   $mysqli = NEW mysqli('127.0.0.1', 'root', '', 'automatedtrade_co_uk');
   // $mysqli = NEW mysqli('127.0.0.1:3306', 'u333044244_chartataglance', '@Kumarji78,1', 'u333044244_chartataglance');
   $resultSet = $mysqli->query(" SELECT verified,vkey FROM veryfiedusers where verified = 0 and vkey = $vkey limit 1 ");
   if($resultSet->num_rows == 1){
      //validate
      $update = $mysqli->query("UPDATE veryfiedusers set verified = 1 where vkey = '$vkey' limit 1");
   } else {
      echo "unable to validate email";
   }
   if($update){
      echo " your email verified";
   } else{ echo  $mysqli->error; }
}else{
   die("Something went wrong");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>box shadow</title>
</head>

<body style=" background: linear-gradient(to left top, #1e2b37, #1a2b41, #1d2a4b, #292651, #392054); padding:10rem;">
   <style>
      .box {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);

      }

      form {
         height: 200px;
         width: 330px;
         display: grid;

      }

      input {
         width: 100%;
         line-height: 1.5rem;
      }

      .err {
         color: tomato;
         font-size: 1rem;
      }
   </style>
   <div class="box">
      <div class="err">
         <?php echo $err ?>
      </div>
      <form  method="POST">
         <div>
            <input type="text" name="u" placeholder="name">
         </div>
         <div>
            <input type="text" name="p" placeholder="pass">
         </div>
         <div>
            <input type="text" name="p2" placeholder="pass2">
         </div>
         <div>
            <input type="email" name="e" placeholder="email">
         </div>
         <div>
            <input style="width:50%; " type="submit" name="submit" value="register">
         </div>
      </form>

   </div>

</body>

</html>