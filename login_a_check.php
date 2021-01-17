<?php
session_start();

$con = mysqli_connect('localhost', 'root' );
if ($con){
    echo "Connection successful";
} else {
    echo "Connection failed";
}

$db = mysqli_select_db($con, 'projectwd');

if (isset($_POST['submit'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "select * from admin where username = '$user' and 
           password = '$pass'" ;

    $query = mysqli_query($con, $sql);

    $row = mysqli_num_rows($query);   
        if ($row == 1) {
            echo " Login successful";
            $_SESSION['username'] = $user;
            header('location: adminhomepage.php');
        } else {
            echo "LOGIN FAILEDDD";
            header('location: login_a.php');
        }
    }



?>