<?php 

session_start();
ob_start();

// connect to the database
$db = mysqli_connect("localhost","root","", "projectwd");
// initializing variables
$username       = "";
$sellerEmail          = "";
$phoneNumber    = "";
$sellerAddress    = "";
$sellerName       = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_seller'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $sellerEmail = mysqli_real_escape_string($db, $_POST['sellerEmail']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $sellerAddress = mysqli_real_escape_string($db, $_POST['sellerAddress']);
  $sellerName = mysqli_real_escape_string($db, $_POST['sellerName']);

  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Katanama diperlukan"); }
  if (empty($sellerEmail)) { array_push($errors, "Email diperlukan"); }
  if (empty($phoneNumber)) { array_push($errors, "Nombor telefon diperlukan"); }
  if (empty($sellerName)) { array_push($errors, "Nama diperlukan"); }
  if (empty($sellerAddress)) { array_push($errors, "Alamat rumah diperlukan"); }
  if (empty($password_1)) { array_push($errors, "Kata laluan diperlukan"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Kedua-dua kata laluan anda tidak sama");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $seller_check_query = "SELECT * FROM seller WHERE username='$username' OR email='$sellerEmail' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $seller = mysqli_fetch_assoc($result);
  
  if ($seller) { // if user exists
    if ($seller['username'] === $username) {
      array_push($errors, "Kata nama telah digunakan");
    }

    if ($seller['sellerEmail'] === $sellerEmail) {
      array_push($errors, "email telah wujud");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO seller (username, sellerEmail, password, phoneNumber, sellerAddress, sellerName) 
  			  VALUES('$username', '$sellerEmail', '$password', '$phoneNumber', '$sellerAddress', '$sellerName')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login_s.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pendaftaran</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <style>
        body{
          background: url(img/bg.jpg) no-repeat center center fixed; 
          background-size: cover;
        }
</style>
  
</head>

<body>
  
  <center>
    <h1>Daftar Akaun</h1>
    <br>
    <form method="post" action="sellerregister.php">

      <table>
        <tr colspan="2"><th></th></tr>
        <tr>
          <th align="right">Nama:</th>
          <td><input type="text" name="sellerName" value="<?php echo $sellerName; ?>"></td>
        </tr>
        <tr>
          <th align="right">Email:</th>
          <td><input type="email" name="sellerEmail" value="<?php echo $sellerEmail; ?>"></td>
        </tr>
        <tr>
          <th align="right">Nombor Telefon:</th>
          <td><input type="number" name="phoneNumber" onkeypress="return mask(this,event);" value="<?php echo $phoneNumber; ?>"></td>
        </tr>
        <tr>
          <th align="right">Alamat Rumah:</th>
          <td><input type="text" name="sellerAddress" value="<?php echo $sellerAddress; ?>"></td>
        </tr>
        <tr>
          <th align="right">Kata Nama:</th>
          <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
        </tr>
        <tr>
          <th align="right">Kata Laluan:</th>
          <td><input type="password" name="password_1"></td>
        </tr>
        <tr>
          <th align="right">Pastikan Kata laluan:</th>
          <td><input type="password" name="password_2"></td>
        </tr>
      </table>
<br>
<?php include('errors.php'); ?>
<br>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_seller">Daftar</button>
      </div>
      <p>
        Sudah mempunyai akaun? <a href="login_s.php">Log Masuk</a>
      </p>
    </form>
  </center>
  
</body>

<script type="text/javascript">
  function mask(textbox, e) {
    charCode = (e.which) ? e.which : e.keyCode;
    if (charCode == 46 || charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
      alert("Only Numbers Allowed");
      return false;
    }  
    else
    {
      return true;    
    }
  }

</script>
</html>