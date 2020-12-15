<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("config.php");

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable


function renderForm($phoneNumber = '', $email = '', $custAddress = '', $error = '', $userID = '')
{ ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
   <head>
      <title>Edit Profile</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <style>
        body{
          background: url(img/images6.jpg) no-repeat center center fixed; 
          background-size: cover;
        }
      </style>
	</head>


	<body>

    <!--Header-->
      

      <h1><?php if ($userID != '') { echo "Kemaskini Rekod"; } else { echo "New Record"; } ?></h1>
        <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
        . "</div>";
        }
        ?>  

      <form action="" method="post">
        <div>
          <?php if ($userID != '') { ?>
          <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
          <p>ID Pengguna: <?php echo $userID; ?></p>
          <?php } ?>

              <strong>Nombor Telefon*: </strong> <input type="text" name="phoneNumber" onkeypress="return mask(this,event);" value="<?php echo $phoneNumber; ?>"/><br/><br/>
              <strong>Alamat Email*: </strong> <input type="text" name="email" value="<?php echo $email; ?>"/><br/><br/>
              <strong>Alamat Rumah*: </strong> <input type="text" name="custAddress" value="<?php echo $custAddress; ?>"/>
              <p>* diperlukan</p>
              <input type="submit" name="submit" value="Hantar" />
        </div>
      </form>
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

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['userID']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
   // make sure the 'id' in the URL is valid
    if (is_numeric($_POST['userID']))
     {
          // get variables from the URL/form
         $userID = $_POST['userID'];
         $phoneNumber = htmlentities($_POST['phoneNumber'], ENT_QUOTES);
         $email = htmlentities($_POST['email'], ENT_QUOTES);
		     $custAddress = htmlentities($_POST['custAddress'], ENT_QUOTES);
    
		 $mysqli = new mysqli("localhost","root","", "projectwd");

          // check that data is not empty
             if ($phoneNumber == '' || $email == '' || $custAddress == '')
              {
                // if they are empty, show an error message and display the form
                 $error = 'ERROR: Please fill in all required fields!';
                 renderForm($phoneNumber, $email, $custAddress, $error, $userID);
              }
                 else
                  {
                     // if everything is fine, update the record in the database
                     if ($stmt = $mysqli->prepare("UPDATE user SET phoneNumber = ?, email = ?, custAddress = ? WHERE userID=?"))
                     {
                        $stmt->bind_param("sssi",$phoneNumber, $email, $custAddress, $userID);
                        $stmt->execute();
                        $stmt->close();
                     }
                     // show an error message if the query has an error
                          else
                          {
                              echo "ERROR: could not prepare SQL statement.";
                          }

                              // redirect the user once the form is updated
                              header("Location: adminuser.php");
                  }
     }
             // if the 'userID' variable is not valid, show an error message
               else
               {
                 echo "Error!";
               }
}
      // if the form hasn't been submitted yet, get the info from the database and show the form
     else
     {
          // make sure the 'userID' value is valid
         if (is_numeric($_GET['userID']) && $_GET['userID'] > 0)
         {
           // get 'userID' from URL
           $userID = $_GET['userID'];

          // get the recod from the database
              if($stmt = $mysqli->prepare("SELECT * FROM user WHERE userID=?"))
                {
                  $stmt->bind_param("i", $userID);
                  $stmt->execute();

                  $stmt->bind_result($userID, $username, $password, $custName, $phoneNumber, $custAddress, $email);
                  $stmt->fetch();

                   // show the form
                  renderForm($phoneNumber, $email, $custAddress, NULL, $userID);

                  $stmt->close();
                }
                  // show an error if the query has an error
                    else
                     {
                          echo "Error: could not prepare SQL statement";
                     }
         }
           // if the 'userID' value is not valid, redirect the user back to the profile.php page
             else
             {
                 header("Location: adminuser.php");
             }
     }
}
