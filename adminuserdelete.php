<?php
// connect to the database
include('config.php');

//Starts Session
session_start(); 
ob_start();

//If not logged in as admin
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login_a.php');
}

//Logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}

$deletep = $_GET['deletep'];

// get the records from the database
if ($result = $link->query("DELETE FROM user WHERE userID = '". $deletep ."'"))
{
  echo '<script>alert("Akaun Dipadam")</script>';
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padam Akaun</title>
</head>
<body>
    <script>
        var sPageURL = window.location.href;
        var url = document.location.href;

        window.location = "adminuser.php";
    </script>
</body>
</html>
