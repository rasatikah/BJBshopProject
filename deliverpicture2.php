<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $deliverImage = "profil/".$file_name;

    $deliverID = $_GET['deliverID'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $custName = $_POST['custName'];
    $phoneNumber = $_POST['phoneNumber']; 
    $email = $_POST['email'];
    $custAddress = $_POST['custAddress'];


    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "update delivery set  deliverImage = '".$deliverImage."' where deliverID ='".$deliverID."'";
    
    $result = mysqli_query($con,$query);
    move_uploaded_file($file_tmp,$deliverImage);
    $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";


        if($result){
            header("location:deliver.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:deliver.php");
}

?> = $_GET['deliverID'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $deliverName = $_POST['deliverName'];
    $phoneNumber = $_POST['phoneNumber']; 
    $deliverEmail = $_POST['deliverEmail'];
    $deliverAddress = $_POST['deliverAddress'];


    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "update deliver set  deliverImage = '".$deliverImage."' where deliverID ='".$deliverID."'";
    
    $result = mysqli_query($con,$query);
    move_uploaded_file($file_tmp,$deliverImage);
    $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";


        if($result){
            header("location:deliver.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:deliver.php");
}

?>