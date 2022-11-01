<?php
define("DB_HOST", "localhost");
define("DB_NAME", "dropdown");
define("DB_CHARSET", "utf8");
define("DB_USER", "raaj");
define("DB_PASSWORD", "");

class Category
{
   private $pdo = null;
   private $stmt = null;
   public $error = null;
   function __construct()
   {
      try {
         $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER,
            DB_PASSWORD,
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
         );
      } catch (Exception $ex) {
         exit($ex->getMessage());
      }
   }
   function __destruct()
   {
      if ($this->stmt !== null) {
         $this->stmt = null;
      }
      if ($this->pdo !== null) {
         $this->pdo = null;
      }
   }

   function get($pid)
   {
      $this->stmt = $this->pdo->prepare("SELECT * FROM `category` WHERE `parent`=?");
      $this->stmt->execute([$pid]);
      $results = [];
      while ($row = $this->stmt->fetch()) {
         $results[$row["id"]] = $row["name"];
      }
      return $results;
   }
}

// (D) DATABASE SETTINGS - CHANGE TO YOUR OWN!

// (E) NEW CATEGORY OBJECT

