<?php
$conn = mysqli_connect("localhost", "root", "", "stemadvies");
$response = array();
if($conn) {
   // $sql = "SELECT * FROM reason ORDER BY disagree, impartial, agree ASC;";
    $sql = "SELECT * FROM reason";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charser=UTF=8");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['partyid'] = $row['partyid'];
            $response[$i]['statementid'] = $row['statementid'];
            $response[$i]['agree'] = $row['agree'];
            $response[$i]['impartial'] = $row['impartial'];
            $response[$i]['disagree'] = $row['disagree'];
            $response[$i]['reason'] = $row['reason'];
            $response[$i]['date_created'] = $row['date_created'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);


    }

} else {
    echo "Database connection failed";
}

