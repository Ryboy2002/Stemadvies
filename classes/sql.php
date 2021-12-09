<?php 
class Sql {
  // set varriable connnection so it can get accesst only in this file in every function
    private $conn;

    // __construct is used on startup when the class is being called
    public function __construct($db) {
      // the variable $db is the data from db.php saved in the conn variable for global use
        $this->conn = $db;
    }

    public function emailverify($mail){
      $stmt = $this->conn->prepare("
      SELECT * FROM user WHERE `email`= ?");
      $stmt->execute([$mail]); 
      return $stmt;
    }

    public function loginUser($email){
        $stmt = $this->conn->prepare("
      SELECT id, password FROM admin where email = ?;");
        $stmt->execute([$email]);
        return $stmt;
    }
}