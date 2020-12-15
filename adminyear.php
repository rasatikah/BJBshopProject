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
    $query = "SELECT yearly.sellerID, yearly.month, yearly.sales 
    FROM yearly, seller 
    WHERE yearly.sellerID = seller.sellerID 
    ORDER BY yearly.sellerID";
    $result = mysqli_query($con, $query);

?>



   


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Let'sShop - HTML eCommerce Template</title>
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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
    <link rel="stylesheet" href="style2.css"> 
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
                        
                        <div class="dropdownnew">
                            <button class="dropbtn"><a href="#" class="profileIcon"></a><img src="img/images.jpeg" class="image-circle"/>&nbsp&nbsp<?php echo $_SESSION['username']; ?></button>
                                <div class="dropdownnew-content">
                                <a id="myAcct" href="admin.php">Akaun saya</a>
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
                        <h2>Laporan Pentadbir</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<div class="single-product-area">
        <div class="container">
            <div class="row">

<div class="select" style="text-align:center"  style="width:400px;">     

<form action="adminreport.php" method="POST">
       
<h1> ABC SHOP </h1>

<h4>
<select name="categories" onchange="location = this.value;">
            <option value="" disabled selected>Choose categories</option>
            <option value="adminweek.php">Weekly</option>
            <option value="adminmonth.php">Monthly</option>
            <option value="adminyear.php">Yearly</option>
</select>

<br><br>
        
        <table  class="shop_table cart">
  <thead>
    <tr>
      <th width=3%> No</th>
      <th width=45%> Year</th>
      <th> Sales (RM) </th>
      
    </tr>
  </thead>

  <?php
    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $query = "SELECT * from yearly";
    $result = mysqli_query($con, $query);

    while($row=mysqli_fetch_assoc($result))
            {
                $sellerid = $row['sellerID'];
                $year = $row['year'];
                $sales = $row['sales'];
                

        ?>
            <tr>
                <td><?php echo $sellerid ?></td> 
                <td><?php echo $year ?></td>
                <td><?php echo $sales ?></td>
                
            </tr>
        <?php
            }
        ?>
 
</table>

<button onclick="location.href='adminreport.php'">BACK</button>

<br><br>


</div>





                
        
   


            















               <!-- 
                <div class="col-md-8">
                    <div class="product-content-right">
                        <h2 class="sidebar-title">Jualan produk bulanan</h2>

                        <div id="piechart"></div>

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        
                        <script type="text/javascript">
                        // Load google charts
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        
                        // Draw the chart and set the chart values
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                          ['Kategori', 'Bilangan bulanan'],
                          
                          ['pakaian dan aksesori', 5],
                          ['solekan dan kesihatan', 5],
                          ['elektronik dan gadjet', 2],
                          ['makanan dan minuman', 12],
                    ]);
                        
                          // Optional; add a title and set the width and height of the chart
                          var options = {'title':'Kategori Jualan', 'width':850, 'height':700};
                        
                          // Display the chart inside the <div> element with id="piechart"
                          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                          chart.draw(data, options);
                        }
                        </script> 
-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--
<center> <input type="submit" value="edit" name="edit" class="button">
<input type="submit" value="padam" name="padam" class="button"></center> -->

                    </div>
                </div>
            </div>
         </div>
    </div>
                    

    




    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
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
                            <li><a href="UserAccount.html">Akaun saya</a></li>
                            <li><a href="UserPurchase.html">Sejarah Pesanan</a></li>
                            <li><a href="contact.html">Kenalan Penjual</a></li>
                            <li><a href="index.html">Laman utama</a></li>
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
                        <h2 class="footer-wid-title">Surat Berita</h2>
                        <p>Daftar ke surat berita kami dan dapatkan tawaran eksklusif yang anda tidak akan dapat mencari di tempat lain terus ke peti masuk anda!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Taipkan e-mel anda">
                            <input type="submit" value="Melanggan">
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


















