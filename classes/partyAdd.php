<?php
$mysqli = new mysqli('localhost', 'root', '', 'stemadvies') or die(mysqli_error($mysqli));
if (isset($_POST['create'])){
    $partyName = $_POST['name'];
    $partyEstablished = $_POST['established'];
    $partyLeader = $_POST['party_leader'];
    $imgLogo = $_POST['img'];
    $date_created = date("Y-m-d H:i:s");

    $mysqli->query("INSERT INTO party (name, established, party_leader, img, date_created) VALUES ('$partyName', '$partyEstablished', '$partyLeader', '$imgLogo', '$date_created')") or die($mysqli->error);
}


