<?php
require_once '../core/conn.php';

session_start();
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
if (empty($username) && empty($user_id)) {
    header('Location: ../login.php');
}

else {
    //Query courses
$query = "SELECT * FROM courses WHERE user_id = '$user_id'"; 
echo "<h1> <center>Manage Courses</center> </h1> <br> <br>";
echo "<h3 align='right'>WELCOME <span style='color:green'> $username  </span></h3>
<div align='right'> <a href='../core/logout.php'><button>Logout</button></a></div>";
echo '<table border="0" cellspacing="2" cellpadding="2" style="border:1px solid grey;"> 
      <tr> 
          <td > <font face="Arial">Id</font> </td> 
          <td > <font face="Arial">Course Name</font> </td> 
          <td> <font face="Arial">Course Type </font> </td> 
          <td> <font face="Arial"> Course Duration</font> </td> 
          <td> <font face="Arial">Delete</font> </td> 
      </tr>';

if ($result = mysqli_query($link, $query)) {
    while ($row = mysqli_fetch_array($result)) {
        $course_id = $row['id'];
        $course_name = $row['name'];
        $course_type = $row["type"];
        $course_time = $row["time"];

        echo '<tr> 
        <td>'.$course_id.'</td>
                  <td>'.$course_name.'</td> 
                  <td>'.$course_type.'</td> 
                  <td>'.$course_time.'</td> 
                  <td><form id="form_del_course" method="post">
                  <input type="hidden" name="course_id" value ="'. $course_id . '">
                  <button type="submit" name="delete">Delete</button></td> 
                </form>
              </tr>';
    }
    $result->free();

}
    //If update button is clicked
if(isset($_POST["update"])){
     // This Variable will Hold our Error Messages
     $error = "";
        
     $upd_course_id = mysqli_real_escape_string ($link, $_REQUEST['course_id']);
     $upd_course_name = mysqli_real_escape_string ($link, $_REQUEST['course_name']);
     $upd_course_type = mysqli_real_escape_string ($link, $_REQUEST['course_type']);
     $upd_course_time = mysqli_real_escape_string ($link, $_REQUEST['course_time']);
 
if(empty($upd_course_id)) {
 $error = "The course ID to update is required!";
}
else {
 $update= "UPDATE courses SET name = '$upd_course_name',  type = '$upd_course_type', time = '$upd_course_time'
  WHERE id = '$upd_course_id' AND user_id = '$user_id'";

// If the process was successful,
 if(mysqli_query($link, $update)){
     echo '<span style="color:green;">Course Updated Successfully, Please Reload page</span>';

 }
 else { 
     $error = "Oops! An error has occurred".' '. mysqli_error($link);
 }
}
echo '<span style="color:red;">'.$error.'</span>';
}

    // If Delete button is clicked

if(isset($_POST["delete"])){ 

 // This Variable will Hold our Error Messages
 $error = "";
        
 $del_course_id = mysqli_real_escape_string ($link, $_REQUEST['course_id']);

 //Check if course id is empty

 if(empty($del_course_id)) {
    $error = "The course ID to be Deleted is required!";
   }
   else {
    $delete = "DELETE FROM courses WHERE id = '$del_course_id' AND user_id = '$user_id'";
  // If the process was successful,
   if(mysqli_query($link, $delete)){
       echo '<span style="color:green;">Course Deleted Successfully! Please Reload page</span>';
   }
   else { 
       $error = "Oops! An error has occurred".' '. mysqli_error($link);
   }
}
echo '<span style="color:red;">'.$error.'</span>';
}
}
?>

<!Doctype html>
<html>
<head></head>
<title>MANAGE COURSES</title>
<body>
<style>
table, tr, td {
    border:1px solid grey;
}
</style>
<div >
<h4>UPDATE COURSE</h4>
<form method="post">
<label>Course ID</label>
<br>
<input type="number" name="course_id" required="" />
<br>
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
<button type="submit" name="update">Update</button>
</form>
</div>
<br><br><br><br>

</body>

</html>