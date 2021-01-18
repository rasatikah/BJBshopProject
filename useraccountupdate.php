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


    $con = mysqli_connect("localhost", "root", "", "projectwd");
    $userID = $_GET['GetID'];
    $query = "SELECT * from user where userID = '".$userID."'";
    $result = mysqli_query($con, $query);
    

    while($row=mysqli_fetch_assoc($result))
    {
      $userID = $row['userID'];
      $username = $row['username'];
      $password = $row['password'];
      $custName = $row['custName'];
      $phoneNumber = $row['phoneNumber']; 
      $email = $row['email'];
      $custAddress = $row['custAddress'];
      $userImage = $row['userImage'];
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
    <link rel="stylesheet" href="mystyle.css">
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
                    <h1><a href="index.php"><span>BJBshop | Laman Peniaga</span></a></h1>
                    </div>
                </div>
                
               
            </div>
        </div>
    </div> <!-- End site branding area -->
    <div class="container">
<center>
<br>
    <form action="useraccountupdate2.php?ID=<?php echo $userID ?>" enctype="multipart/form-data" method="POST">
<table class="shop_table">
<tr>
    <tr>
       <img class="avatar" src="<?php echo $userImage ?>" alt="" width="20%"/> &emsp;
        <button  class="edit"><a href="userpicture.php?userID=<?php echo $userID ?>" onclick ="return confirm('Perbuatan ini akan membuang gambar yang sedia ada. Adakah anda pasti ingin teruskan?');"> Kemaskini Gambar</a></button>
    </tr> 
    <br><br>
    <tr>
    <td>Nama</td>
    <td><input type="text" name="custName"  value="<?php echo $custName  ?>" ></td>
    </tr>
    <tr>
    <td>nombor telifon</td>
    <td><input type="text" patter="[0-9]*" name="phoneNumber"  value="<?php echo $phoneNumber  ?>" ></td>
    </tr>
    <tr>
    <td>Email</td>
    <td><input type="text" name="email"  value="<?php echo $email  ?>" ></td>
    </tr>
    <tr>
    <td>Alamat</td>
    <td><input type="text" name="custAddress"  value="<?php echo $custAddress   ?>" ></td>
    </tr>

    <tr>
        <td>

            <td><input type="submit" name="update" value="kemaskini" onclick="return confirm('teruskan kemaskini?');">
            <input type="submit" name="back" value="kembali" >
        
    </tr>
</tr>    
</table>

</form>
</center>
    
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