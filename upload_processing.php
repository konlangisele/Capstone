<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//code used to connect the php to a database in mysqli
$host="localhost";
$user="root";
$password="";
$database_name="capstone";

$connect=mysqli_connect($host, $user, $password, $database_name) or die("could not connect"); //line of code used to connect to databse
?>

<?php
$target_dir = "uploads/";

// Create the uploads directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if file is a valid
if (isset($_POST["submit"])) {
    $allowedTypes = ['pdf', 'doc', 'mp4', 'm4a', 'docx', 'ppt', 'pptx', 'txt'];
    if (in_array($fileType, $allowedTypes)) {
        $uploadOk = 1;
       
    } else {
        echo "Sorry, only PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, and TXT files are allowed.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) { 
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // Insert file information into the database
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $filePath = $target_file;
        $sql = "INSERT INTO audiomaterial (Title, Format, CourseID, FilePath) VALUES ('$fileName', '$fileType', '1', '$filePath')";

        if ($connect->query($sql) === TRUE) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded and information saved to database.";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
   else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>