<?php
$conn = mysqli_connect("localhost", "root", "", "stemadviezen");
$response = array();
if($conn) {
    $sql = "SELECT * FROM reason ORDER BY statementid";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charser=UTF=8");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['partyid'] = $row['partyid'];
            $response[$i]['statementid'] = $row['statementid'];
            $response[$i]['opinion'] = $row['opinion'];
            $response[$i]['reason'] = $row['reason'];
            $response[$i]['date_created'] = $row['date_created'];
            $i++;
        }
        echo json_encode($response);


    }

} else {
    echo "Database connection failed";
}

