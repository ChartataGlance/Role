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
         $pdo = new PDO("sqlsrv:server = tcp:chartataglance.database.windows.net,1433; Database = ChartataGlance", "chartataglance", "@Kumarji78,1");
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }
     catch (PDOException $e) {
         print("Error connecting to SQL Server.");
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
 function query ($sql, $data) {
   $this->stmt = $this->pdo->prepare($sql, $data=null);
   $this->stmt->execute($data);
 }

 // (D) GET MEMBER BY ID OR EMAIL
 function get ($id) {
   $this->query(sprintf("SELECT * FROM `members` WHERE `%s`=?", is_numeric($id) ? "id" : "email") , [$id]);
   return $this->stmt->fetch();
 }
}


session_start();

$_MEM = new Member();

echo $_MEM->get('ramltd@msn.com') ? "ok" : $_MEM->error;
