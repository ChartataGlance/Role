<?php
$err = null;

if (isset($_POST['submit'])) {
   $mysqli = NEW mysqli('2.57.89.1', 'u333044244_chartataglance', '@Kumarji78,1', 'u333044244_chartataglance');
   $u = $mysqli->real_escape_string($_POST['u']);
   $p = $mysqli->real_escape_string($_POST['p']);
   $p = md5($p);

   $result = $mysqli->query( " select * from veryfiedusers where name = '$u' and pass = '$p' limit 1 ");
   if($result->num_rows !=0){
      $row = $result->fetch_assoc();
      $veryfied = $row['verified'];
      $email = $row['email'];
      $date = $row['created'];

      if($veryfied ==1){
         //continue
         header('location: ../index.html');


         
      } else $err = "verify mail $email on $date";
   } $err = "credential not matching";
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
            <input style="width:50%; " type="submit" name="submit" value="register">
         </div>
      </form>

   </div>

</body>

</html>