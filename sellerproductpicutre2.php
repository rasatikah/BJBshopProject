<?php

if(isset($_POST['update']))
{

    $file_tmp = $_FILES["fileImg"]["tmp_name"];
    $file_name = $_FILES["fileImg"]["name"];
    $productimage = "photo/".$file_name;

    $productid = $_GET['productid'];

    $productname = $_POST['productName'];
    $productprice = $_POST['productPrice'];
    $productquantity = $_POST['productQuantity'];
    $productdetail = $_POST['productDetail'];
    $productCategories = $_POST['productCategories'];

    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "update product set  productimage = '".$productimage."' where productID ='".$productid."'";
    
    $result = mysqli_query($con,$query);
    move_uploaded_file($file_tmp,$productimage);
    $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";


        if($result){
            header("location:sellerproduct.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:sellerproduct.php");
}

if(isset($_POST['delete']))
{
    $productid = $_GET['ID'];   
    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "delete from product where productID ='".$productid."'";
    $result = mysqli_query($con,$query);


        if($result){
            header("location:sellerproduct.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:sellerproduct.php");
}
?>