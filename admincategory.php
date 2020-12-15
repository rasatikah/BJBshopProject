<?php 

    //Starts Session
    session_start(); 
    ob_start();

    //If not logged in as user
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login_a.php');
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

        if(empty($_POST['categoryName'])) {
            $message='Isi semua yang bertanda *!';
            echo "<script type= 'text/javascript'>alert('$message');</script>";
        }
        else{
            $categoryName = $_POST['categoryName'];

            $query = "INSERT into category (categoryName)
            values ('$categoryName')";

            $result = mysqli_query($con, $query);
            $error = " ";
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
                        <h1><a href="adminhomepage.php">e<span>Let'sShop | Laman Admin</span></a></h1>
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
                        <li ><a id="homePage" href="adminhomepage.php">Laman Utama</a></li>
                        <li><a href="adminuser.php">Urus Pengguna</a></li>
                        <li ><a href="adminseller.php">Urus Perniaga</a></li>
                        <li class="active"><a href="admincategory.php">Urus Produk</a></li>
                        <li  ><a href="admincontact.php">Lihat Mesej</a></li>
                        
                        
                    
                        <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a><img src="img/images.jpeg" class="image-circle"/>&nbsp&nbsp<?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="admin.php">Akaun saya</a>
                                <a id="myReport" href="adminreport.php">Laporan</a>
                                <a id="logout" href="logout.php">Log Keluar</a>
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
                        <h2>Kategori Produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
                <li><a href="adminhomepage.php">Halaman Utama</a></li>
                <li>Urus Produk</li>
            </ul>

    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <h2 class="sidebar-title">Senarai Kategori Produk</h2>
                    <center>
                    <table  class="shop_table cart">
                            <tr>
                            <th width="3%">ID</th>
                            <th  width="30%">Nama Kategori</th>
                            </tr>

                            <?php

                                $con = mysqli_connect("localhost", "root", "", "projectwd");
                                $query = "SELECT * from category";
                                $result = mysqli_query($con, $query);

                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $id = $row['id'];
                                    $categoryName = $row['categoryName'];

                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $categoryName ?></td>
                                </tr>
                            <?php
                                }
                            ?>

                            </table>
                    </center>
                    
                    <h2 class="sidebar-title">Tambah Kategori Produk</h2>
                    <form action="admincategory.php" method="POST" enctype="multipart/form-data" onsubmit="myFunction()">
                    <b>Nama Kategori: </b><br><br>
                            <input type="text" name="categoryName" required>
                            <input type=submit value="tambah" name="submit">    
                        
                    </form>
                    <br><br><br>

                    <div>
                    <h2 class="sidebar-title">Padam Kategori Produk</h2>
                        <h4>AMARAN: Perbuatan ini tidak boleh dipatah balik!</h4>
                        <b>Sila masukkan ID Kategori yang ingin dipadamkan</b>
                        <br><br>
                        <form action="admincategorydelete.php" method="GET">
                            <input type="text" name="deletep" />
                            <input type="submit" value="Padam" />
                        </form>
                    </div>

                    <script>
                        function myFunction() {
                            alert("ditambah");
                        }
                    </script>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->




    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    
                </div>
                
                <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                        <h2>e<span>Eletronik</span></h2>
                        <p>Kami menyediakan medium terbaik untuk setiap pengguna mencari dan membeli pelbagai barangan harian seperti barangan kosmetik, makanan, minuman, pakaian dan sebagainya. eElectronik telah dicipta sejak April 2020. Laman web kami kekal menjadi yang terbaik dan mempunyai ribuan pelawat setiap hari. Langgani laman web kami & bersedia dengan kemaskini dan promosi terbaru! </p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                        <h2 class="footer-wid-title">Navigasi Pengguna </h2>
                        <ul>
                            <li><a href="admin.php">Akaun saya</a></li>
                            <li><a href="adminuser.php">Akaun Admin</a></li>
                            <li><a href="adminseller.php">Akaun Peniaga</a></li>
                            <li><a href="adminreport.php">Laporan</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 eElectronics. All Rights Reserved. Coded with <i class="fa fa-heart"></i> by <a href="http://wpexpand.com" target="_blank">WP Expand</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
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