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
    $email = $_POST["email"];
    $pword = $_POST["password"];
    $sql = "SELECT * FROM USERS WHERE email='$email' AND password='$pword'";
    $count = mysqli_num_rows($conn->query($sql));
    if($count == 1){
        header("Location:blog.html");
    }
    else {
        echo '<script>alert("Your Login was incorrect, try again.");</script>';
        header("Location:welcome-page.html");
    }
    $conn->close();
}
