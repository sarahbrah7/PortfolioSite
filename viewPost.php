<?php
session_start();
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("DATABASE_USER");
$dbpwd = getenv("DATABASE_PASSWORD");
$dbname = getenv("DATABASE_NAME");

$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   $sql = "SELECT * FROM POSTS";
   if($conn->query($sql) == TRUE){
    $result = mysql_query("SELECT * FROM POSTS");
    $count = mysqli_num_rows($conn -> query($sql));
    $array = array();
    if(!$result){
        echo "No records matching your query were found.";
        exit();
    }
    for($i=1;$i<=$count;$i++){
        $row = mysqli_fetch_row("SELECT * FROM POSTS WHERE ID ='$i'");
        $array[$i-1] = $row;
    }
    rsort($array);
    for($i=0;$i<$count;$i++){
        echo "<p>".$array[$i][1]."</php>";
    }
}
// else{
// // echo '<script>alert("Error Processing the Input");</script>';
// // header("Location:blog.php");
// }

$conn->close();
?>
