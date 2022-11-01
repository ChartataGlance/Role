<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./public/template.css">
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script>
      $(document).ready(function(e) {
         $('#uname').keyup(function() {
            var uname = $(this).val();
            var output = $('#output');
            if(uname != '') {
               $.post('check.php', { checkUser: uname }, function(data) {
                  $('#output').html(data);
               });
            }
         });
      });
</script>
</head>
<body style=" background: #1e2b37;  padding:10rem;">

   <form method="POST">
      <div>
         <input type="text" name="uname" id="uname"  />
         <span style="color:aliceblue ;" id="output"></span>
      </div>

   </form>

</body>

</html>