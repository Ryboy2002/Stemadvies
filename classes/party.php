<?php
//include("Connection.php");
//include ("../webpage/create_party.php");

if(isset($_POST['create'])){
    //$msg =
}
class party
{
function Create(){
    $partyName = $_POST['name'];
    $partyEstablished = $_POST['established'];
    $partyLeader = $_POST['party_leader'];
    $imgLogo = $_POST['img'];

    $query = "INSERT INTO party(name, established, party_leader, img) VALUES('$partyName', '$partyEstablished', '$partyLeader', '$imgLogo')";
    $exec = mysqli_query($conn, $query);
    if($exec){
        $msg = "Data was created successfully";
        return $msg;
    }
}


}
