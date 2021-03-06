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

    public function numStatements($statementid) {
        $stmt = $this->conn->prepare("SELECT partyid,opinion,reason, party.name FROM reason INNER JOIN party ON party.id = reason.partyid WHERE statementid = ?");
        $stmt->execute([$statementid]);
        return $stmt->rowCount();
    }

    public function getStatement($id) {
        $stmt = $this->conn->prepare("SELECT * FROM `statement` WHERE `id` = ?;");
        $stmt->execute([$id]);
        return $stmt;
    }

    public function getParty($id) {
        $stmt = $this->conn->prepare("SELECT * FROM `party` WHERE `id` = ?;");
        $stmt->execute([$id]);
        return $stmt;
    }

    public function numParty() {
        $stmt = $this->conn->prepare("SELECT * FROM `party`;");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function nameParty() {
        $stmt = $this->conn->prepare("SELECT `name`, `id` FROM `party`;");
        $stmt->execute();
        return $stmt;
    }

    public function editStatement($subject, $statement, $id) {
        $stmt = $this->conn->prepare("UPDATE `statement` SET `subject` = ?, statement = ? WHERE id = ?;");
        $stmt->execute([htmlentities($subject), htmlentities($statement), $id]);
        return $stmt;
    }

    public function editParty($name, $established, $party_leader, $img, $id) {
        $stmt = $this->conn->prepare("UPDATE `party` SET `name` = ?, established = ?, party_leader = ?, img = ? WHERE id = ?;");
        $stmt->execute([htmlentities($name), htmlentities($established), htmlentities($party_leader), $img, $id]);
        return $stmt;
    }

    public function createStatement($subject, $statement) {
        $stmt = $this->conn->prepare("INSERT INTO `statement` (`subject`, `statement`, `date_created`) VALUES (?,?,NOW());");
        $stmt->execute([htmlentities($subject),htmlentities($statement)]);
        return $stmt;
    }

    public function createParty($name, $established, $party_leader, $img) {
        $stmt = $this->conn->prepare("INSERT INTO `party` (`name`, `established`, `party_leader`, `img`, `date_created`) VALUES (?,?,?,?,NOW());");
        $stmt->execute([htmlentities($name), htmlentities($established), htmlentities($party_leader), $img]);
        return $stmt;
    }

    public function createWithoutImageParty($name, $established, $party_leader) {
        $stmt = $this->conn->prepare("INSERT INTO `party` (`name`, `established`, `party_leader`,`date_created`) VALUES (?,?,?,NOW());");
        $stmt->execute([htmlentities($name), htmlentities($established), htmlentities($party_leader)]);
        return $stmt;
    }

    public function editWithoutImageParty($name, $established, $party_leader, $id) {
        $stmt = $this->conn->prepare("UPDATE `party` SET `name` = ?, established = ?, party_leader = ? WHERE id = ?;");
        $stmt->execute([htmlentities($name), htmlentities($established), htmlentities($party_leader), $id]);
        return $stmt;
    }


    public function editPartyOpinion($opinion, $reason, $partyid, $statementid) {
        $stmt = $this->conn->prepare("UPDATE `reason` SET `opinion`= ? , reason = ? WHERE partyid = ? AND statementid = ?;");
        $stmt->execute([$opinion,htmlentities($reason),$partyid,$statementid]);
        return $stmt;
    }

    public function createPartyOpinion($opinion, $reason, $partyid, $statementid) {
        $stmt = $this->conn->prepare("INSERT INTO `reason` (`opinion`,`reason`,`partyid`,`statementid`) VALUES (?,?,?,?);");
        $stmt->execute([$opinion,htmlentities($reason),$partyid,$statementid]);
        return $stmt;
    }

    public function deletePartyRow($id){
        $stmt = $this->conn->prepare("DELETE FROM party WHERE id = ?;");
        $stmt->execute([$id]);
        return $stmt;

    }

    public function deleteStatementRow($id){
        $stmt = $this->conn->prepare("DELETE FROM statement WHERE id = ?;");
        $stmt->execute([$id]);
        return $stmt;

    }
    public function deleteImage($partyid){
        $stmt = $this->conn->prepare("UPDATE `party` SET `img` = '' WHERE `party`.`id` = ?;");
        $stmt->execute([$partyid]);
        return $stmt;
    }

}