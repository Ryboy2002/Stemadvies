<?php
$conn = mysqli_connect("localhost", "root", "", "stemadviezen");
$response = array();
if($conn) {
    $sql = "SELECT * FROM statement";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charser=UTF=8");
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['subject'] = $row['subject'];
            $response[$i]['statement'] = $row['statement'];
            $response[$i]['date_created'] = $row['date_created'];
            $i++;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);


        }

    } else {
        echo "Database connection failed";
    }

