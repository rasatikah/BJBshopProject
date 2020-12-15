<?php

if(isset($_POST['update']))
{


    $userID = $_GET['userID'];

    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $custAddress = $_POST['custAddress'];

    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "update user set  phoneNumber = '".$phoneNumber."', email = '".$email."', price = '".$price."', custAddress = '".$custAddress."' where userID ='".$userID."'";
    $result = mysqli_query($con,$query);
    $error = ".";


        if($result){
            header("location:useraccount.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:useraccount.php");
}

if(isset($_POST['delete']))
{
    $userID = $_GET['userID'];   
    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "delete from user where userID ='".$userID."'";
    $result = mysqli_query($con,$query);


        if($result){
            header("location:useraccount.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:useraccount.php");
}
?>