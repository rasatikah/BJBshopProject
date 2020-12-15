<?php 

//Starts Session
session_start(); 
ob_start();

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

<!DOCTYPE html>
<html lang="en">
<head>
<link rel='stylesheet' href='style2.css' type='text/css' media='all' />

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
    img{width:152px; height:98px;}
    img.cart-image{width:31.99px;height:30px;}
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
                        <h1><a href="index.php"><span>BJBshop | Laman Utama</span></a></h1>
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
                        <li ><a id="homePage" href="index.php">Laman Utama</a></li>
                        <li class="active"><a href="shop.php">Halaman Kedai</a></li>
                        <li><a href="contact.php">Hubungi Kami</a></li>
                        <div class="login-bar">
                        <li><a href="login.php"><i class="fa fa-user"></i> Log Masuk</a></li>
                        </div>
                    </ul>
                </div>
            </div>
        </div> <!-- End mainmenu area -->
    </div>
    
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
    <ul class="breadcrumb">
                <li><a href="index.php">Halaman Utama</a></li>
                <li>Halaman Kedai</li>
            </ul>

    <form  method="GET" action="shopcategory.php?category=">
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
					<a href='shopproduct.php?productID=".$row['productID']."&productName=".$row['productName']."'><div class='productName'>".$row['productName']."</div></a>
					<div class='productPrice'>RM".$row['productPrice']."</div>
					<div class='pbutton'><button><a href='plogin.php'>Tambah ke Troli</a></button></div>
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


     <!--footer area-->
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