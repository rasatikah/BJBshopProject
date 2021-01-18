<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $sellerImage = "profil/".$file_name;

    $deliverID = $_GET['ID'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $deliverName = $_POST['deliverName'];
    $phoneNumber = $_POST['phoneNumber']; 
    $deliverEmail = $_POST['deliverEmail'];
    $deliverAddress = $_POST['deliverAddress'];
    $deliverImage = $_POST['deliverImage'];


    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "update delivery set  deliverName = '".$deliverName."', phoneNumber = '".$phoneNumber."', deliverEmail = '".$deliverEmail."', custAddress = '".$custAddress."' where deliverID ='".$deliverID."'";
    $result = mysqli_query($con,$query);
    $error = ".";


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