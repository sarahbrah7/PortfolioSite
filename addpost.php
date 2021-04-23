<?php
session_start();
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("DATABASE_USER");
$dbpwd = getenv("DATABASE_PASSWORD");
$dbname = getenv("DATABASE_NAME");

// Creates connection
$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

// Checks connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $dateTime = date('Y-m-d H:i:s');
    $title = $_POST['title'];
    $body = $_POST['body'];
    $sql = "INSERT INTO POSTS(dateTime, title, body) VALUES ('$dateTime','$title','$body')";
    if($conn->query($sql) === TRUE){
        header("Location:blog.php");
    }
    else {
        echo '<script>alert("Error Processing the Input");</script>';
        header("Location:blog.html");
    }
$conn->close();
}

