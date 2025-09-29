<!-- PHP code to establish connection with the localserver -->
<?php
 
// Username is root
$user = 'root';
$password = '';
 
// Database name is syllabuselplorer
$database = 'syllabusexplorer';
 
// Server is localhost with
// port number 3306
$servername='localhost:3306';
$con = new mysqli($servername, $user,$password, $database);
 
// Checking for connections
if ($con->connect_error) {
    die('Connect Error (' .
    $con->connect_errno . ') '.
    $con->connect_error);
}

?>