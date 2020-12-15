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
    $productid = $_GET['GetID'];
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
    <div class="container">
<center>
<br>
    <form action="sellerproductedit.php?ID=<?php echo $productid ?>" enctype="multipart/form-data" method="POST">
<table class="shop_table">
<tr>
    <tr>
        <img src="<?php echo $productimage ?>" alt="" width="20%"/>
        <button  class="edit"><a href="sellerproductpicture.php?productid=<?php echo $productid ?>" onclick="return confirm('Perbuatan ini akan membuang gambar yang sedia ada. Adakah anda pasti ingin teruskan?');">Kemaskini Gambar</a></button>
    </tr>
    <td>Produk ID </td>
    <td><?php echo $productid ?></td>
    </tr>
    <tr>
    <td>Nama produk</td>
    <td><input type="text" name="productName"  value="<?php echo $productname  ?>" ></td>
    </tr>
    <tr>
    <td>Harga (RM) </td>
    <td><input type="text" name="productPrice"  value="<?php echo $productprice  ?>" ></td>
    </tr>
    <tr>
    <td>Kuantiti</td>
    <td><input type="number" name="productQuantity"  value="<?php echo $productquantity  ?>" ></td>
    </tr>
    <tr>
    <td>Ulasan</td>
    <td><input type="text" name="productDetail"  value="<?php echo $productdetail   ?>" ></td>
    </tr>
    <td>Kategori</td>
    <?php
        $mysqli=NEW MySQLi('localhost', 'root', '', 'projectwd');
        $resultSet=$mysqli->query("SELECT categoryName from category");
    ?>
        <td><select name="productCategories" required>
            <option value="<?php echo $productCategories?>"  ><?php echo $productCategories?></option>
            <?php
                while($rows=$resultSet->fetch_assoc())
                {
                    $categoryName = $rows['categoryName'];
                    echo "<option value='$categoryName'>$categoryName</ <br>";
                }
            ?>        
            <option value="Lain - lain" >Lain-lain </option> 
         </select>
        </td>
    </tr>


    <tr>
        <td></td>
        <td>
            <input type="submit" name="update" value="kemaskini" onclick="return confirm('teruskan kemaskini?');">
            <input type="submit" name="delete" value="padam" onclick="return confirm('teruskan padam?');">
            <input type="submit" name="back" value="kembali" >
        </td>
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