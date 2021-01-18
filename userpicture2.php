<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $userImage = "profil/".$file_name;

    $userID = $_GET['userID'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $custName = $_POST['custName'];
    $phoneNumber = $_POST['phoneNumber']; 
    $email = $_POST['email'];
    $custAddress = $_POST['custAddress'];


    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "update user set  userImage = '".$userImage."' where userID ='".$userID."'";
    
    $result = mysqli_query($con,$query);
    move_uploaded_file($file_tmp,$userImage);
    $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";


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