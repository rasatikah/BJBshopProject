<?php 

session_start();
ob_start();

// connect to the database
$db = mysqli_connect("localhost","root","", "projectwd");
// initializing variables
$username       = "";
$deliverEmail          = "";
$phoneNumber    = "";
$deliverAddress    = "";
$deliverName       = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_deliver'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $deliverEmail = mysqli_real_escape_string($db, $_POST['deliverEmail']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $deliverAddress = mysqli_real_escape_string($db, $_POST['deliverAddress']);
  $deliverName = mysqli_real_escape_string($db, $_POST['deliverName']);

  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Katanama diperlukan"); }
  if (empty($deliverEmail)) { array_push($errors, "Email diperlukan"); }
  if (empty($phoneNumber)) { array_push($errors, "Nombor telefon diperlukan"); }
  if (empty($deliverName)) { array_push($errors, "Nama diperlukan"); }
  if (empty($deliverAddress)) { array_push($errors, "Alamat rumah diperlukan"); }
  if (empty($password_1)) { array_push($errors, "Kata laluan diperlukan"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Kedua-dua kata laluan anda tidak sama");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $deliver_check_query = "SELECT * FROM deliver WHERE username='$username' OR email='$deliverEmail' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $deliver = mysqli_fetch_assoc($result);
  
  if ($deliver) { // if user exists
    if ($deliver['username'] === $username) {
      array_push($errors, "Kata nama telah digunakan");
    }

    if ($deliver['deliverEmail'] === $deliverEmail) {
      array_push($errors, "email telah wujud");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO deliver (username, deliverEmail, password, phoneNumber, deliverAddress, deliverName) 
  			  VALUES('$username', '$deliverEmail', '$password', '$phoneNumber', '$deliverAddress', '$deliverName')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
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
          background-size: cover;
          background-image: url('img/johorflag.jpg');
        }
</style>
  
</head>

<body>
  
  <center>
    <br><br>
    <h1>Daftar Akaun | Penghantar</h1>
    <br>
    <form method="post" action="deliverregister.php">

      <table>
        <tr colspan="2"><th></th></tr>
        <tr>
          <th align="right">Nama:</th>
          <td><input type="text" name="deliverName" value="<?php echo $deliverName; ?>"></td>
        </tr>
        <tr>
          <th align="right">Email:</th>
          <td><input type="email" name="deliverEmail" value="<?php echo $deliverEmail; ?>"></td>
        </tr>
        <tr>
          <th align="right">Nombor Telefon:</th>
          <td><input type="number" name="phoneNumber" onkeypress="return mask(this,event);" value="<?php echo $phoneNumber; ?>"></td>
        </tr>
        <tr>
          <th align="right">Alamat Rumah:</th>
          <td><input type="text" name="deliverAddress" value="<?php echo $deliverAddress; ?>"></td>
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
        <button type="submit" class="btn" name="reg_deliver">Daftar</button>
      </div>
      <p>
        Sudah mempunyai akaun? <a href="login_d.php">Log Masuk</a>
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