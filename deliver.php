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
    <style>

.avatar {
  vertical-align: middle;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
          }
          .image-circle{
    border-radius: 50%;
    width: 45px;
    height: 45px;
    border: 0px solid #555;
    object-fit: cover;

}

</style>
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
                        <h1><a href="index.php"><span>BJBshop | Laman Penghantar</span></a></h1>
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
                        <li><a id="homePage" href="deliverhomepage.php">Laman Utama</a></li>
                        <li><a href="deliverdelivery.php">Penghantaran</a></li>
                        <?php
                      $con = mysqli_connect("localhost", "root", "", "projectwd");
                      $query = "SELECT * from delivery";
                      $result = mysqli_query($con, $query);
                      while($row=mysqli_fetch_assoc($result))
                        {
                    
                            $deliverImage = $row['deliverImage'];
                    ?>
                    ?>
                        <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a> <img class="image-circle" src="<?php echo $deliverImage ?>" alt=""/>&emsp; <?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="deliver.php">Akaun saya</a>
                                <a id="logout" href="logout.php">Log Keluar</a>
                                </div>
                    <?php } ?>
                    </ul>
                </div>  
            </div>
        </div>
    </div> 
    </div>
    
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Profil Anda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="breadcrumb">
                <li><a href="deliverhomepage.php">Halaman Utama</a></li>
                <li>Profil</li>
            </ul>
    
    <div class="product-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                    <?php
                      $con = mysqli_connect("localhost", "root", "", "projectwd");
                      $query = "SELECT * from delivery";
                      $result = mysqli_query($con, $query);
                    

                      while($row=mysqli_fetch_assoc($result))
                        {
                            $deliverID = $row['deliverID'];
                            $username = $row['username'];
                            $password = $row['password'];
                            $deliverName = $row['deliverName'];
                            $phoneNumber = $row['phoneNumber']; 
                            $deliverEmail = $row['deliverEmail'];
                            $deliverAddress = $row['deliverAddress'];
                            $deliverImage = $row['deliverImage'];
                    ?>
                        <center><td><img class="avatar" src="<?php echo $deliverImage ?>" alt="centered image" /></td></center>
                        <h1 style="color:black; text-align:center;"><?php echo $deliverName ?></h1><br/>

                        <table  class="shop_table cart">  
                        <tr>
                        <th colspan="3" align="center" id="th1">Maklumat Peribadi</th>
                        </tr>                                
                            <tr><td><b>Kata Nama</td><td><?php echo $username ?></td><td rowspan="6" align="center"><a href="deliveraccountupdate.php?GetID=<?php echo $deliverID ?>">Edit</a></td></tr>
                            <tr><td><b>Kata Laluan</td><td><?php echo $password ?></td></tr>
                            <tr><td><b>Nama</td><td><?php echo $deliverName ?></td></tr>
                            <tr><td><b>Nombor telifon</td><td><?php echo $phoneNumber ?></td></tr>
                            <tr><td><b>Email</td><td><?php echo $deliverEmail ?></td></tr>
                            <tr><td><b>Alamat</td><td><?php echo $deliverAddress ?></td></tr>
                        </table>
                        <br>
                        <?php
                            }
                        ?>

                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    
    
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