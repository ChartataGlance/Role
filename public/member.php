<?php
class Member
{
   // (A) PROPERTIES & SETTINGS
   private $pdo = null; // pdo object
   private $stmt = null; // sql statement
   public $error;
   // (B) CONSTRUCTOR - CONNECT TO DATABASE
   function __construct()
   {
      try {
         $pdo = new PDO(
            "sqlsrv:server = tcp:chartataglance.database.windows.net,1433; 
                      Database = ChartataGlance",
            "chartataglance",
            "@Kumarji78,1",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
         );
      } catch (PDOException $e) {
         die(print_r($e));
      }
   }

   // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
   function __destruct()
   {
      if ($this->stmt !== null) {
         $this->stmt = null;
      }
      if ($this->pdo !== null) {
         $this->pdo = null;
      }
   }

   // (C) HELPER - RUN SQL QUERY
   function query($sql, $data=null) {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
    }

   // (D) GET MEMBER BY ID OR EMAIL
   function get ($id) {
      $this->query(sprintf( "SELECT * from dbo.members WHERE %s=?" , is_numeric($id) ? "id" : "email"), [$id]);
      return $this->stmt->fetch();
   
      
    }



   // (E) ADD MEMBER
   // function add($name, $email, $password, $till = null)
   // {
   //    // (E1) CHECK IF EMAIL ALREADY REGISTERED
   //     if ($this->get($email)) {
   //        $this->error = "$email is already registered";
   //        return false;
   //     }

   //    // (E2) SAVE MEMBER DATA
   //    $this->query(
   //       "INSERT INTO members (name, email, password, till) VALUES (?,?,?,?)",
   //       [$name, $email, password_hash($password, PASSWORD_DEFAULT), $till]
   //    );
   //    return true;
   // }

   // (F) VERIFICATION
   // function verify($email, $password)
   // {
   //    // (F1) GET MEMBER
   //    $member = $this->get($email);
   //    $pass = is_array($member);

   //    // (F2) CHECK MEMBERSHIP EXPIRY
   //    if ($pass && $member["till"] != "") {
   //       if (strtotime("now") >= strtotime($member["till"])) {
   //          $pass = false;
   //       }
   //    }

   //    // (F3) CHECK PASSWORD
   //    if ($pass) {
   //       $pass = password_verify($password, $member["password"]);
   //    }

   //    // (F4) REGISTER MEMBER INTO SESSION
   //    if ($pass) {
   //       foreach ($member as $k => $v) {
   //          $_SESSION["member"][$k] = $v;
   //       }
   //       unset($_SESSION["member"]["password"]);
   //    }

   //    // (F5) RESULT
   //    if (!$pass) {
   //       $this->error = "Invalid email/password";
   //    }
   //    return $pass;
   // }
}


session_start();

$_MEM = new Member();

echo $_MEM->get('ramltd@msn.com') ? "ok" : $_MEM->error;
