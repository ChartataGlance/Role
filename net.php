<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vuyanii_lesegoj";
$conn = null;
//$dbname = "temp_StoreDB";
$conn = null;
global $bcrypt; 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected to DB successfully <br>";
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

if(isset($_POST['login'])){
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $message    = '';
     
         $query = "SELECT count() FROM `users` WHERE `username`= ? AND `password` = ?";
        
         $stmt = $conn->prepare($query); //line 31
         $stmt->execute([$username,$password]);
        
         $stmtl = $stmt->fetchColumn();

         if($stmtl == 1){
            $_SESSION['username'] = $username;

            $dated = date('y/m/d');
            $ip    = $_SERVER['REMOTE_ADDR']; 
           try{
                   $query = "INSERT INTO visitors(user_id,username,dated,ip) 
                VALUES(:fn, :ln, :em, :con)";
            $stmt = $conn->prepare($query);
            $stmt->bindparam(":fn",$user_id);
            $stmt->bindparam(":ln",$username);
            $stmt->bindparam(":em",$dated);
            $stmt->bindparam(":con",$ip);
           
            
            $stmt->execute();

            header('location:welcome.php');
           }
                       catch(PDOException $e){
                echo $e->getMessage();
            }
             echo $dated;

             $message ='<p style="color:red;">Logged In successfully</p>';      
         }else{
             
            $message ='<p style="color:red;">Incorrect Details Entered</p>';  
            //echo "$message";           
         }
}
?>