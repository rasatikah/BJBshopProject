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

    // connect to the database
    $con = mysqli_connect("localhost","root","", "projectwd");

    //error check
    if(isset($_POST['submit'])){

        $file_tmp = $_FILES["fileImg"]["tmp_name"];
        $file_name = $_FILES["fileImg"]["name"];
        $proofPayment = "payment/".$file_name;	

        if(empty($_POST['custName']) || empty($_POST['username']) || empty($_POST['price']) || empty($_POST['orderID'])) {
            $message='Isi semua yang bertanda *!';
            echo "<script type= 'text/javascript'>alert('$message');</script>";
        }
        else{
            $custName = $_POST['custName'];
            $username = $_POST['username'];
            $price = $_POST['price'];
            $orderID = $_POST['orderID'];

            $query = "INSERT into paymenting (proofPayment, username, custName, price, orderID)
            values ('$proofPayment', '$username', '$custName', '$price', '$orderID')";

            $result = mysqli_query($con, $query);  
            move_uploaded_file($file_tmp,$proofPayment);
            $error = "<p align=center>File ".$_FILES["fileImg"]["name"].""."<br />Image saved into Table.";
        }
    }
        
    else{
        
    }

    $status="";
    if (isset($_POST['action']) && $_POST['action']=="remove"){
    if(!empty($_SESSION["shopping_cart"])) {
      foreach($_SESSION["shopping_cart"] as $key => $value) {
        if($_POST["code"] == $key){
        unset($_SESSION["shopping_cart"][$key]);
        $status = "<div class='box' style='color:red;'>
        Product is removed from your cart!</div>";
        }
        if(empty($_SESSION["shopping_cart"]))
        unset($_SESSION["shopping_cart"]);
          }		
        }
    }

    if (isset($_POST['action']) && $_POST['action']=="change"){
      foreach($_SESSION["shopping_cart"] as &$value){
        if($value['code'] === $_POST["code"]){
            $value['quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
    }
        
    }

?>

<html>
<head>
  <title>Shopping Cart</title>
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
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                    <h1><a href="index.php"><span>BJBshop | Laman Pengguna</span></a></h1>
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
                            <li ><a href="usercontact.php">Hubungi Kami</a></li>
                            <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a><img src="img/images.jpeg" class="image-circle"/>&nbsp&nbsp<?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="useraccount.php">Akaun saya</a>
                                <a id="myPurchase" href="userpurchase.php">Pembelian Saya</a>
                                <a id="logout" href="logout.php">Log Keluar</a>
                                </div>
                     </div> 
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
                        <h2>Troli</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="breadcrumb">
                <li><a href="userindex.php">Halaman Utama</a></li>
                <li>Troli</li>
            </ul>


<div class="main" style="width:700px; margin:50 auto;">

	<div class="cart">
	<?php
	if(isset($_SESSION["shopping_cart"])){
        $total_price = 0;
        $total_quantity = 0;
	?>	
	<table class="shop_table cart">
	<tbody>
	<tr>
	<td></td>
	<td>ITEM NAME</td>
	<td>ITEM ID</td>
	<td>QUANTITY</td>
	<td>UNIT PRICE</td>
	<td>ITEMS TOTAL</td>
	</tr>	
	<?php		
	foreach ($_SESSION["shopping_cart"] as $product){
	?>
	<tr>
	<td><img src='<?php echo $product["productImage"]; ?>' width="150" height="120" /></td>
	<td><?php echo $product["productName"]; ?>
	<form method='post' action=''>
	<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
	<input type='hidden' name='action' value="remove" />
	<button type='submit' class='remove'>Remove Item</button>
	</form>
	</td>
	<td>
		<?php echo $product["productID"]; ?>
	</td>
	<td>
	<form method='post' action=''>
	<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
	<input type='hidden' name='action' value="change" />
	<select name='quantity' class='quantity' onchange="this.form.submit()">
	<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
	<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
	<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
	<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
	<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
	</select>
	</form>
	</td>
	<td><?php echo "RM".$product["productPrice"]; ?></td>
	<td><?php echo "RM".$product["productPrice"]*$product["quantity"]; ?></td>
	</tr>
	<?php
    $total_price += ($product["productPrice"]*$product["quantity"]);
    $total_quantity += ($product["quantity"]);
	}
	?>



	</tbody>
	</table>		
	<h3 style="text-align:right">TOTAL: <?php echo "RM".$total_price; ?></h3><br>
    <h3 style="text-align:right">Quantity: <?php echo $total_quantity; ?></h3><br>
	<?php
	}else{
		echo "<h3>Your cart is empty!</h3>";
		}
	?>
	</div>

	<div style="clear:both;"></div>

	<div class="message_box" align="right">
		<?php echo $status; ?>
		<input type="submit"  onclick="location.href='usershop.php';" value="Tambah Produk" />
		<input type="submit"  onclick="location.href='usercheckout.php';" value="Pembayaran" />
	</div>
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