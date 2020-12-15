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


    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $productid = $_GET['productid'];
    $query = "SELECT * from product where productID = '".$productid."'";
    $result = mysqli_query($con, $query);
    

    while($row=mysqli_fetch_assoc($result))
    {
        $productid = $row['productID'];
        $productimage = $row['productImage'];
        $productname = $row['productName'];
        $productprice = $row['productPrice'];
        $productquantity = $row['productQuantity'];
        $productdetail = $row['productDetail'];
        $productCategories = $row['productCategories'];
    }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Let'sShop - HTML eCommerce Template</title>
    
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
   
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="sellerhomepage.php">e<span>Let'sShop | Laman Peniaga</span></a></h1>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div> <!-- End site branding area -->

    

    <div class="container">

    <?php
        $productid = $_GET['productid'];

        echo "<h2>Sedang mengemaskini gambar bagi ID Produk ". $productid ."</h2>";

    ?>
<center>
<br>
    <form action="sellerproductpicutre2.php?productid=<?php echo $productid ?>" enctype="multipart/form-data" method="POST">
<table class="shop_table">
<tr>
    <tr>
        <img src="<?php echo $productimage ?>" alt="" width="20%"/>        
    </tr>
    <tr>
        <td>Gambar Produk :</td>
        <td><input type="file" name="fileImg" required></td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" name="update" value="kemaskini" onclick="return confirm('teruskan kemaskini?');">
    <button type="submit" onclick="location.href = 'sellerproduct.php';">Kembali</button><br><br><br>
    </tr>
</tr>    
</table>

</form>
</center>
    
</div>
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
  </body>
</html>