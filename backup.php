Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@sarahbrah7 
sarahbrah7
/
ecs417
Private
1
10
Code
Issues
Pull requests
Actions
Projects
Security
Insights
Settings
ecs417/webroot/Mini-Project2/blog.php /
@sarahbrah7
sarahbrah7 Add files via upload
Latest commit 3af925c 4 hours ago
 History
 1 contributor
77 lines (74 sloc)  2.26 KB
  
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
    </hgroup>
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
    for($i=0;$i<$count;$i++){
        echo "<article>";
            echo "<h6>".$array[$i][1]."</h6>";
            echo "<h2>".$array[$i][2]."</h2>";
            echo "<p>".$array[$i][3]."</p>";
            echo "<hr>";
        echo"</article>";
    }
}

$conn->close();
?>
