<!DOCTYPE html>
<html lang = "en"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
        <link rel="stylesheet" href="reset.css" type="text/css">
        <link rel="stylesheet" href="blog.css" type="text/css">
        <title>Portifolio's Blog</title>
    </head>
    <body>
        <!-- HEADER -->
        <header id="topSection">
            <ul class="topList">
                <li>
                    <h1>Sarah Brahimi</h1>
                </li>   
                <li>
                    <a href="welcome-page.html#about">About</a>
                </li>
                <li>
                    <a href="welcome-page.html#Experience">Experience</a>
                </li>
                <li>
                    <a href="welcome-page.html#skills">Skills</a>
                </li>
                <li>
                    <a href="welcome-page.html#qualifications">Education</a>
                </li>
                <li>
                    <a href="project.html">Projects</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
    </header>
    <br>
    <br>
    <form id="months" method="POST">
        <label for="months">Choose the month:</label>
        <select name="months" id="months">
            <option selected value="00">All</option>
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">Jul</option>
            <option value="08">Aug</option>
            <option value="09">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>
        <br>
        <input type="submit" value="Filter" id="dropMonths">
    </form>
    </body>
</html>

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
    $count = mysqli_num_rows($conn -> query($sql));
    $array = array();
    if(!$conn -> query($sql)){
        echo "No records matching your query were found.";
        exit();
    }
    for($i=1;$i<=$count;$i++){
        $query = "SELECT * FROM POSTS WHERE ID ='".$i."'";
        $result =mysqli_query($conn, $query) ;
        $row = mysqli_fetch_row($result);
        $array[$i-1] = $row;
    }
    rsort($array);
    $choice = $_POST['months'];
    for($i=0;$i<$count;$i++){
        $postMonth = substr($array[$i][1],5,-12);
        if($postMonth == $choice){
            echo "<article>";
                echo "<h6>".$array[$i][1]."</h6>";
                echo "<h2>".$array[$i][2]."</h2>";
                echo "<p>".$array[$i][3]."</p>";
                echo "<hr>";
        echo"</article>";
        }
        else if($choice == "00"){
            echo "<article>";
                echo "<h6>".$array[$i][1]."</h6>";
                echo "<h2>".$array[$i][2]."</h2>";
                echo "<p>".$array[$i][3]."</p>";
                echo "<hr>";
                echo"</article>";
        }
    }
}

$conn->close();
?>
