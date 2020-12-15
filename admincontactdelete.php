<?php

include('config.php');

$contactID=intval($_GET['contactID']);

// get the records from the database
if ($result = $link->query("DELETE FROM contact WHERE contactID = '". $contactID ."'"))
{
  echo '<script>alert("Mesej Dipadam")</script>';
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

        window.location = "admincontact.php";
    </script>
</body>
</html>