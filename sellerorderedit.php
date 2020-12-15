<?php 

    //Starts Session
    session_start(); 
    ob_start();

    //If not logged in as user
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login_s.php');
    }

    //Logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }


    $con = mysqli_connect("localhost","root","", "projectwd");
    $paymentID = $_GET['paymentID'];
    $query = "SELECT paymentID, productID, productName, price, productQuantity, custName, custAddress, orderStatus, orderTracking from paymenting where paymentID = '".$paymentID."'";
    $result = mysqli_query($con, $query);
    

    while($row=mysqli_fetch_assoc($result))
    {
        $paymentID = $row['paymentID'];
        $productID = $row['productID'];
        $productName = $row['productName'];
        $price = $row['price'];
        $productQuantity = $row['productQuantity'];
        $custName = $row['custName'];
        $custAddress = $row['custAddress'];
        $orderStatus = $row['orderStatus'];
        $orderTracking = $row['orderTracking'];
    }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BJBshop</title>
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="#" />
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="index.php"><span>BJBshop | Laman Peniaga</span></a></h1>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div> <!-- End site branding area -->

<center>
<br><br><br>
    <form action="sellerorderedit2.php?paymentID=<?php echo $paymentID ?>" enctype="multipart/form-data" method="POST">
<table>
<tr>
    <td>ID Pesanan </td>
    <td><input type="hidden" name="paymentID"  value="<?php echo $paymentID ?>" readonly><?php echo $paymentID ?></td>
    </tr>
    <td>ID Produk </td>
    <td><input type="hidden" name="productID"  value="<?php echo $productID ?>" readonly><?php echo $productID ?></td>
    </tr>
    <td>Nama Produk </td>
    <td><input type="text" name="productName"  value="<?php echo $productName ?>" readonly></td>
    </tr>
    <td>Jumlah Pesanan (RM) </td>
    <td><input type="number" name="price"  value="<?php echo $price ?>" readonly></td>
    </tr>
    <td>Kuantiti </td>
    <td><input type="number" name="productQuantity"  value="<?php echo $productQuantity ?>" readonly></td>
    </tr>
    <td>Nama Pengguna </td>
    <td><input type="text" name="custName"  value="<?php echo $custName ?>" readonly></td>
    </tr>
    <td>Alamat Pengguna </td>
    <td><input type="text" name="custAddress"  value="<?php echo $custAddress ?>" readonly></td>
    </tr>
    <td>Status Pesanan </td>
    <td>
        <input type="radio" name="orderStatus" value="Diterima" checked>Diterima <br>
        <input type="radio" name="orderStatus" value="Sudah Dibayar">Sudah Dibayar <br>
        <input type="radio" name="orderStatus" value="Sudah Dihantar">Sudah Dihantar <br>
        <input type="radio" name="orderStatus" value="Dibatalkan">Dibatalkan <br><br>
    </td>
    </tr>
    <td>Nombor Penjejakan </td>
    <td><input type="text" name="orderTracking"  value="<?php echo $orderTracking ?>" ></td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" name="update" value="update">
    <input type="submit" name="delete" value="delete">
    <input type="submit" name="back" value="back"></td>

    </tr>
    
</table>
</form>
</center>
    
<br>