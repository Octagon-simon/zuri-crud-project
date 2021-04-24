<?php

require_once 'core/conn.php';

if($_POST) {
    
    // This Variable will still Hold our Error Messages
  $error = "";
    
  $email = mysqli_real_escape_string ($link, $_REQUEST['email']);
  $password = mysqli_real_escape_string ($link, $_REQUEST['password']);
  $pwdhash = md5($password);

    //Check if user exists in the database

    $sql = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' AND password = '$pwdhash'");
    $numrows = mysqli_num_rows ($sql);
    
    if ($numrows != 0) {
    
        while($row = mysqli_fetch_assoc($sql))
        {
        $dbemail = $row['email'];
        $dbpwd = $row['password'];  
        $dbuname = $row['username'];  
        $dbuserid = $row['id'];      
    
    }

        if(($email == $dbemail) && ($pwdhash == $dbpwd))

        //SET SESSION
        session_start();
$_SESSION['user'] = $dbuname;
$_SESSION['user_id'] = $dbuserid;

    //Redirect to Dashboard
header ('Location: dashboard.php');
    }

else {
    $error = "Oops! Invalid Username or Password";
}
echo '<span style="color:red;">'.$error.'</span>';

}

?>

<!Doctype html>
<html>
<head></head>
<title>Login</title>
<body>
<h3>LOGIN</h3>
<form method="post">
<label>Email Address</label>
<br>
<input type="email" name="email" required="" />
<br>

<label>Password</label>
<br>
<input type="password" name="password" required="" />
<br>

<button type="submit">Login</button>

</form>
<br><br>
<p>Don't have an account? <a href="index.php">Click here to Register</a></p>
<p>Forgotten Your Password? <a href="reset_pwd.php">Click here to Reset</a></p>
</body>
</html>