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

        if(empty($_POST['custName']) || empty($_POST['custAddress']) || empty($_POST['username']) || empty($_POST['productName']) || empty($_POST['productID']) || empty($_POST['productQuantity']) || empty($_POST['price'])) {
            $message='Isi semua yang bertanda *!';
            echo "<script type= 'text/javascript'>alert('$message');</script>";
        }
        else{
            $custName = $_POST['custName'];
            $custAddress = $_POST['custAddress'];
            $username = $_POST['username'];
            $productName = $_POST['productName'];
            $productID = $_POST['productID'];
            $productQuantity = $_POST['productQuantity'];
            $price = $_POST['price'];

            $query = "INSERT into paymenting (proofPayment, custName, custAddress, username, productName, productID, productQuantity, price, orderStatus, orderTracking)
            values ('$proofPayment', '$custName', '$custAddress', '$username', '$productName', '$productID', '$productQuantity', '$price', 'Diterima', 'Mennunggu Pengesahan')";

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
  <title>eElectronics - HTML eCommerce Template</title>
  
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

  <script type="text/javascript">
    function validate() {
            var customername = document.getElementById("custName").value;
            var customeraddress = document.getElementById("custAddress").value;
            var email= document.getElementById("email").value;
            var fileImg= document.getElementById("fileImg").value;
            

            if (customername == null || customername == "") {
                alert("Sila Masukan Nama Pangguana.");
                return false;
            }
            if (customeraddress == null || customeraddress == "") {
                alert("Sila Masukan Alamat.");
                return false;
            }
            if (email == null || email == "") {
                alert("Sila Masukan Alamat Emel.");
                return false;
            }
            if (fileImg == null || fileImg == "") {
                alert("Sila Masukan Gambar.");
                return false;
            }
            
            alert('Pembayaran Berjaya');
            alert('Pembayaran akan diproses dalam masa 3 Hari bekerja. Sila semak status pesanan untuk mengetahui status?')
            
        } 
</script>
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
                            <li ><a href="usershop.php">Halaman Kedai</a></li>
                            <li ><a href="usercart.php">Troli</a></li>
                            <li class="active"><a href="usercheckout.php">Pembayaran</a></li>
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
                        <h2>Pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
                <li><a href="userindex.php">Halaman Utama</a></li>
                <li>Pembayaran</li>
            </ul>

<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
    $total_quantity = 0;
?>	
<?php		
	foreach ($_SESSION["shopping_cart"] as $product){
?>
<?php
    $total_price += ($product["productPrice"]*$product["quantity"]);
    $total_quantity += ($product["quantity"]);
    }
?>  


<div class="product-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                    <center>
                    <form action="usercheckout.php" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                            <td>Nama Pengguna* :</td>
                            <td><input type="text" name="custName" id="custName" required></td>
                            </tr>
                            <td>Alamat* :</td>
                            <td><textarea name="custAddress" id="custAddress"  rows="4" required></textarea></td>
                            </tr>
                            <tr>
                            <td><input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>" readonly></td>
                            </tr>
                            <tr>
                            <td>product name</td>
                            <td>
                                <textarea name="productName" rows="6"  required readonly>
                                    <?php		
                                    foreach ($_SESSION["shopping_cart"] as $product){
                                    ?>
                                    <?php echo $product["productName"]; ?>
                                    <?php
                                    }
                                    ?>  
                                </textarea>
                            </td>
                            </tr>
                            <tr>
                            <td>product id</td>
                            <td>
                                <textarea name="productID" rows="6"  required readonly>
                                    <?php		
                                    foreach ($_SESSION["shopping_cart"] as $product){
                                    ?>
                                    <?php echo $product["productID"]; ?>
                                    <?php
                                    }
                                    ?>  
                                </textarea>
                            </td>
                            </tr>
                            <tr>
                            <td>product quantity</td>
                            <td><input type="text" name="productQuantity" value="<?php echo $total_quantity; ?>" readonly></td>
                            </tr>        
                            </tr>
                            <tr>
                            <td>Jumlah Pesanan (RM): </td>
                            <td><input type="text" name="price" value="<?php echo $total_price; ?>" readonly></td>
                            </tr>
                            <tr>
                            <td>Alamat Emel* :</td>
                            <td><input type="text" name="email" id="email" required></td>
                            </tr>
                            <td>Resit Pembayaran :</td>
                            <td rowspan="2"><input type="file" name="fileImg" id="fileImg"  required></td>
                            </tr>
                            <tr>
                            <td><p>Fail mestilah dalam <br> bentuk gambar <br> (.jpg <b>atau</b> .png)</p></td>
                            </tr>
                        </table>
                        <br>
                        <input type=submit value="Hantar" name="submit" onclick="validate();"><br><hr>
                        <strong><a href="usercart.php">Tukar fikiran? Kembali ke Troli</a></strong>
                        
                    </form>
                        <hr>
                    </center>
                        <p><strong>Pada masa kini, hanya pembayaran melalui <i>Bank Transfer</i> yang diterima. Kami memohon maaf atas segala kesulitan.</strong></p>
                        <p><strong>Untuk <i>tutorial Bank Transfer</i>, sila klik di <a href="https://paypal.me/nikaiman6135" target="_blank">sini</a>.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->


<?php  "RM".$total_price; ?>	
  <?php
}else{
	echo "<h3 align=center>Your cart is empty!</h3>";
	}
?>
<?php echo $status; ?>

    

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