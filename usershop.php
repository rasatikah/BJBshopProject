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

include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `product` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$productName = $row['productName'];
$code = $row['code'];
$productPrice = $row['productPrice'];
$productID = $row['productID'];
$productImage = $row['productImage'];

$cartArray = array(
	$code=>array(
	'productName'=>$productName,
	'code'=>$code,
	'productPrice'=>$productPrice,
	'productID'=>$productID,
	'quantity'=>1,
	'productImage'=>$productImage)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<html>
<head>
<title>Simple Shopping Cart using PHP and MySQL</title>
<link rel='stylesheet' href='style2.css' type='text/css' media='all' />

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
    <style>
    .product_wrapper img{width:152px; height:98px;}
    </style>
</head>

<body>

<div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">   
                    </div>
                </div>
            </div>
        </div>
</div> <!-- End header area -->
</div>
    
<div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="userIndex.php">e<span>Let'sShop</span></a></h1>
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
                            <li class="active"><a href="usershop.php">Halaman Kedai</a></li>
                            <li ><a href="usercart.php">Troli</a></li>
                            <li ><a href="usercheckout.php">Pembayaran</a></li>
                            <li ><a href="usercontact.php">Hubungi Kami</a></li>
                            <!--<div class="login-bar">
                                <li><a href="index.php"><i class="fa fa-user"></i> Log Keluar</a></li>
                                </div>
                            -->

                            <div class="dropdownnew">
                                <button class="dropbtn"><a href="#" class="profileIcon"></a><img src="img/images.jpeg" class="image-circle"/>&nbsp&nbsp<?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myPurchase" href="userpurchase.php">Pembelian Saya</a>
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
                        <h2>Halaman Kedai</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  method="GET" action="usercategory2.php?category=">
            <ul class="breadcrumb">
                <li><a href="userindex.php">Halaman Utama</a></li>
                <li>Halaman Kedai</li>
            </ul>
        <center>
        
            <table class="shop_table cart">
                <tr>
                                       
                    <td><h2>Pilih Kategori</h2></td>
                    <td>
                        <?php
                            $mysqli=NEW MySQLi('localhost', 'root', '', 'projectwd');
                            $resultSet=$mysqli->query("SELECT categoryName from category");
                        ?>
                        <select name="category" required>
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
                    <td>
                    <input type="submit" value="Cari">
                    </td>
                </tr>
            </table>
        </form>
        </center>
    

	<div style="width:100%; margin:50 auto;">
		<?php
		if(!empty($_SESSION["shopping_cart"])) {
		$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		?>
		
		<div class="product-layout">
		<?php
		}

		$result = mysqli_query($con,"SELECT * FROM `product`");
		while($row = mysqli_fetch_assoc($result)){
                echo "<div class='product_wrapper'>
					<form method='post' action=''>
					<input type='hidden' name='code' value=".$row['code']." />
					<input type='hidden' name='productID' value=".$row['productID']." />
					<div class='productImage'><img src='".$row['productImage']."' /></div>
					<a href='usersingleproduct.php?productID=".$row['productID']."&productName=".$row['productName']."'><div class='productName'>".$row['productName']."</div></a>
					<div class='productPrice'>RM".$row['productPrice']."</div>
					<button type='submit' class='buy'>Buy Now</button>
					</form>
					</div>";
				}
		mysqli_close($con);
		?>
		</div>
		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;">
		<?php echo $status; ?>
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