<?php
class User
{
   private $pdo = null;
   private $stmt = null;
   public  $error;
   // (B) CONSTRUCTOR - CONNECT TO DATABASE
   function __construct()
   {
      try {
         $this->pdo = new PDO(
            "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USER,
            DB_PASSWORD,
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
         );
      } catch (Exception $ex) { exit($ex->getMessage()); }
   }

   // (C) DESTRUCTOR - CLOSE DATABASE CONNECTION
   function __destruct()
   {
      if ($this->stmt !== null) {
         $this->stmt = null;
      }
      if ($this->pdo !== null) {
         $this->pdo = null;
      }
   }
   //helper
   function query($sql, $data = null)
   {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
   }


   // (D) LOGIN
   function login($email, $password)
   {
      // (D1) GET USER & CHECK PASSWORD
      $this->query("SELECT * FROM `users` JOIN `roles` USING (`role_id`) WHERE `user_email`=?", [$email]);
      $user = $this->stmt->fetch();
      $valid = is_array($user);
      if ($valid) {
         $valid = $password == $user["user_password"];
      }
      if (!$valid) {
         $this->error = "Invalid email/password";
         return false;
      }

      // (D2) GET PERMISSIONS
      $user["permissions"] = [];
      $this->query(
         "SELECT * FROM `roles_permissions` r
     LEFT JOIN `permissions` p USING (`perm_id`)
     WHERE r.`role_id`=?",
         [$user["role_id"]]
      );
      while ($r = $this->stmt->fetch()) {
         if (!isset($user["permissions"][$r["perm_mod"]])) {
            $user["permissions"][$r["perm_mod"]] = [];
         }
         $user["permissions"][$r["perm_mod"]][] = $r["perm_id"];
      }

      // (D3) DONE
      $_SESSION["user"] = $user;
      unset($_SESSION["user"]["user_password"]);
      return true;
   }

   // check permission
   function check ($module, $perm) { 
      $valid = isset($_SESSION["user"]);
      if ($valid) { $valid = in_array($perm, $_SESSION['user']["permissions"][$module]); }
      if($valid){ return true;}
      else { $this->error = "no permission."; return false; }
   }


   //get user

   function get ($email){
      if(!$this->check("USR", 1)){ return false;}
      $this->query("select * from `users` join `roles` using (`role_id`) where `user_email` =? ", [$email]);
      return $this->stmt->fetch();
   }

   function save ($email, $password, $role, $id=null) {
      if(!$this->check("USR", 2)){ return false;}
      $sql = $id==null ?
      "INSERT INTO `users` (`user_email`, `user_password`, `role_id `) values (?, ?, ?) " 
      : "update `users` set `user_email` = ? `role_id`= ? where `user_id ";
      $data = [$email, $password, $role];
      if($id !=null) {$data[] = $id; }
      $this->query($sql, $data);
      return true;

    

   }

   function del ($id) {
      if(!$this->check("USR", 3)){ return false;}
      $this->query( "delete from `users` where `user_id`=?" , [$id] );
      return true;
   }

};

define("DB_HOST", "127.0.0.1");
define("DB_NAME", "automatedtrade_co_uk");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

$_USR = new User();

session_start();





echo $_USR->login("ramn@msn.com", "123456") ? "ok" : $_USR->error;


print_r($_SESSION);

//get user
// $user = $_USR->get("joe@doe.com");
// echo $_USR->save("joy@doe.com", "123456", 2 ) ? "ok <br>" : $_USR->errer;
echo $_USR->del(3) ? "ok"  : $_USR->error;
// print_r($user);

echo $_USR->query(
   " create table `usersDATA`
(user_ID int  primary key,
 user_NAME varchar(30) not null ,
 user_EMAIL varchar(60) not null UNIQUE,
 newsletter bit default 1 ,
 subscription date null,
 created_AT datetime not null,
 user_IP varchar(120),
 devive_MAC char(60)
 )"

);
