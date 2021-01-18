<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $sellerImage = "profil/".$file_name;

    $sellerID = $_GET['ID'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sellerName = $_POST['sellerName'];
        $phoneNumber = $_POST['phoneNumber']; 
        $sellerEmail = $_POST['sellerEmail'];
        $sellerAddress = $_POST['sellerAddress'];
        $sellerImage = $_POST['sellerImage'];
        $shopName = $_POST['shopName'];

    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "update seller set  sellerName = '".$sellerName."', phoneNumber = '".$phoneNumber."',shopName = '".$shopName."', sellerEmail = '".$sellerEmail."', sellerAddress = '".$sellerAddress."' where sellerID ='".$sellerID."'";
    
    $result = mysqli_query($con,$query);
    move_uploaded_file($file_tmp,$sellerImage);
    $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";


        if($result){
            header("location:seller.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:seller.php");
}


?>