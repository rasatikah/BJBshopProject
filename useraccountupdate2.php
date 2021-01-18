<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $sellerImage = "profil/".$file_name;

    $userID = $_GET['ID'];

                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $custName = $_POST['custName'];
                            $userImage = $_POST['userImage'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $custAddress = $_POST['custAddress'];

    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "update user set  phoneNumber = '".$phoneNumber."', email = '".$email."', custAddress = '".$custAddress."' where userID ='".$userID."'";
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



?>