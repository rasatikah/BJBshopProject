<?php 

    //Starts Session
    session_start(); 
    ob_start();

    //If not logged in as user
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    //Logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

    $db = mysqli_connect("localhost","root","", "projectwd");

// initializing variables
$name       = "";
$email          = "";
$phoneNumber    = "";
$inquiries    = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['contact'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $inquiries = mysqli_real_escape_string($db, $_POST['inquiries']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Nama diperlukan"); }
  if (empty($email)) { array_push($errors, "Email diperlukan"); }
  if (empty($phoneNumber)) { array_push($errors, "Nombor telefon diperlukan"); }
  if (empty($inquiries)) { array_push($errors, "Borang tidak boleh kosong"); }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO contact (name, email, phoneNumber, inquiries) 
  			  VALUES('$name', '$email', '$phoneNumber', '$inquiries')";
  	mysqli_query($db, $query);
  }
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

	<style>
		.column {
		float: left;
		padding: 36px;
        }

        .image-circle{
    border-radius: 50%;
    width: 45px;
    height: 45px;
    border: 0px solid #555;
    object-fit: cover;
}

	</style>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        <h1><a href="index.php"><span>BJBshop | Laman Utama</span></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                    <?php
                    if(!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                    ?>
                    <div class="cart_div">
                    <a href="usercart.php">
                    <img src="cart-icon.png" /> Cart
                    <span><?php echo $cart_count; ?></span></a>
                    </div>
                    <?php
                    }
                    else if(empty($_SESSION["shopping_cart"])) {
                        ?>
                        <div class="cart_div">
                        <a href="usercart.php">
                        <img src="cart-icon.png" /> Cart
                        </a>
                        </div>
                        <?php
                        }
                        ?>
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
                            <li ><a id="homePage" href="userindex.php">Laman Utama</a></li>
                            <li ><a href="usershop.php">Halaman Kedai</a></li>
                            <li class="active"><a href="usercontact.php">Hubungi Kami</a></li>
                            <?php
                      $con = mysqli_connect("localhost", "root", "", "projectwd");
                      $query = "SELECT * from user";
                      $result = mysqli_query($con, $query);
                      while($row=mysqli_fetch_assoc($result))
                        {
                    
                            $userImage = $row['userImage'];
                    ?>
                    ?>
                        <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a> <img class="image-circle" src="<?php echo $userImage ?>" alt=""/>&emsp; <?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="useraccount.php">Akaun saya</a>
                                <a id="myReport" href="userpurchase.php">Laporan</a>
                                <a id="logout" href="logout.php">Log Keluar</a>
                                </div>
                    <?php } ?>
                        </ul>
                    </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    </div>
    
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Hubungi Kami</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="breadcrumb">
                <li><a href="userindex.php">Halaman Utama</a></li>
                <li>Hubungi Kami</li>
            </ul>

<!----------------------------------------------------------------------------------------------->
<div style="background-image: url('img/theme3.jpg');">
    <div class="product-widget-area">
        <div class="container">
                                 
                                    
                                  
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <br><br><br>
                                
                            <div class="row">
                                
                            <center>
    
                                <h1>
                                    BANGSA JOHOR BAHAGIA
                                </h1>
                                <BR></BR>
                                    <div class="column" style="background-color:rgb(112, 110, 114);">
                                        <h3>
                                            Alamat
                                        </h3>
                                        <h4>
                                            Jalan Pulai Harmoni 3, <br>
                                            Bandar Baru Kangkar Pulai, <br>
                                            Skudai, Johor Bahru
                                        </h4>
                                        <br>
                                        <h3>
                                            Hubungi kami
                                        </h3>
                                        <h4>
                                            019-970 3189  (Pn Su)
                                        </h4>
                                        <br>
                                        <h3>
                                            Email
                                        </34>
                                        <h4>
                                            <a href="mailto:bjbkangkarpulai@gmail.com" target="_top">bjbkangkarpulai@gmail.com</a>
                                        </h4>	
             
                                                   
                                              
                                        
    
                                    
                      </center>
                        
                        
    
                      <div class="column" style="background-color:rgb(144, 106, 179);">
                                    <div>
                                    <form method="post" action="usercontact.php">

                                    <b>
                                        <h4>Nama:</h4> <input type="text" name="name" size="50" placeholder="Nama"><br><br>
                                        <h4>Email:</h4> <input type="email" name="email" size="50" placeholder="Email"><br><br>
                                        <h4>No Telefon:</h4> <input type="number" name="phoneNumber" onkeypress="return mask(this,event);" size="53" placeholder="Nombor Telefon"><br><br>
                                        <h4>Tinggalkan Mesej anda:</h4> <textarea type="textarea" name="inquiries" rows="10" cols="70" placeholder="Mesej"></textarea><br><br>
                                    </b>
                                    <?php include('errors.php'); ?>
                                    <div class="input-group">
                                    <button type="submit" class="btn" name="contact" onclick="alert('Mesej anda telah dihantar. Terima kasih!')">Hantar</button>
                                    </div>
                                    </form>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!------------------------------------------------------------------------------------------------------------------------->
    
    <!-- End brands area -->
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