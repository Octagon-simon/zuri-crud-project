<?php
require_once '../core/conn.php';

session_start();
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
if (empty($username) && empty($user_id)) {
    header('Location: ../login.php');
}

else {
//Query all Courses
$query = "SELECT * FROM courses WHERE user_id = '$user_id'"; 
echo "<h1 align='center'> View Courses </h1> <br> <br> <style>
table, tr, td {
    border:1px solid grey;
}
</style>";
echo "<h3 align='right'>WELCOME <span style='color:green'> $username  </span></h3>
<div align='right'> <a href='../core/logout.php'><button>Logout</button></a></div>";
echo '<table border="0" cellspacing="2" cellpadding="2" style="border:1px solid grey;"> 
      <tr> 
          <td > <font face="Arial">Id</font> </td> 
          <td > <font face="Arial">Course Name</font> </td> 
          <td> <font face="Arial">Course Type </font> </td> 
          <td> <font face="Arial"> Course Duration</font> </td> 
        
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
 
                
              </tr>';
    }
    $result->free();

}
}


?>