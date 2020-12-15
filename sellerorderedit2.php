<?php

if(isset($_POST['update']))
{


    $paymentID = $_GET['paymentID'];

    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $productQuantity = $_POST['productQuantity'];
    $custName = $_POST['custName'];
    $custAddress = $_POST['custAddress'];
    $orderStatus = $_POST['orderStatus'];
    $orderTracking = $_POST['orderTracking'];

    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "update paymenting set  productID = '".$productID."', productName = '".$productName."', price = '".$price."', productQuantity = '".$productQuantity."', custName = '".$custName."', custAddress = '".$custAddress."', orderStatus = '".$orderStatus."', orderTracking = '".$orderTracking."' where paymentID ='".$paymentID."'";
    $result = mysqli_query($con,$query);
    $error = ".";


        if($result){
            header("location:sellerorder2.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:sellerorder2.php");
}

if(isset($_POST['delete']))
{
    $paymentID = $_GET['paymentID'];   
    $con = mysqli_connect("localhost","root","", "projectwd");
    $query = "delete from paymenting where paymentID ='".$paymentID."'";
    $result = mysqli_query($con,$query);


        if($result){
            header("location:sellerorder2.php");
        }
        else{
            echo 'Please check your query';
        }
}
else{
    header("location:sellerorder2.php");
}
?>