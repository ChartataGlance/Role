<?php
$err = null;
if (isset($_POST['submit'])) {
   $u =  $_POST['u'];
   $p =  $_POST['p'];
   $p2 = $_POST['p2'];
   $e =  $_POST['e'];

   if(strlen($u) < 4 ){
      $err = "<p> 4 char </p> ";
   } elseif ($p2 != $p ){
      $err .= " <p> not match </p>";
   }else {
      $mysqli = NEW mysqli('2.57.89.1', 'u333044244_chartataglance', '@Kumarji78,1', 'u333044244_chartataglance');
      //$mysqli = NEW mysqli('127.0.0.1', 'root', '', 'automatedtrade_co_uk');
      $u =  $mysqli->real_escape_string($u);
      $p =  $mysqli->real_escape_string($p);
      $p2 = $mysqli->real_escape_string($p2);
      $e =  $mysqli->real_escape_string($e);
      $vkey = md5(time().$u);
      $p = md5($p);
      $insert = $mysqli->query(" INSERT INTO veryfiedusers (name,pass,email,vkey) values ('$u', '$p', '$e', '$vkey' ) ");
      if($insert){

         //send mail
         $to = $e;
         $subject = "Email veryfication";
         $message = "<a href='https://chartataglance.com/veryfi.php?=$vkey'>Thanks for veryfi</a>";
         $headers[] = 'MIME-Version: 1.0';
         $headers[] = 'Content-type: text/html; charset=iso-8859-1';
         $headers[] = 'From: mail@chartataglance.com';
         mail($to, $subject, $message, implode("\r\n", $headers));
         header('location: signedup.php');

      } else { echo $mysqli->error;}

      echo $vkey;
   }

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

<body style=" background:  #1e2b37; padding:10rem;">
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
      <form action="" method="POST">
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