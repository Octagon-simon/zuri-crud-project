<?php

session_start();
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
if (empty($username) && empty($user_id)) {
    header('Location: ../login.php');
}

else {
    require_once '../core/conn.php';
    if ($_POST){
    
        // This Variable will Hold our Error Messages
        $error = "";
        
        $course_name = mysqli_real_escape_string ($link, $_REQUEST['course_name']);
        $course_type = mysqli_real_escape_string ($link, $_REQUEST['course_type']);
        $course_time = mysqli_real_escape_string ($link, $_REQUEST['course_time']);
    
if(empty($course_name)) {
    $error = "A course Name is required!";
}
else {
    $query= "INSERT INTO courses (user_id, name, type, time) VALUES ('$user_id', '$course_name', '$course_type', '$course_time')";
   // If the process was successful,
    if(mysqli_query($link, $query)){
        echo '<span style="color:green;">Course Added Successfully</span>';
    }
    else { 
        $error = "Oops! An error has occurred". mysqli_error($link);
    }
}
echo '<span style="color:red;">'.$error.'</span>';
}
}

?>
<!Doctype html>
<html>
<head></head>
<title>Add course</title>
<body>
<h1 align="center">ADD A COURSE</h1>
<h3 align="right">WELCOME <span style="color:green"><?php echo $username ?> </span></h3>
<div align="right"> <a href="../core/logout.php"><button>Logout</button></a></div>
<form method="post">
<label>Course Name</label>
<br>
<input type="text" name="course_name" required="" />
<br>
<label>Course type</label>
<br>
<input type="text" name="course_type" required="" />
<br>
<label>Course Duration</label>
<br>
<input type="text" name="course_time" required="" />
<br>
<button type="submit">Add Course</button>
</form>
</body>
</html>
