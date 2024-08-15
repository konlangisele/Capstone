<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audio Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        .audio-list {
            list-style: none;
            padding: 0;
        }
        .audio-list li {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .audio-list a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        .audio-list audio {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h1>Audio Files</h1>
<ul class="audio-list">
    <?php

    // Check if CourseID is set in the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $courseID = mysqli_real_escape_string($connect, $_POST["courseIdHidden"]);
        // echo "courseid " , $courseID;
    } else {
        echo "No form data submitted.";
        exit;
    }

    $sql = "SELECT * FROM audiomaterial WHERE CourseID = $courseID";
    $result = $connect->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            echo "<li>";
            echo "<a href='" . htmlspecialchars($row['FilePath']) . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a>";
            echo "<audio controls><source src='" . htmlspecialchars($row['FilePath']) . "' type='audio/mpeg'>Your browser does not support the audio element.</audio>";
            echo "</li>";
        }
    } else {
        echo "<li>No files found for this course.</li>";
    }
    $connect->close();
    ?>
</ul>
</body>
</html>
