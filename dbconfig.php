<?php
function connect(){
    $host = "localhost";
    $username = "dbhandler";
    $password = "gHyg0ne0ruj";
    $database = "job_sms";

    // Create DB Connection
    $conn = mysqli_connect($host, $username, $password);
    mysqli_select_db($conn, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
?>