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


    // connect to the database
    $con = mysqli_connect("localhost", "root", "", "projectwd");

    //error check
    if(isset($_POST['submit'])){

        $file_tmp = $_FILES["fileImg"]["tmp_name"];
        $file_name = $_FILES["fileImg"]["name"];
        $productimage = "product-images/".$file_name;	

        if(empty($_POST['productName']) || empty($_POST['productPrice']) || empty($_POST['productQuantity']) || empty($_POST['code'])) {
            $message='Isi semua yang bertanda *!';
            echo "<script type= 'text/javascript'>alert('$message');</script>";
        }
        else{
            $productname = $_POST['productName'];
            $productprice = $_POST['productPrice'];
            $productquantity = $_POST['productQuantity'];
            $productdetail = $_POST['productDetail'];
            $productcategory = $_POST['productCategories'];
            $code = $_POST['code'];

            $query = "INSERT into product (productImage, productName, productPrice, productQuantity, productDetail, productCategories, code)
            values ('$productimage', '$productname', '$productprice', '$productquantity', '$productdetail', '$productcategory', '$code')";

            $result = mysqli_query($con, $query);  
            move_uploaded_file($file_tmp,$productimage);
            $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";
        }
    }
        
    else{
        
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
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li ><a id="homePage" href="sellerhomepage.php">Laman Utama</a></li>
                        <li><a href="sellershop.php">Halaman Kedai</a></li>
                        <li class="active"><a href="sellerproduct.php">Urus produk</a></li>
                        <li ><a href="sellerorder.php">Urus Pembayaran</a></li>
                        <li ><a href="sellerorder2.php">Urus Pesanan</a></li>
                        <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a><img src="img/images.jpeg" class="image-circle"/>&nbsp&nbsp<?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="seller.php">Akaun saya</a>
                                <a id="myReport" href="sellerreport.php">Laporan</a>
                                <a id="logout" href="index.php">Log Keluar</a>
                                </div>
                     </div> 
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Urus Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
                <li><a href="sellerhomepage.php">Halaman Utama</a></li>
                <li>Produk</li>
            </ul>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
<!---------------------------------------------------------------------->

<h2 class="sidebar-title">Tambah produk</h2>

<form action="sellerproduct.php" method="POST" enctype="multipart/form-data" onsubmit="myFunction()">
<table>
    <tr>
    <td>Gambar Produk :</td>
    <td><input type="file" name="fileImg" required></td>
    </tr>
    <tr>
    <td>Nama Produk* :</td>
    <td><input type="text" name="productName" required></td>
    </tr>
    <tr>
    <td>Kod Produk* :</td>
    <td><input type="text" name="code" required></td>
    </tr>
    <tr>
    <td>Harga* (RM): </td>
    <td><input type="text" name="productPrice" required></td>
    </tr>
    <tr>
    <td>Ulasan :</td>
    <td><input type="text" name="productDetail" required></td>
    </tr>
    <tr>
    <td>Kuantiti* :</td>
    <td><input type="number" name="productQuantity" required></td>
    </tr>
    <tr>
    <td>Kategori :</td>
    <?php
        $mysqli=NEW MySQLi('localhost', 'root', '', 'projectwd');
        $resultSet=$mysqli->query("SELECT categoryName from category");
    ?>
    <td>
         <select name="productCategories" required>
            <option value="default" selected disabled >Sila Pilih di bawah </option>
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
        <br/>
    <td><input type=submit value="tambah" name="submit"></td>
    </tr>
</table>
</form>

<script>
    function myFunction() {
        alert("ditambah");
    }
</script>

<br><br><br>

<!------------------------------------------------------------------------->

    <h2 class="sidebar-title">Kemaskini Produk</h2>
    
    
    <table  class="shop_table cart">
        <tr>
        <th width="3%">ID</th>
        <th  width="15%">Gambar</th>
        <th width="18%">Nama Produk</th>
        <th width="5%">Harga (RM)</th>
        <th width="5%">Kuantiti</th>
        <th width="15%">Ulasan</th>
        <th width="15%">Kategori</th>
        <th width="5%">Kemaskini</th>
        </tr>

        <?php

            $con = mysqli_connect("localhost", "root", "", "projectwd");
            $query = "SELECT * from product";
            $result = mysqli_query($con, $query);

            while($row=mysqli_fetch_assoc($result))
            {
                $productid = $row['productID'];
                $productimage = $row['productImage'];
                $productname = $row['productName'];
                $productprice = $row['productPrice'];
                $productquantity = $row['productQuantity'];
                $productdetail = $row['productDetail'];
                $productcategory = $row['productCategories'];

        ?>
            <tr>
                <td><?php echo $productid ?></td>
                <td><img src="<?php echo $productimage ?>" alt="" /></td>
                <td><?php echo $productname ?></td>
                <td><?php echo $productprice ?></td>
                <td><?php echo $productquantity ?></td>
                <td><?php echo $productdetail ?></td>
                <td><?php echo $productcategory ?></td>
                <td><a href="sellerproductupdate.php?GetID=<?php echo $productid ?>">kemaskini</a></td>
            </tr>
        <?php
            }
        ?>

        </table>

<!------------------------------------------------------------------>    



    </div>

    </div>

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>BJBshop</span></h2>
                        <p>Bangsa Johor Bahagia(BJB) dengan kerjasama UTM telah menciptakan medium terbaik untuk setiap pengguna mencari dan membeli pelbagai barangan harian seperti barangan kosmetik, makanan, minuman, pakaian dan sebagainya. BJBshop telah dicipta sejak Januari 2021. Laman web kami diciptakan bagi memudahkan urusniaga dalam talian anda. Langgani laman web kami & bersedia dengan kemaskini dan promosi terbaru! </p>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Navigasi Pengguna </h2>
                        <ul>
                            <li><a href="">Akaun saya</a></li>
                            <li><a href="">Halaman kedai</a></li>
                            <li><a href="">Hubungi kami</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Kategori</h2>
                        <ul>
                            <li><a href="">Peralatan dapur</a></li>
                            <li><a href="">Kosmetik</a></li>
                            <li><a href="">Makanan</a></li>
                            <li><a href="">Minuman</a></li>
                            <li><a href="">Pakaian</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Ikuti kami</h2>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>Penaja: <img src="img/bjblogo.jpg" width="50" height="50">   <img src="img/utmlogo.jpg" width="50" height="50">
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
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