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

    public function getAllParty() {
        $stmt = $this->conn->prepare("SELECT * FROM `party`;");
        $stmt->execute();
        return $stmt;
    }

    public function getAllStatements() {
        $stmt = $this->conn->prepare("SELECT * FROM `statement`;");
        $stmt->execute();
        return $stmt;
    }

    public function getAllReasons($statementid) {
        $stmt = $this->conn->prepare("SELECT partyid,opinion,reason, party.name FROM reason INNER JOIN party ON party.id = reason.partyid WHERE statementid = ?");
        $stmt->execute([$statementid]);
        return $stmt;
    }

    public function getStatement($id) {
        $stmt = $this->conn->prepare("SELECT * FROM `statement` WHERE `id` = ?;");
        $stmt->execute([$id]);
        return $stmt;
    }

    public function numParty() {
        $stmt = $this->conn->prepare("SELECT * FROM `party`;");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function nameParty() {
        $stmt = $this->conn->prepare("SELECT `name` FROM `party`;");
        $stmt->execute();
        return $stmt;
    }

    public function editStatement($subject, $statement, $id) {
        $stmt = $this->conn->prepare("UPDATE `statement` SET `subject` = ?, statement = ? WHERE id = ?;");
        $stmt->execute([$subject,$statement, $id]);
        return $stmt;
    }

    public function deletePartyRow($id){
        $stmt = $this->conn->prepare("SET foreign_key_checks = 0;DELETE FROM party WHERE id = ?;SET foreign_key_checks = 1");
        $stmt->execute([$id]);
        return $stmt;

    }

}