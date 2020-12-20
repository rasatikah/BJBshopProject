<?php 

session_start();
ob_start();

// connect to the database
$db = mysqli_connect("localhost","root","", "projectwd");

// initializing variables
$errors = array(); 

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: userindex.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
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
        .login-op-button {
            background-color: rgb(138, 8, 8);
            border: none;
            color:white;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 16px;
            }
        .login-op-button:hover {
            background-color:#000
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
                        <h1><a href="index.php"><span>BJBshop | Log Masuk</span></a></h1>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="brands-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <br><br><br>
    <center>

        <h1>Pengguna</h1>

        <br><br><br>

        <form method="post" action="login.php">
            <?php include('errors.php'); ?>
            <div >
                <label>Kata nama</label>
                <input type="text" name="username" >
            </div>
            <br>
            <div >
                <label>Kata laluan</label>
                <input type="password" name="password" >
            </div>
            <br>
            <div>
                <button type="submit" class="btn" name="login_user">Login</button>
            </div>
        </form>
        <br>
        <h4>
            <button class="login-op-button" onclick="location.href = 'login_s.php';">Akaun Peniaga</button>
            <button class="login-op-button" onclick="location.href = 'login_d.php';">Akaun Penghantar</button>
            <button class="login-op-button" onclick="location.href = 'login_a.php';">Akaun Admin</button>
            <br><br><br>
            Tiada akaun? Sila klik di <button class="add_to_cart_button" onclick="location.href = 'register.php';">Sini</button> untuk mendaftar

        </h4>
    
    </center>
    
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    
   
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
