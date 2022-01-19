<?php
$conn = mysqli_connect("localhost", "root", "", "stemadviezen");
$response = array();
if($conn) {
    $sql = "SELECT * FROM party";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charser=UTF=8");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['name'] = $row['name'];
            $response[$i]['img'] = $row['img'];
            $response[$i]['score'] = $row['score'];
            $response[$i]['date_created'] = $row['date_created'];

            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);


    }

} else {
    echo "Database connection failed";
}