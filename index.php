<?php

require_once 'core/conn.php';
if ($_POST){

    // This Variable will Hold our Error Messages
    $error = "";
    
    $email = mysqli_real_escape_string ($link, $_REQUEST['email']);
    $uname = mysqli_real_escape_string ($link, $_REQUEST['username']);
    $pwd_1 = mysqli_real_escape_string ($link, $_REQUEST['password_1']);
    $pwd_2 = mysqli_real_escape_string ($link, $_REQUEST['password_2']);

    // Avoid Empty form fields

if (empty($email)){
    $error = "Please Provide an Email Address!"; 
}

else if (empty($uname)) {
    $error = "Please provide a Username!";
}

else {

    // Check if email already exists 

$validate = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");
$numrows = mysqli_num_rows ($validate);

if ($numrows != 0) {

    $error = "A user with this Email Already Exists! Login to your Dashboard or Reset Your Password";
 
}
    // Now check passwords

 else if ($pwd_1 != $pwd_2 ) {

    $error = "Passwords do not Match"; }

else {

    //proceed with password 2, Hash it an Insert into DB

$password = md5($pwd_2); 

$query = "INSERT INTO users (email, username, password) VALUES ('$email', '$uname', '$password')";

if(mysqli_query($link, $query)){
    echo '<span style="color:green;">Your Registration was Successful</span>';
    header('Location: login.php');
  
}
else { 
    $error = "Oops! An error has occurred". mysqli_error($link);
}

}
}
echo '<span style="color:red;">'.$error.'</span>';



}
?>
<!Doctype html>
<html>
<head></head>
<title>Register</title>
<body>
<h3>REGISTER</h3>
<form method="post">
<label>Email Address</label>
<br>
<input type="email" name="email" required="" />
<br>
<label>Username</label>
<br>
<input type="text" name="username" required="" />
<br>
<label>Password</label>
<br>
<input type="password" name="password_1" required="" />
<br>
<label>Retype Password</label>
<br>
<input type="password" name="password_2" required="" />
<br><br>
<button type="submit">Register</button>

</form>
<br><br>
<p>Already have an account? <a href="login.php">Click here to Login</a></p>
<p>Forgotten Your Password? <a href="reset_pwd.php">Click here to Reset</a></p>
</body>
</html>