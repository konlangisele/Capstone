<?php

include "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['audio_file'])) {
    $target_dir = "audio_files/";
    $target_file = $target_dir . basename($_FILES["audio_file"]["name"]);
    $uploadOk = 1;
    $audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $Title = $_POST["title"];
    $CourseID = $_POST["courseid"];
    // Check if file is an actual audio file
    $check = filesize($_FILES["audio_file"]["tmp_name"]);
    if ($check === false) {
        echo json_encode(["status" => "error", "message" => "File is not an audio file."]);
        $uploadOk = 0;
    }

    // Check file size (optional)
    if ($_FILES["audio_file"]["size"] > 500000) {
        echo json_encode(["status" => "error", "message" => "Sorry, your file is too large."]);
        $uploadOk = 0;
    }

    // Allow certain file formats (optional)
    $allowedFormats = ['mp3', 'wav', 'ogg'];
    if (!in_array($audioFileType, $allowedFormats)) {
        echo json_encode(["status" => "error", "message" => "Sorry, only MP3, WAV & OGG files are allowed."]);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Error message already set
    } else {
        if (move_uploaded_file($_FILES["audio_file"]["tmp_name"], $target_file)) {
            // Save file info to the database
           

            $title = htmlspecialchars(basename($_FILES["audio_file"]["name"]));
            $file_path = $target_file;
            $sql = "INSERT INTO audiomaterial ( Title, Format, CourseID, FilePath) VALUES ('$title','mp3','$CourseID', '$file_path')";

            if ($connect->query($sql) === TRUE) {
                echo json_encode(["status" => "success", "message" => "The file has been uploaded and record inserted successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error: " . $sql . "<br>" . $connect->error]);
            }

            $connect->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Sorry, there was an error uploading your file."]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
