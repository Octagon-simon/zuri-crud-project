<?php

require_once 'core/conn.php';

if($_POST) {
  
    
    // This Variable will still Hold our Error Messages
  $error = "";

  $email = mysqli_real_escape_string ($link, $_REQUEST['email']);
  $password = mysqli_real_escape_string ($link, $_REQUEST['password']);
  $pwdhash = md5($password);

// Check if Email Variable is Empty
  if(empty($email)) {
    $error = "Please Provide an Email Address!";
}
else {

    //Check if user exists in the database

    $sql = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");
    $numrows = mysqli_num_rows ($sql);
    
    if ($numrows != 0) {
    
        while($row = mysqli_fetch_assoc($sql))
        {
        $dbemail = $row['email'];  
              }

        if($email == $dbemail)

//Update Password

$update_pwd = "UPDATE users SET password = '$pwdhash' WHERE email = '$email'";

if(mysqli_query($link, $update_pwd)){
    echo '<span style="color:green;">Password Reset Was Successful</span>';
     //Redirect to Login
    header ('Location: login.php');

}
else { 
    $error = "Oops! An error has occurred".' '. mysqli_error($link);
}


}

else {
    $error = "Account Does not Exist!";
}

}
echo '<span style="color:red;">'.$error.'</span>';
 }
?>


<!Doctype html>
<html>
<head></head>
<title>Reset Password</title>
<body>
<h3>RESET YOUR PASSWORD</h3>
<form method="post">
<label>Email Address</label>
<br>
<input type="email" name="email" required="" />
<br>

<label>Password</label>
<br>
<input type="password" name="password" required="" />
<br>

<button type="submit">Reset</button>

</form>
<br><br>
<p>Don't have an account? <a href="index.php">Click here to Register</a></p>
</body>
</html>
