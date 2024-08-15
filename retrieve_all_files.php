<?php
header('Content-Type: application/json');

include "config.php";

$sql = "SELECT * FROM audiomaterial ";
$result = $connect->query($sql);

$files = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $files[] = $row;
    }
    echo json_encode(["status" => "success", "files" => $files]);
} else {
    echo json_encode(["status" => "error", "message" => "No files found."]);
}

$connect->close();
?>
